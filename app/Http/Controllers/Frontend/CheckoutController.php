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
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

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
     * The account matching the phone or email typed into the checkout form, if any.
     * Its existence is what forces a shopper to log in instead of ordering as a
     * guest, so it must never match on a blank email.
     */
    public static function findExistingAccount(?string $phone, ?string $email): ?Register_customer
    {
        return Register_customer::query()
            ->when($phone, fn ($q) => $q->orWhere('phone', $phone))
            ->when($email, fn ($q) => $q->orWhere('email', $email))
            ->first();
    }

    /**
     * Register a brand new customer at checkout and sign them straight in.
     *
     * The password is random and never shown: the customer proves ownership by
     * already being in this session, and is prompted to choose a real one from the
     * dashboard (and by email, when they gave one). A random password is what makes
     * password_set_at null, which drives that prompt.
     *
     * This always creates a fresh Customer row. A phone may already belong to a
     * customer created by admin/POS that has no login, and silently adopting that
     * record would hand a stranger someone else's order history.
     */
    private function registerCustomer(array $data): Customer
    {
        $customer = new Customer();
        $customer->firstName = $data['fname'];
        $customer->lastName = $data['lname'];
        $customer->phone = $data['phone'];
        $customer->email = $data['email'] ?? null;
        $customer->billing_address = $data['billing_address'];
        $customer->loyalty_point = 10;
        $customer->status = 'registerd';
        $customer->save();

        $login = Register_customer::create([
            'customer_id' => $customer->id,
            'phone' => $customer->phone,
            'email' => $customer->email,
            'password' => Hash::make(Str::random(40)),
            'password_set_at' => null,
            'status' => 'registerd',
        ]);

        Auth::guard('customer')->login($login);

        return $customer;
    }

    /**
     * Update the signed-in customer's own profile from the checkout form.
     */
    private function updateOwnProfile(array $data): Customer
    {
        $customer = Auth::guard('customer')->user()->customer;

        $customer->firstName = $data['fname'];
        $customer->lastName = $data['lname'];
        $customer->phone = $data['phone'];
        $customer->email = $data['email'] ?? null;
        $customer->billing_address = $data['billing_address'];
        $customer->save();

        return $customer;
    }

    /**
     * Email the new customer a link to choose their password. Best effort: a failed
     * send must never roll back an order that has already been paid for or placed.
     */
    private function sendPasswordSetupLink(Customer $customer): void
    {
        if (!$customer->email) {
            return;
        }

        try {
            Password::broker('customers')->sendResetLink(['email' => $customer->email]);
        } catch (\Throwable $e) {
            Log::error('Could not send password setup link to ' . $customer->email . ': ' . $e->getMessage());
        }
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

        $isNewRegistration = false;

        // A shopper whose phone or email already has an account must log in rather
        // than quietly creating a second one (or ordering against someone else's).
        if (!Auth::guard('customer')->check()) {
            if (self::findExistingAccount($data['phone'], $data['email'] ?? null)) {
                return redirect()->route('checkout')
                    ->withInput()
                    ->with('show_login', true)
                    ->withErrors([
                        'login_identifier' => 'You already have an account with this phone or email. Please log in to continue.',
                    ]);
            }

            $isNewRegistration = true;
        }

        // Prevent overselling: reject the order if any size-tracked item exceeds stock.
        $stockProblems = $this->outOfStockItems();
        if (!empty($stockProblems)) {
            return redirect()->back()->with('danger', implode(' ', $stockProblems))->withInput();
        }

        $purchaseEventData = [];

        DB::beginTransaction();

        try {
            $customer = $isNewRegistration
                ? $this->registerCustomer($data)
                : $this->updateOwnProfile($data);

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

            // The registration above signed them in; that session must not outlive
            // the customer row the rollback just discarded.
            if ($isNewRegistration) {
                Auth::guard('customer')->logout();
            }

            Log::error('Checkout error: ' . $e->getMessage());

            return redirect()->back()->with('danger', 'Sorry, we could not place your order. Please try again.')->withInput();
        }

        // After the commit: the order is placed, so a mail failure must not undo it.
        if ($isNewRegistration) {
            $this->sendPasswordSetupLink($customer);
            Session::flash('warning', 'We created an account for you. Set a password from your dashboard to secure it.');
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
     * Log in from the checkout page itself, so an existing customer keeps their
     * cart and lands straight back on checkout rather than the dashboard.
     */
    public function login(Request $request)
    {
        $request->validate([
            'login_identifier' => 'required|string',
            'password' => 'required|string',
        ], [
            'login_identifier.required' => 'Enter your phone number or email.',
            'password.required' => 'Enter your password.',
        ]);

        $identifier = $request->input('login_identifier');
        $field = filter_var($identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        if (!Auth::guard('customer')->attempt(
            [$field => $identifier, 'password' => $request->input('password')],
            $request->boolean('remember')
        )) {
            throw ValidationException::withMessages([
                'login_identifier' => trans('auth.failed'),
            ])->redirectTo(route('checkout'));
        }

        $request->session()->regenerate();

        return redirect()->route('checkout')->with('success', 'Logged in. Please review your order.');
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
