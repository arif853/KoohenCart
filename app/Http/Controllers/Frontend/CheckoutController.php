<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\Coupon;
use App\Mail\AdminMail;
use App\Models\Postcode;
use App\Models\Customer;
use App\Models\shipping;
use App\Mail\customerMail;
use App\Models\order_items;
use App\Models\Orderstatus;
use App\Models\transactions;
use Illuminate\Http\Request;
use App\Models\Product_stock;
use App\Models\AppliedCoupone;
use Illuminate\Support\Carbon;
use App\Models\Register_customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\ValidationException;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Notifications\NewPendingOrderNotification;
use SteadFast\SteadFastCourierLaravelPackage\Facades\SteadfastCourier;

class CheckoutController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */

    public function generateCode()
    {
        do {
            // Generate a 4-digit random number
            $randomNumber = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);

            // Get the current year
            $currentYear = date('y');
            // Concatenate the components to create the final code
            $generatedCode = 'K' . $currentYear . '-' . $randomNumber;
            // Check if the generated code already exists in the database
            $codeExists = DB::table('orders')->where('order_track_id', $generatedCode)->exists();
        } while ($codeExists);

        // Concatenate the components to create the final code

        return $generatedCode;
    }

    public function generateInvoiceNo()
    {
        do {
            // Generate a 2-digit random number
            $randomNumber = str_pad(mt_rand(1, 99), 2, '0', STR_PAD_LEFT);

            // Get the current year
            $currentYear = date('y');
            $currentMonth = date('m');

            // Concatenate the components to create the final code
            $invoiceNo = $currentMonth . $currentYear . $randomNumber;
            // Check if the generated code already exists in the database
            $codeExists = DB::table('orders')->where('invoice_no', $invoiceNo)->exists();
        } while ($codeExists);

        // Concatenate the components to create the final code

        return $invoiceNo;
    }

    /**
     * Authoritative cart subtotal computed from the server-side cart contents,
     * so it can never be tampered with via the submitted form.
     */
    private function cartSubtotal(): float
    {
        return (float) Cart::instance('cart')->content()->sum(function ($item) {
            return $item->price * $item->qty;
        });
    }

    /**
     * Resolve a coupon that is genuinely usable by this customer right now,
     * or null when no valid coupon applies.
     */
    private function resolveValidCoupon(?string $code, $customerId): ?Coupon
    {
        if (!$code) {
            return null;
        }

        $alreadyUsed = AppliedCoupone::where('customer_id', $customerId)
            ->where('coupone_code', $code)
            ->where('is_ordered', 1)
            ->exists();

        if ($alreadyUsed) {
            return null;
        }

        return Coupon::where('coupons_code', $code)
            ->where('status', 1)
            ->where('quantity', '>', 0)
            ->whereDate('end_date', '>=', now())
            ->first();
    }

    /**
     * Discount amount for a coupon against a subtotal, clamped to [0, subtotal].
     */
    private function couponDiscount(?Coupon $coupon, float $subtotal): float
    {
        if (!$coupon) {
            return 0.0;
        }

        $discount = $coupon->discounts_type === 'percent'
            ? $subtotal * ((float) $coupon->percent_value / 100)
            : (float) $coupon->fixed;

        return (float) min(max($discount, 0), $subtotal);
    }

    /**
     * Delivery charge for a given postcode/area id (0 when it can't be resolved).
     */
    private function deliveryChargeForArea($areaId): float
    {
        $postOffice = $areaId ? Postcode::find($areaId) : null;

        return (float) ($postOffice->zone_charge ?? 0);
    }

    /**
     * Return human-readable messages for any cart line that exceeds available stock.
     * Only size-tracked lines with an existing stock row are checked, so products
     * that don't use per-size inventory are never wrongly blocked.
     */
    private function outOfStockItems(): array
    {
        $problems = [];

        foreach (Cart::instance('cart')->content() as $item) {
            $sizeId = $item->options->size ?? null;
            if (!$sizeId) {
                continue;
            }

            $stock = Product_stock::where('product_id', $item->id)
                ->where('size_id', $sizeId)
                ->first();

            if ($stock) {
                $balance = $stock->inStock - $stock->outStock;
                if ($balance < $item->qty) {
                    $problems[] = $item->name . ' has only ' . max(0, $balance) . ' left in stock.';
                }
            }
        }

        return $problems;
    }

    public function store(Request $request)
    {
        $track_id = $this->generateCode();
        $invoiceNo = $this->generateInvoiceNo();

        // Prevent overselling: reject the order if any size-tracked item exceeds stock.
        $stockProblems = $this->outOfStockItems();
        if (!empty($stockProblems)) {
            return redirect()->back()->with('danger', implode(' ', $stockProblems));
        }

        // Initialize an empty array to store purchase event data
        $purchaseEventData = [];

        DB::beginTransaction();

        try {
            if (Auth::guard('customer')->check()) {
                $user = Auth::guard('customer')->user();
                $customer_id = $user->customer->id;
                $couponCode = $request->input('coupon_code');

                // --- Authoritative server-side amounts (never trust client totals) ---
                $subtotal = $this->cartSubtotal();
                $coupon = $this->resolveValidCoupon($couponCode, $customer_id);
                $discount = $this->couponDiscount($coupon, $subtotal);
                $deliveryCharge = $this->deliveryChargeForArea(optional($user->customer)->area);
                $grandTotal = max(0, $subtotal - $discount + $deliveryCharge);

                // order details store to order
                $order = new Order();
                $order->customer_id = $customer_id;
                $order->invoice_no = $invoiceNo;
                $order->order_track_id = $track_id;
                $order->subtotal = $subtotal;
                $order->discount = $discount;
                $order->tax = 0;
                $order->total = $grandTotal;
                $order->delivery_charge = $deliveryCharge;
                $order->is_shipping_different = $request->is_shipping ? 1 : 0;
                $order->comment = $request->comment;
                $order->save();

                $order_status = Orderstatus::create([
                    'order_id' => $order->id,
                ]);
                //Transaction details
                $purchaseEventData['transaction_id'] = $invoiceNo; // actual transaction ID
                $purchaseEventData['value'] = $grandTotal; // Total amount of the transaction
                $purchaseEventData['tax'] = 0; // Tax amount
                $purchaseEventData['shipping'] = $deliveryCharge; // Shipping cost
                $purchaseEventData['currency'] = 'BDT'; // Currency
                $purchaseEventData['coupon'] = $request->input('coupon_code') ?? ''; // Coupon code
                $purchaseEventData['items'] = [];

                $cartItems = Cart::instance('cart')->content();

                // Loop through the cart items and save them to the order item table
                foreach ($cartItems as $cartItem) {
                    // Save $cartItem to your order item table
                    //order item store in order item item table.
                    order_items::create([
                        'product_id' => $cartItem->id,
                        'order_id' => $order->id,
                        // Use each cart item's own selected color/size so multi-item
                        // orders aren't all saved with the last <select>'s value.
                        'color_id' => $cartItem->options->color ?? $request->color_id,
                        'size_id' => $cartItem->options->size ?? $request->size_id,
                        'price' => $cartItem->price,
                        'quantity' => $cartItem->qty,
                    ]);
                    //dataLayer Data
                    $item = [
                        'item_id' => $cartItem->id,
                        'item_name' => $cartItem->name, // Assuming you have a 'name' property for the item
                        'price' => $cartItem->price,
                        'quantity' => $cartItem->qty,
                    ];
                    $purchaseEventData['items'][] = $item;
                }

                $transaction = transactions::create([
                    'customer_id' => $customer_id,
                    'order_id' => $order->id,
                    'mode' => $request->payment_mode,
                ]);



                // Finalize coupon usage at order time. The coupon is only consumed
                // (quantity decremented + usage recorded) when an order is actually
                // placed, and only when it produced a real discount above.
                if ($coupon && $discount > 0) {
                    $coupon->decrement('quantity');
                    AppliedCoupone::create([
                        'customer_id' => $customer_id,
                        'order_id' => $order->id,
                        'coupone_id' => $coupon->id,
                        'coupone_code' => $coupon->coupons_code,
                        'is_ordered' => 1,
                    ]);
                }

                $customer = Customer::find($customer_id);

                $order->notify(new NewPendingOrderNotification($order));

                Session::flash('warning', 'Check your order in dashboard.');

              //  Mail::to($customer->email)->send(new customerMail($order));
            } else {
                $rules = [
                    'fname' => 'required|string',
                    'lname' => 'required|string',
                    'phone' => 'required|string',
                    'email' => 'required|email',
                    'billing_address' => 'required|string',
                    'division' => 'required',
                    'district' => 'required',
                    'area' => 'required',
                    // 'password' => 'min:6',
                ];
                $customMessages = [
                    'fname.required' => 'Please fill up first name field.',
                    'lname.required' => 'Please fill up last name field.',
                    'phone.required' => 'Please fill up phone field .',
                    'email.required' => 'Please fill up email field.',
                    'billing_address.required' => 'Please fill up billing address field.',
                    'division.required' => 'Please fill up division field.',
                    'district.required' => 'Please fill up district field.',
                    'area.required' => 'Please fill up area field.',
                ];

                $validator = Validator::make($request->all(), $rules, $customMessages);

                // Validate the request
                if ($validator->fails()) {
                    // Session::flash('danger', $validator->messages()->toArray());
                    return redirect()->back()->withErrors($validator)->withInput();
                } else {
                    // save new customer.
                    // Check if customer with the given email or phone already exists
                    $existingCustomer = Customer::where('email', $request->email)
                        ->orWhere('phone', $request->phone)
                        ->first();

                    if ($existingCustomer) {
                        // Customer with the same email or phone already exists
                        // You can show a session message or take any other action
                        return redirect()->back()->with('warning', 'The same email or phone already exists. Please login first.');
                    } else {
                        // Customer does not exist, create a new one
                        $customer = new Customer();
                        $customer->firstName = $request->fname;
                        $customer->lastName = $request->lname;
                        $customer->phone = $request->phone;
                        $customer->email = $request->email;
                        $customer->billing_address = $request->billing_address;
                        $customer->division = $request->division;
                        $customer->district = $request->district;
                        $customer->area = $request->area;
                        $customer->loyalty_point = 10;
                        $customer->save();
                    }

                    $customer_id = $customer->id;
                    $customerPhone = $customer->phone;
                    $customerEmail = $customer->email;

                    // if new customer registration store.
                    if ($request->is_createaccount) {
                        $customer_reg = new Register_customer();
                        $customer_reg->customer_id = $customer_id;
                        $customer_reg->phone = $customerPhone;
                        $customer_reg->email = $customerEmail;
                        $customer_reg->password = Hash::make($request->password);
                        $customer_reg->status = 'registerd';
                        $customer_reg->save();

                        $registration_status = $customer_reg->status;
                        $register_customer = Customer::find($customer_reg->customer_id);
                        $register_customer->update([
                            'status' => $registration_status,
                        ]);

                        Session::flash('warning', 'Your registration complete successfully, Please login to user dashboard.');
                    } else {
                        $customer_reg = new Register_customer();
                        $customer_reg->customer_id = $customer_id;
                        $customer_reg->phone = $customerPhone;
                        $customer_reg->email = $customerEmail;
                        $customer_reg->password = Hash::make($customerPhone);
                        $customer_reg->status = 'registerd';
                        $customer_reg->save();

                        $registration_status = $customer_reg->status;
                        $register_customer = Customer::find($customer_reg->customer_id);
                        $register_customer->update([
                            'status' => $registration_status,
                        ]);

                        Session::flash('warning', 'Use your Phone number as password to login.');
                    }

                    // --- Authoritative server-side amounts (guests can't apply coupons) ---
                    $subtotal = $this->cartSubtotal();
                    $deliveryCharge = $this->deliveryChargeForArea($request->area);
                    $grandTotal = max(0, $subtotal + $deliveryCharge);

                    // $product = Cart::get();
                    // order details store to order
                    $order = new Order();
                    $order->customer_id = $customer_id;
                    $order->invoice_no = $invoiceNo;
                    $order->order_track_id = $track_id;
                    $order->subtotal = $subtotal;
                    $order->discount = 0;
                    $order->tax = 0;
                    $order->total = $grandTotal;
                    $order->delivery_charge = $deliveryCharge;
                    $order->is_shipping_different = $request->is_shipping ? 1 : 0;
                    $order->comment = $request->comment;
                    $order->save();

                    $order_status = Orderstatus::create([
                        'order_id' => $order->id,
                    ]);
                    //Transaction details
                    $purchaseEventData['transaction_id'] = $invoiceNo; // actual transaction ID
                    $purchaseEventData['value'] = $grandTotal; // Total amount of the transaction
                    $purchaseEventData['tax'] = 0; // Tax amount
                    $purchaseEventData['shipping'] = $deliveryCharge; // Shipping cost
                    $purchaseEventData['currency'] = 'BDT'; // Currency
                    $purchaseEventData['coupon'] = $request->input('coupon_code') ?? ''; // Coupon code
                    $purchaseEventData['items'] = [];

                    $cartItems = Cart::instance('cart')->content();

                    // Loop through the cart items and save them to the order item table
                    foreach ($cartItems as $cartItem) {
                        // Save $cartItem to your order item table
                        //order item store in order item item table.
                        order_items::create([
                            'product_id' => $cartItem->id,
                            'order_id' => $order->id,
                            // Use each cart item's own selected color/size so multi-item
                            // orders aren't all saved with the last <select>'s value.
                            'color_id' => $cartItem->options->color ?? $request->color_id,
                            'size_id' => $cartItem->options->size ?? $request->size_id,
                            'price' => $cartItem->price,
                            'quantity' => $cartItem->qty,
                        ]);

                        $item = [
                            'item_id' => $cartItem->id,
                            'item_name' => $cartItem->name, // Assuming you have a 'name' property for the item
                            'price' => $cartItem->price,
                            'quantity' => $cartItem->qty,
                        ];
                        $purchaseEventData['items'][] = $item;
                    }

                    $transaction = transactions::create([
                        'customer_id' => $customer_id,
                        'order_id' => $order->id,
                        'mode' => $request->payment_mode,
                    ]);


                    if ($request->is_shipping) {
                        // shipping addres different from billing address. get shipping data.
                        // $existingCustomer_shipping = shipping::where('customer_id', $customer_id);

                        $shipping_info = new shipping();
                        $shipping_info->customer_id = $customer_id;
                        $shipping_info->order_id = $order->id;
                        $shipping_info->first_name = $request->shipper_fname;
                        $shipping_info->last_name = $request->shipper_lname;
                        $shipping_info->s_phone = $request->shipper_phone;
                        $shipping_info->s_email = $request->shipper_email;
                        $shipping_info->shipping_add = $request->shipper_address;
                        $shipping_info->division = $request->s_division;
                        $shipping_info->district = $request->s_district;
                        $shipping_info->area = $request->s_area;
                        $shipping_info->save();
                    } else {
                        // shipping address and billing address same. billing address save to shipping table.

                        $shipping_info = new shipping();
                        $shipping_info->customer_id = $customer_id;
                        $shipping_info->order_id = $order->id;
                        $shipping_info->first_name = $request->fname;
                        $shipping_info->last_name = $request->lname;
                        $shipping_info->s_phone = $request->phone;
                        $shipping_info->s_email = $request->email;
                        $shipping_info->shipping_add = $request->billing_address;
                        $shipping_info->division = $request->division;
                        $shipping_info->district = $request->district;
                        $shipping_info->area = $request->area;
                        $shipping_info->save();
                    }

                }

                // $admins = User::where('is_admin', true)->get();

                // Notification::send(new NewPendingOrderNotification($order));

                $order->notify(new NewPendingOrderNotification($order));
               // Mail::to($customer->email)->send(new customerMail($order));
            }
            DB::commit();

            // Clear the cart after saving to the order item table
            // Mail::to('qbittech.dev1@gmail.com')->send(new AdminMail($order));
            // masudszone.design@gmail.com

            Cart::instance('cart')->destroy();

            if ($request->payment_mode == 'online') {

                $post_data = array();
                $post_data['total_amount'] = $order->total;
                $post_data['currency'] = "BDT";
                $post_data['tran_id'] = uniqid();

                $post_data['cus_name'] = $order->customer->firstName . ' ' . $order->customer->lastName;
                $post_data['cus_email'] = $order->customer->email;
                $post_data['cus_add1'] = $order->customer->billing_address;
                $post_data['cus_phone'] = $order->customer->phone;

                // $post_data['ship_name'] = $order->shipping->first_name . ' ' . $order->shipping->last_name;
                // $post_data['ship_add1'] = $order->shipping->shipping_add;
                // $post_data['ship_phone'] = $order->shipping->s_phone;

                $post_data['shipping_method'] = "NO";
                $post_data['product_name'] = "Ecommerce";
                $post_data['product_category'] = "Goods";
                $post_data['product_profile'] = "physical-goods";

                $post_data['value_a'] = $order->id;

                $sslc = new SslCommerzNotification();
                $payment_options = $sslc->makePayment($post_data, 'hosted');

                if (!is_array($payment_options)) {
                    print_r($payment_options);
                    $payment_options = array();
                }

                return;
            }


            return redirect()->route('thankyou')
                ->with([
                    'success' => 'Your order has been placed',
                    'purchaseEventData' => $purchaseEventData,
                ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error order: ' . $e->getMessage());
            return redirect()->back()->with('danger','Checkout Error '.$e);
        }
    }


    // NOTE: The SSLCommerz success/fail/cancel/ipn callbacks are handled by
    // App\Http\Controllers\SslCommerzPaymentController (see routes/web.php). The
    // duplicate, dead implementations that used to live here (with a stray dd()
    // and references to non-existent order.fail/order.cancel routes) were removed.

    public function login(Request $request)
    {
        $request->validate([
            'login_identifier' => 'required',
            'password' => 'required',
        ]);

        $loginIdentifier = $request->input('login_identifier');

        // Check if the login identifier is an email or phone
        $fieldType = filter_var($loginIdentifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        // Attempt to authenticate the customer
        if (Auth::guard('customer')->attempt([$fieldType => $loginIdentifier, 'password' => $request->password])) {
            // Authentication successful
            return redirect()->route('checkout')->with('success', 'Successfully Login.');
        }

        // Authentication failed
        throw ValidationException::withMessages([
            'danger' => 'Login failed, Try again',
            'login_identifier' => [trans('auth.failed')],
        ]);
    }

    public function appliedCoupone(Request $request)
    {
        $couponCode = $request->input('coupne');

        $timeZone = 'Asia/Dhaka'; // For example, 'Asia/Kolkata'

        // Check if the user is logged in
        if (Auth::guard('customer')->check()) {
            $user = Auth::guard('customer')->user();
            $customerId = $user->customer->id;

            // Only block re-use if the customer has actually COMPLETED an order with this coupon.
            // (Merely applying it during a checkout that was later abandoned must not lock them out.)
            $appliedCoupon = AppliedCoupone::where('customer_id', $customerId)
                ->where('coupone_code', $couponCode)
                ->where('is_ordered', 1)
                ->first();

            if ($appliedCoupon) {
                // Show error message if coupon has already been used by this customer
                Session::flash('success', 'You have already used this coupon.');
                // return redirect()->route('checkout');
                return response()->json(['status' => 402, 'message' => 'You have already used this coupon.']);
            } else {
                // Find the coupon with the provided code
                $coupon = Coupon::where('coupons_code', $couponCode)
                    ->where('status', 1) // Check if the coupon is active
                    ->where('quantity', '>', 0) // Check if there are available coupons
                    ->whereDate('end_date', '>=', now()) // Check if the coupon is not expired
                    ->first();
                if ($coupon) {
                    // Just validate and return the coupon here. The quantity is only
                    // decremented and the usage recorded once the order is actually placed
                    // (see store()), so abandoned checkouts don't burn the coupon.
                    return response()->json(['status' => 200, 'coupon' => $coupon, 'message' => 'Coupon applied successfully!']);
                } else {
                    // Show error message if coupon not found or invalid
                    // Session::flash('danger', 'Invalid coupon code or expired!');
                    return response()->json(['status' => 402, 'message' => 'Invalid coupon code or expired.']);
                }
            }
        } else {
            // Show error message if user is not logged in
            // Session::flash('danger', 'Please log in to apply the coupon.');
            // Redirect back to the previous page
            return response()->json(['status' => 402, 'message' => 'Please log in to apply the coupon.']);
        }
    }
}
