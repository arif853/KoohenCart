<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Products;
use App\Models\Register_customer;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    use DatabaseTransactions;

    private Products $product;

    protected function setUp(): void
    {
        parent::setUp();

        $this->product = Products::firstOrFail();
        Cart::instance('cart')->destroy();
    }

    private function addProductToCart(int $qty = 1): void
    {
        Cart::instance('cart')->add(
            $this->product->id,
            $this->product->product_name,
            $qty,
            $this->product->regular_price,
            ['image' => null, 'slug' => $this->product->slug]
        );
    }

    private function validPayload(array $overrides = []): array
    {
        return array_merge([
            'fname' => 'Arif',
            'lname' => 'Hossen',
            'phone' => '01711000111',
            'email' => '',
            'billing_address' => '12 Green Road, Dhanmondi',
            'delivery_zone' => 'inside_dhaka',
            'payment_mode' => 'cod',
        ], $overrides);
    }

    public function test_guest_can_place_an_order_without_an_email(): void
    {
        $this->addProductToCart();

        $response = $this->post(route('order.store'), $this->validPayload());

        $response->assertRedirect(route('thankyou'));

        $order = Order::latest('id')->first();
        $this->assertNotNull($order);
        $this->assertNull($order->customer->email);
        $this->assertSame('inside_dhaka', $order->delivery_zone);
        $this->assertEquals(60, $order->delivery_charge);
        $this->assertEquals((float) $this->product->regular_price, (float) $order->subtotal);
        $this->assertEquals((float) $this->product->regular_price + 60, (float) $order->total);
    }

    public function test_outside_dhaka_uses_the_higher_delivery_charge(): void
    {
        $this->addProductToCart();

        $this->post(route('order.store'), $this->validPayload([
            'delivery_zone' => 'outside_dhaka',
        ]))->assertRedirect(route('thankyou'));

        $order = Order::latest('id')->first();
        $this->assertEquals(120, $order->delivery_charge);
        $this->assertEquals((float) $this->product->regular_price + 120, (float) $order->total);
    }

    public function test_order_stores_a_shipping_row_and_clears_the_cart(): void
    {
        $this->addProductToCart(2);

        $this->post(route('order.store'), $this->validPayload());

        $order = Order::latest('id')->first();

        $this->assertNotNull($order->shipping);
        $this->assertSame('12 Green Road, Dhanmondi', $order->shipping->shipping_add);
        $this->assertSame('01711000111', $order->shipping->s_phone);
        $this->assertSame(2, $order->order_item->first()->quantity);
        $this->assertSame(0, Cart::instance('cart')->count());
    }

    public function test_an_unknown_delivery_zone_is_rejected(): void
    {
        $this->addProductToCart();
        // Counts are relative: this suite runs against a database that may already
        // hold real orders.
        $before = Order::count();

        $this->post(route('order.store'), $this->validPayload([
            'delivery_zone' => 'moon',
        ]))->assertSessionHasErrors('delivery_zone');

        $this->assertSame($before, Order::count());
    }

    public function test_delivery_charge_cannot_be_forced_to_zero_from_the_form(): void
    {
        $this->addProductToCart();

        // A tampered form posting its own totals must not change what is charged.
        $this->post(route('order.store'), $this->validPayload([
            'shipping_cost' => 0,
            'total_amount' => 1,
            'subtotal' => 1,
            'discount' => 9999,
        ]));

        $order = Order::latest('id')->first();
        $this->assertEquals(60, $order->delivery_charge);
        $this->assertEquals(0, $order->discount);
        $this->assertEquals((float) $this->product->regular_price + 60, (float) $order->total);
    }

    public function test_name_phone_address_and_zone_are_required(): void
    {
        $this->addProductToCart();

        $this->post(route('order.store'), [])
            ->assertSessionHasErrors(['fname', 'lname', 'phone', 'billing_address', 'delivery_zone']);
    }

    public function test_an_invalid_email_is_rejected_but_a_blank_one_is_not(): void
    {
        $this->addProductToCart();

        $this->post(route('order.store'), $this->validPayload(['email' => 'not-an-email']))
            ->assertSessionHasErrors('email');

        $this->post(route('order.store'), $this->validPayload(['email' => 'a@b.com']))
            ->assertSessionHasNoErrors();
    }

    public function test_checkout_with_an_empty_cart_redirects_to_the_cart(): void
    {
        $this->get(route('checkout'))->assertRedirect(route('cart'));

        $this->post(route('order.store'), $this->validPayload())
            ->assertRedirect(route('cart'));
    }

    public function test_a_repeat_guest_with_the_same_phone_can_order_again(): void
    {
        $before = Order::count();

        $this->addProductToCart();
        $this->post(route('order.store'), $this->validPayload())->assertRedirect(route('thankyou'));

        $this->addProductToCart();
        $this->post(route('order.store'), $this->validPayload())->assertRedirect(route('thankyou'));

        $this->assertSame($before + 2, Order::count());
    }

    public function test_a_guest_cannot_overwrite_an_existing_customers_saved_profile(): void
    {
        $this->addProductToCart();
        $this->post(route('order.store'), $this->validPayload());

        $customer = Customer::where('phone', '01711000111')->firstOrFail();
        $this->assertSame('Arif', $customer->firstName);

        // Someone else places an order typing the same phone number.
        $this->addProductToCart();
        $this->post(route('order.store'), $this->validPayload([
            'fname' => 'Impostor',
            'lname' => 'Person',
            'email' => 'impostor@example.com',
            'billing_address' => '99 Somewhere Else',
        ]))->assertRedirect(route('thankyou'));

        // The saved profile is untouched...
        $customer->refresh();
        $this->assertSame('Arif', $customer->firstName);
        $this->assertNull($customer->email);
        $this->assertSame('12 Green Road, Dhanmondi', $customer->billing_address);

        // ...but the new order still ships to the address that was actually given.
        $order = Order::latest('id')->first();
        $this->assertSame('99 Somewhere Else', $order->deliveryDetails()->address);
        $this->assertSame('Impostor Person', $order->deliveryDetails()->name);
    }

    public function test_a_logged_in_customer_updates_their_own_profile(): void
    {
        $this->addProductToCart();
        $this->post(route('order.store'), $this->validPayload());
        $customer = Customer::where('phone', '01711000111')->firstOrFail();

        $login = Register_customer::where('customer_id', $customer->id)->firstOrFail();

        $this->addProductToCart();
        $this->actingAs($login, 'customer')
            ->post(route('order.store'), $this->validPayload([
                'billing_address' => '7 New Road, Banani',
            ]))->assertRedirect(route('thankyou'));

        $customer->refresh();
        $this->assertSame('7 New Road, Banani', $customer->billing_address);
    }

    public function test_delivery_details_fall_back_to_the_profile_for_a_legacy_order(): void
    {
        $this->addProductToCart();
        $this->post(route('order.store'), $this->validPayload());

        $order = Order::latest('id')->first();
        // Orders placed before the simplified checkout may have no shipping row.
        $order->shipping->delete();
        $order->refresh()->load('shipping');

        $details = $order->deliveryDetails();
        $this->assertSame('Arif Hossen', $details->name);
        $this->assertSame('01711000111', $details->phone);
        $this->assertSame('12 Green Road, Dhanmondi', $details->address);
    }

    public function test_delivery_details_come_from_the_order_not_the_latest_profile(): void
    {
        // First order to one address.
        $this->addProductToCart();
        $this->post(route('order.store'), $this->validPayload([
            'billing_address' => 'First Address',
        ]));
        $first = Order::latest('id')->first();

        // A later order from the same phone to a different address must not
        // retroactively change where the first order was going.
        $this->addProductToCart();
        $this->post(route('order.store'), $this->validPayload([
            'billing_address' => 'Second Address',
        ]));
        $second = Order::latest('id')->first();

        $this->assertSame('First Address', $first->fresh()->deliveryDetails()->address);
        $this->assertSame('Second Address', $second->fresh()->deliveryDetails()->address);
    }
}
