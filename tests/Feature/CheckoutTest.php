<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Products;
use App\Models\Register_customer;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    use RefreshDatabase;

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

    public function test_a_new_customer_is_registered_and_signed_in_by_checking_out(): void
    {
        $this->addProductToCart();
        $this->post(route('order.store'), $this->validPayload())->assertRedirect(route('thankyou'));

        $customer = Customer::where('phone', '01711000111')->firstOrFail();
        $login = Register_customer::where('customer_id', $customer->id)->firstOrFail();

        $this->assertAuthenticatedAs($login, 'customer');
        $this->assertSame('registerd', $customer->status);
        // Still on the generated password, so the dashboard must prompt for one.
        $this->assertTrue($login->needsPassword());
    }

    public function test_the_generated_password_is_not_the_phone_number(): void
    {
        $this->addProductToCart();
        $this->post(route('order.store'), $this->validPayload());

        $login = Register_customer::where('phone', '01711000111')->firstOrFail();

        $this->assertFalse(Hash::check('01711000111', $login->password));
    }

    public function test_a_returning_phone_must_log_in_instead_of_ordering_as_a_guest(): void
    {
        $this->addProductToCart();
        $this->post(route('order.store'), $this->validPayload())->assertRedirect(route('thankyou'));
        Auth::guard('customer')->logout();

        $before = Order::count();
        $this->addProductToCart();

        $this->post(route('order.store'), $this->validPayload([
            'fname' => 'Impostor',
            'billing_address' => '99 Somewhere Else',
        ]))
            ->assertRedirect(route('checkout'))
            ->assertSessionHasErrors('login_identifier');

        $this->assertSame($before, Order::count());
        $this->assertGuest('customer');

        // The impostor's details never reached the existing customer's profile.
        $customer = Customer::where('phone', '01711000111')->firstOrFail();
        $this->assertSame('Arif', $customer->firstName);
        $this->assertSame('12 Green Road, Dhanmondi', $customer->billing_address);
    }

    public function test_a_returning_email_must_log_in_even_with_a_new_phone(): void
    {
        $this->addProductToCart();
        $this->post(route('order.store'), $this->validPayload(['email' => 'repeat@example.com']));
        Auth::guard('customer')->logout();

        $before = Order::count();
        $this->addProductToCart();

        $this->post(route('order.store'), $this->validPayload([
            'phone' => '01799999999',
            'email' => 'repeat@example.com',
        ]))->assertSessionHasErrors('login_identifier');

        $this->assertSame($before, Order::count());
    }

    public function test_a_blank_email_never_matches_an_existing_account(): void
    {
        // Two different people who both leave email blank must not collide.
        $this->addProductToCart();
        $this->post(route('order.store'), $this->validPayload(['email' => '']))
            ->assertRedirect(route('thankyou'));
        Auth::guard('customer')->logout();

        $this->addProductToCart();
        $this->post(route('order.store'), $this->validPayload([
            'phone' => '01788888888',
            'email' => '',
        ]))->assertRedirect(route('thankyou'));
    }

    public function test_an_existing_customer_can_log_in_from_checkout_and_keep_their_cart(): void
    {
        $this->addProductToCart();
        $this->post(route('order.store'), $this->validPayload());
        $login = Register_customer::where('phone', '01711000111')->firstOrFail();
        $login->forceFill(['password' => Hash::make('secret-pass-1'), 'password_set_at' => now()])->save();
        Auth::guard('customer')->logout();

        $this->addProductToCart();
        $this->post(route('checkout.login'), [
            'login_identifier' => '01711000111',
            'password' => 'secret-pass-1',
        ])->assertRedirect(route('checkout'));

        $this->assertAuthenticatedAs($login, 'customer');
        $this->assertSame(1, Cart::instance('cart')->count());
    }

    public function test_checkout_login_rejects_a_wrong_password(): void
    {
        $this->addProductToCart();
        $this->post(route('order.store'), $this->validPayload());
        Auth::guard('customer')->logout();

        $this->post(route('checkout.login'), [
            'login_identifier' => '01711000111',
            'password' => 'not-the-password',
        ])->assertSessionHasErrors('login_identifier');

        $this->assertGuest('customer');
    }

    public function test_a_logged_in_customer_updates_their_own_profile(): void
    {
        $this->addProductToCart();
        $this->post(route('order.store'), $this->validPayload());
        $customer = Customer::where('phone', '01711000111')->firstOrFail();

        // Checkout signed them in, so a second order goes through the authenticated path.
        $this->addProductToCart();
        $this->post(route('order.store'), $this->validPayload([
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
