<?php

namespace Tests\Feature;

use App\Livewire\CheckoutComponent;
use App\Models\Products;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CheckoutPageTest extends TestCase
{
    use RefreshDatabase;

    private Products $product;

    protected function setUp(): void
    {
        parent::setUp();

        $this->product = Products::firstOrFail();
        Cart::instance('cart')->destroy();
        Cart::instance('cart')->add(
            $this->product->id,
            $this->product->product_name,
            1,
            $this->product->regular_price,
            ['image' => null, 'slug' => $this->product->slug]
        );
    }

    public function test_checkout_page_renders_the_simplified_fields(): void
    {
        $response = $this->get(route('checkout'));

        $response->assertOk();
        $response->assertSee('name="fname"', false);
        $response->assertSee('name="lname"', false);
        $response->assertSee('name="phone"', false);
        $response->assertSee('name="email"', false);
        $response->assertSee('name="billing_address"', false);
        $response->assertSee('Inside Dhaka');
        $response->assertSee('Outside Dhaka');
        $response->assertSee('(optional)');
    }

    public function test_checkout_page_no_longer_asks_for_division_district_or_area(): void
    {
        $response = $this->get(route('checkout'));

        $response->assertDontSee('name="division"', false);
        $response->assertDontSee('name="district"', false);
        $response->assertDontSee('Ship to a different');
        $response->assertDontSee('Create an account?');
    }

    public function test_guests_are_offered_a_login_but_signed_in_customers_are_not(): void
    {
        // Anchor on the checkout login form itself: "Already have an account?" also
        // appears in the register modal that the layout renders on every page.
        $this->get(route('checkout'))
            ->assertOk()
            ->assertSee(route('checkout.login'), false);

        $login = \App\Models\Register_customer::create([
            'customer_id' => \App\Models\Customer::create([
                'firstName' => 'Arif',
                'lastName' => 'Hossen',
                'phone' => '01711000444',
                'email' => 'signedin@example.com',
                'status' => 'registerd',
            ])->id,
            'phone' => '01711000444',
            'email' => 'signedin@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('a-password-1'),
            'password_set_at' => now(),
            'status' => 'registerd',
        ]);

        $this->actingAs($login, 'customer')
            ->get(route('checkout'))
            ->assertOk()
            ->assertDontSee(route('checkout.login'), false);
    }

    public function test_the_login_panel_opens_when_checkout_finds_an_existing_account(): void
    {
        $response = $this->withSession(['show_login' => true])->get(route('checkout'));

        $response->assertOk();
        // Bootstrap only shows a collapsed panel when it carries the "show" class.
        $response->assertSee('login_form show', false);
    }

    public function test_switching_delivery_zone_updates_the_total(): void
    {
        $price = (float) $this->product->regular_price;

        Livewire::test(CheckoutComponent::class)
            ->assertSet('deliveryZone', 'inside_dhaka')
            ->assertSee(number_format($price + 60, 2))
            ->set('deliveryZone', 'outside_dhaka')
            ->assertSee(number_format($price + 120, 2));
    }

    public function test_an_unknown_zone_falls_back_to_the_default_rather_than_free_delivery(): void
    {
        $price = (float) $this->product->regular_price;

        Livewire::test(CheckoutComponent::class)
            ->set('deliveryZone', 'tampered')
            ->assertSet('deliveryZone', 'inside_dhaka')
            ->assertSee(number_format($price + 60, 2));
    }

    public function test_an_invalid_coupon_is_reported_and_applies_no_discount(): void
    {
        Livewire::test(CheckoutComponent::class)
            ->set('couponCode', 'NOPE-NOT-REAL')
            ->call('applyCoupon')
            ->assertSet('appliedCoupon', '')
            ->assertSet('couponFailed', true)
            ->assertSee('Invalid coupon code or expired.');
    }

    public function test_quantity_can_be_changed_and_never_drops_below_one(): void
    {
        $rowId = Cart::instance('cart')->content()->first()->rowId;

        Livewire::test(CheckoutComponent::class)
            ->call('increaseQuantity', $rowId);
        $this->assertSame(2, Cart::instance('cart')->get($rowId)->qty);

        Livewire::test(CheckoutComponent::class)
            ->call('decreaseQuantity', $rowId);
        $this->assertSame(1, Cart::instance('cart')->get($rowId)->qty);

        // Already at 1, so this must be a no-op rather than a 0/negative quantity.
        Livewire::test(CheckoutComponent::class)
            ->call('decreaseQuantity', $rowId);
        $this->assertSame(1, Cart::instance('cart')->get($rowId)->qty);
    }
}
