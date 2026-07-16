<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Models\AppliedCoupone;
use App\Models\Coupon;
use App\Models\Customer;
use App\Models\order_items;
use App\Models\Order;
use App\Models\Orderstatus;
use App\Models\Product_stock;
use App\Models\Register_customer;
use App\Models\shipping;
use App\Models\transactions;
use App\Notifications\NewPendingOrderNotification;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function generateCode()
    {
        do {
            $randomNumber = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
            $generatedCode = 'K' . date('y') . '-' . $randomNumber;
            $codeExists = DB::table('orders')->where('order_track_id', $generatedCode)->exists();
        } while ($codeExists);

        return $generatedCode;
    }

    public function generateInvoiceNo()
    {
        do {
            $randomNumber = str_pad(mt_rand(1, 99), 2, '0', STR_PAD_LEFT);
            $invoiceNo = date('m') . date('y') . $randomNumber;
            $codeExists = DB::table('orders')->where('invoice_no', $invoiceNo)->exists();
        } while ($codeExists);

        return $invoiceNo;
    }

    /**
     * Authoritative cart subtotal computed from the server-side cart contents,
     * so it can never be tampered with via the submitted form.
     */
    private function cartSubtotal(): float
    {
        return (float) Cart::instance('cart')->content()->sum(
            fn ($item) => $item->price * $item->qty
        );
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

    /**
     * The customer placing the order: the logged-in one, an earlier customer with
     * the same phone (so repeat buyers aren't blocked), or a brand new record.
     *
     * A guest who types someone else's phone number must not be able to rewrite
     * that person's saved profile, so the submitted details are only written to a
     * customer this request owns: a brand new one, or the logged-in account. The
     * details for THIS order are always kept on the order's own shipping row, which
     * is what admin, the invoice and the courier read.
     */
    private function resolveCustomer(array $data): Customer
    {
        if (Auth::guard('customer')->check()) {
            $customer = Auth::guard('customer')->user()->customer;
        } else {
            $existing = Customer::where('phone', $data['phone'])->first();

            if ($existing) {
                return $existing;
            }

            $customer = new Customer();
            $customer->loyalty_point = 10;
        }

        $customer->firstName = $data['fname'];
        $customer->lastName = $data['lname'];
        $customer->phone = $data['phone'];
        $customer->email = $data['email'] ?? null;
        $customer->billing_address = $data['billing_address'];
        $customer->save();

        return $customer;
    }

    /**
     * Guests get a dashboard login with their phone as the password, matching the
     * shop's existing behaviour. An account is only created when none exists yet,
     * so a repeat guest never overwrites a real password.
     */
    private function ensureLoginExists(Customer $customer): void
    {
        $exists = Register_customer::where('customer_id', $customer->id)->exists();

        if ($exists) {
            return;
        }

        Register_customer::create([
            'customer_id' => $customer->id,
            'phone' => $customer->phone,
            'email' => $customer->email,
            'password' => Hash::make($customer->phone),
            'status' => 'registerd',
        ]);

        $customer->update(['status' => 'registerd']);

        Session::flash('warning', 'Use your phone number as the password to log in to your dashboard.');
    }

    public function store(Request $request)
    {
        $zones = config('delivery.zones', []);

        $data = $request->validate([
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'billing_address' => 'required|string|max:500',
            'delivery_zone' => ['required', 'string', 'in:' . implode(',', array_keys($zones))],
            'payment_mode' => 'required|in:cod,online',
            'comment' => 'nullable|string|max:1000',
        ], [
            'fname.required' => 'Please fill up the first name field.',
            'lname.required' => 'Please fill up the last name field.',
            'phone.required' => 'Please fill up the phone field.',
            'billing_address.required' => 'Please fill up the address field.',
            'delivery_zone.required' => 'Please choose a delivery option.',
            'delivery_zone.in' => 'Please choose a valid delivery option.',
        ]);

        if (Cart::instance('cart')->count() === 0) {
            return redirect()->route('cart')->with('danger', 'Your cart is empty.');
        }

        // Prevent overselling: reject the order if any size-tracked item exceeds stock.
        $stockProblems = $this->outOfStockItems();
        if (!empty($stockProblems)) {
            return redirect()->back()->with('danger', implode(' ', $stockProblems))->withInput();
        }

        $purchaseEventData = [];

        DB::beginTransaction();

        try {
            $customer = $this->resolveCustomer($data);
            $this->ensureLoginExists($customer);

            // --- Authoritative server-side amounts (never trust client totals) ---
            $subtotal = $this->cartSubtotal();
            $coupon = $this->resolveValidCoupon($request->input('coupon_code'), $customer->id);
            $discount = $this->couponDiscount($coupon, $subtotal);
            $deliveryCharge = (float) ($zones[$data['delivery_zone']]['charge'] ?? 0);
            $grandTotal = max(0, $subtotal - $discount + $deliveryCharge);

            $order = new Order();
            $order->customer_id = $customer->id;
            $order->invoice_no = $this->generateInvoiceNo();
            $order->order_track_id = $this->generateCode();
            $order->subtotal = $subtotal;
            $order->discount = $discount;
            $order->tax = 0;
            $order->total = $grandTotal;
            $order->delivery_charge = $deliveryCharge;
            $order->delivery_zone = $data['delivery_zone'];
            $order->is_shipping_different = 0;
            $order->comment = $data['comment'] ?? null;
            $order->save();

            Orderstatus::create(['order_id' => $order->id]);

            $purchaseEventData = [
                'transaction_id' => $order->invoice_no,
                'value' => $grandTotal,
                'tax' => 0,
                'shipping' => $deliveryCharge,
                'currency' => 'BDT',
                'coupon' => $coupon->coupons_code ?? '',
                'items' => [],
            ];

            foreach (Cart::instance('cart')->content() as $cartItem) {
                order_items::create([
                    'product_id' => $cartItem->id,
                    'order_id' => $order->id,
                    // Each cart line carries its own selected colour/size, so a
                    // multi-item order no longer saves them all with one value.
                    'color_id' => $cartItem->options->color ?? null,
                    'size_id' => $cartItem->options->size ?? null,
                    'price' => $cartItem->price,
                    'quantity' => $cartItem->qty,
                ]);

                $purchaseEventData['items'][] = [
                    'item_id' => $cartItem->id,
                    'item_name' => $cartItem->name,
                    'price' => $cartItem->price,
                    'quantity' => $cartItem->qty,
                ];
            }

            transactions::create([
                'customer_id' => $customer->id,
                'order_id' => $order->id,
                'mode' => $data['payment_mode'],
            ]);

            // Billing and delivery address are the same now, so the shipping row
            // (used by admin and the courier) mirrors the submitted details.
            shipping::create([
                'customer_id' => $customer->id,
                'order_id' => $order->id,
                'first_name' => $data['fname'],
                'last_name' => $data['lname'],
                's_phone' => $data['phone'],
                's_email' => $data['email'] ?? null,
                'shipping_add' => $data['billing_address'],
            ]);

            // The coupon is only consumed once an order is actually placed, and
            // only when it produced a real discount.
            if ($coupon && $discount > 0) {
                $coupon->decrement('quantity');
                AppliedCoupone::create([
                    'customer_id' => $customer->id,
                    'order_id' => $order->id,
                    'coupone_id' => $coupon->id,
                    'coupone_code' => $coupon->coupons_code,
                    'is_ordered' => 1,
                ]);
            }

            $order->notify(new NewPendingOrderNotification($order));

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Checkout error: ' . $e->getMessage());

            return redirect()->back()->with('danger', 'Sorry, we could not place your order. Please try again.')->withInput();
        }

        Cart::instance('cart')->destroy();

        if ($data['payment_mode'] === 'online') {
            return $this->payOnline($order);
        }

        return redirect()->route('thankyou')->with([
            'success' => 'Your order has been placed',
            'purchaseEventData' => $purchaseEventData,
        ]);
    }

    /**
     * Hand the order off to the SSLCommerz hosted gateway, which redirects out.
     */
    private function payOnline(Order $order)
    {
        // Read this order's own details rather than the customer profile, which a
        // repeat guest's order deliberately leaves untouched.
        $details = $order->deliveryDetails();

        $post_data = [
            'total_amount' => $order->total,
            'currency' => 'BDT',
            'tran_id' => uniqid(),
            'cus_name' => $details->name,
            // The gateway rejects a blank email, and email is optional for us.
            'cus_email' => $details->email ?: 'noreply@' . request()->getHost(),
            'cus_add1' => $details->address,
            'cus_phone' => $details->phone,
            'shipping_method' => 'NO',
            'product_name' => 'Ecommerce',
            'product_category' => 'Goods',
            'product_profile' => 'physical-goods',
            'value_a' => $order->id,
        ];

        $sslc = new SslCommerzNotification();
        $payment_options = $sslc->makePayment($post_data, 'hosted');

        // makePayment() redirects on success; anything returned here is a failure.
        if (!is_array($payment_options)) {
            Log::error('SSLCommerz payment failed for order ' . $order->id . ': ' . print_r($payment_options, true));
        }

        return redirect()->route('thankyou')->with([
            'warning' => 'Your order is placed but the online payment could not be started. Our team will contact you.',
        ]);
    }

}
