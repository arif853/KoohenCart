<?php

namespace App\Livewire;

use App\Models\AppliedCoupone;
use App\Models\Coupon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

/**
 * Order summary for the checkout page.
 *
 * Every amount shown here is computed server-side from the cart and re-computed
 * from scratch by CheckoutController::store(), so a tampered form can never
 * change what the customer is charged. The component only posts back the two
 * customer *choices* (delivery zone and coupon code) as hidden inputs.
 */
class CheckoutComponent extends Component
{
    public string $deliveryZone = '';

    public string $couponCode = '';

    /** The code that actually validated, or '' when no coupon is applied. */
    public string $appliedCoupon = '';

    public string $couponMessage = '';

    public bool $couponFailed = false;

    public function mount(): void
    {
        $this->deliveryZone = (string) config('delivery.default_zone');
    }

    public function increaseQuantity(string $rowId): void
    {
        $item = Cart::instance('cart')->get($rowId);
        if (!$item) {
            return;
        }

        Cart::instance('cart')->update($rowId, $item->qty + 1);
        $this->cartChanged();
    }

    public function decreaseQuantity(string $rowId): void
    {
        $item = Cart::instance('cart')->get($rowId);
        // Never let the quantity drop below 1; use removecart to delete an item.
        if (!$item || $item->qty <= 1) {
            return;
        }

        Cart::instance('cart')->update($rowId, $item->qty - 1);
        $this->cartChanged();
    }

    public function removecart(string $rowId): void
    {
        Cart::instance('cart')->remove($rowId);
        $this->cartChanged();
    }

    public function applyCoupon(): void
    {
        $code = trim($this->couponCode);

        if ($code === '') {
            $this->couponFeedback('Enter a coupon code.', true);

            return;
        }

        if ($this->alreadyUsed($code)) {
            $this->couponFeedback('You have already used this coupon.', true);

            return;
        }

        if (!$this->findValidCoupon($code)) {
            $this->couponFeedback('Invalid coupon code or expired.', true);

            return;
        }

        $this->appliedCoupon = $code;
        $this->couponFeedback('Coupon applied successfully!', false);
    }

    public function removeCoupon(): void
    {
        $this->appliedCoupon = '';
        $this->couponCode = '';
        $this->couponFeedback('', false);
    }

    private function couponFeedback(string $message, bool $failed): void
    {
        $this->couponMessage = $message;
        $this->couponFailed = $failed;
    }

    private function alreadyUsed(string $code): bool
    {
        if (!Auth::guard('customer')->check()) {
            return false;
        }

        $customer = Auth::guard('customer')->user()->customer;

        // Only a COMPLETED order locks the coupon; an abandoned checkout must not.
        return $customer && AppliedCoupone::where('customer_id', $customer->id)
            ->where('coupone_code', $code)
            ->where('is_ordered', 1)
            ->exists();
    }

    private function findValidCoupon(string $code): ?Coupon
    {
        return Coupon::where('coupons_code', $code)
            ->where('status', 1)
            ->where('quantity', '>', 0)
            ->whereDate('end_date', '>=', now())
            ->first();
    }

    private function cartChanged(): void
    {
        $this->dispatch('cartRefresh')->to('cart-icon-component');
    }

    public function render()
    {
        $zones = config('delivery.zones', []);

        // A zone key that isn't configured must not silently become a free delivery.
        if (!isset($zones[$this->deliveryZone])) {
            $this->deliveryZone = (string) config('delivery.default_zone');
        }

        $subtotal = (float) Cart::instance('cart')->content()->sum(
            fn ($item) => $item->price * $item->qty
        );

        $deliveryCharge = (float) ($zones[$this->deliveryZone]['charge'] ?? 0);

        $discount = 0.0;
        if ($this->appliedCoupon !== '') {
            $coupon = $this->findValidCoupon($this->appliedCoupon);
            $discount = $this->discountFor($coupon, $subtotal);

            // The coupon ran out or expired while the page was open.
            if (!$coupon) {
                $this->appliedCoupon = '';
                $this->couponFeedback('That coupon is no longer available.', true);
            }
        }

        return view('livewire.checkout-component', [
            'zones' => $zones,
            'subtotal' => $subtotal,
            'deliveryCharge' => $deliveryCharge,
            'discount' => $discount,
            'total' => max(0, $subtotal - $discount + $deliveryCharge),
        ]);
    }

    /** Discount for a coupon against a subtotal, clamped to [0, subtotal]. */
    private function discountFor(?Coupon $coupon, float $subtotal): float
    {
        if (!$coupon) {
            return 0.0;
        }

        $discount = $coupon->discounts_type === 'percent'
            ? $subtotal * ((float) $coupon->percent_value / 100)
            : (float) $coupon->fixed;

        return (float) min(max($discount, 0), $subtotal);
    }
}
