<div>
    @if (Cart::instance('cart')->count() > 0)

        <div class="table-responsive order_table">
            <table class="table">
                <thead>
                    <tr>
                        <th colspan="2">Product</th>
                        <th class="text-end">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (Cart::instance('cart')->content() as $item)
                        <tr>
                            <td class="image product-thumbnail">
                                @if ($item->options->image)
                                    <img src="{{ asset('storage/product_images/' . $item->options->image->product_image) }}"
                                        alt="{{ $item->name }}">
                                @endif
                            </td>
                            <td>
                                <h5>
                                    <a href="{{ route('product.detail', ['slug' => $item->options->slug]) }}">{{ $item->name }}</a>
                                </h5>
                                <span class="product-qty mt-4">
                                    <a href="#" wire:click.prevent="decreaseQuantity('{{ $item->rowId }}')" class="qty-down">
                                        <i class="fi-rs-angle-small-down"></i>
                                    </a>
                                    <span class="qty-val">{{ $item->qty }}</span>
                                    <a href="#" wire:click.prevent="increaseQuantity('{{ $item->rowId }}')" class="qty-up">
                                        <i class="fi-rs-angle-small-up"></i>
                                    </a>
                                </span>
                                <a href="#" wire:click.prevent="removecart('{{ $item->rowId }}')"
                                    class="text-muted font-xs d-block mt-2">Remove</a>
                            </td>
                            <td class="text-end">৳{{ number_format($item->price * $item->qty, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Delivery option --}}
        <div class="mt-30 mb-20">
            <h5>Delivery Option <span class="text-danger">*</span></h5>
        </div>
        <div class="payment_option mb-20">
            @foreach ($zones as $key => $zone)
                <div class="custome-radio">
                    <input class="form-check-input" type="radio" name="delivery_zone"
                        id="zone_{{ $key }}" value="{{ $key }}" wire:model.live="deliveryZone"
                        @checked($deliveryZone === $key)>
                    <label class="form-check-label" for="zone_{{ $key }}">
                        {{ $zone['label'] }} &mdash; ৳{{ number_format($zone['charge'], 2) }}
                    </label>
                </div>
            @endforeach
        </div>

        {{-- Coupon --}}
        <div class="mb-20">
            @if ($appliedCoupon !== '')
                <div class="d-flex align-items-center justify-content-between">
                    <span>Coupon <strong>{{ $appliedCoupon }}</strong> applied.</span>
                    <a href="#" wire:click.prevent="removeCoupon" class="text-danger font-xs">Remove</a>
                </div>
            @else
                <div class="d-flex" style="gap: 10px;">
                    <input type="text" class="form-control" placeholder="Coupon code" wire:model="couponCode"
                        wire:keydown.enter.prevent="applyCoupon">
                    <button type="button" class="btn btn-md" wire:click="applyCoupon">Apply</button>
                </div>
            @endif

            @if ($couponMessage !== '')
                <p class="font-xs mt-2 mb-0 {{ $couponFailed ? 'text-danger' : 'text-success' }}">
                    {{ $couponMessage }}
                </p>
            @endif
        </div>

        {{-- Totals --}}
        <div class="table-responsive order_table">
            <table class="table">
                <tbody>
                    <tr>
                        <th>Subtotal</th>
                        <td class="text-end">৳{{ number_format($subtotal, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Delivery Charge</th>
                        <td class="text-end">৳{{ number_format($deliveryCharge, 2) }}</td>
                    </tr>
                    @if ($discount > 0)
                        <tr>
                            <th>Discount</th>
                            <td class="text-end">&minus;৳{{ number_format($discount, 2) }}</td>
                        </tr>
                    @endif
                    <tr>
                        <th>Total</th>
                        <td class="text-end">
                            <span class="font-xl text-brand fw-900">৳{{ number_format($total, 2) }}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- The customer's choices travel with the form; the server recomputes every
             amount from these, so no total is ever taken from the client. --}}
        <input type="hidden" name="coupon_code" value="{{ $appliedCoupon }}">
    @else
        <h5>No item found.</h5>
    @endif
</div>
