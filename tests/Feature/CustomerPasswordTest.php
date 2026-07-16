<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Register_customer;
use App\Notifications\CustomerSetPasswordNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Tests\TestCase;

class CustomerPasswordTest extends TestCase
{
    use RefreshDatabase;

    private function makeAccount(bool $needsPassword, ?string $email = 'shopper@example.com'): Register_customer
    {
        $customer = Customer::create([
            'firstName' => 'Arif',
            'lastName' => 'Hossen',
            'phone' => '01711000111',
            'email' => $email,
            'status' => 'registerd',
        ]);

        return Register_customer::create([
            'customer_id' => $customer->id,
            'phone' => $customer->phone,
            'email' => $email,
            'password' => Hash::make($needsPassword ? Str::random(40) : 'old-password-1'),
            'password_set_at' => $needsPassword ? null : now(),
            'status' => 'registerd',
        ]);
    }

    public function test_dashboard_prompts_for_a_password_when_one_was_never_set(): void
    {
        $login = $this->makeAccount(needsPassword: true);

        $this->actingAs($login, 'customer')
            ->get(route('customer.dashboard'))
            ->assertOk()
            ->assertSee('Finish setting up your account');
    }

    public function test_dashboard_does_not_prompt_once_a_password_is_set(): void
    {
        $login = $this->makeAccount(needsPassword: false);

        $this->actingAs($login, 'customer')
            ->get(route('customer.dashboard'))
            ->assertOk()
            ->assertDontSee('Finish setting up your account');
    }

    public function test_a_customer_on_a_generated_password_can_set_one_without_the_current_password(): void
    {
        $login = $this->makeAccount(needsPassword: true);

        $this->actingAs($login, 'customer')
            ->post(route('customer.password.store'), [
                'password' => 'my-new-password-1',
                'password_confirmation' => 'my-new-password-1',
            ])->assertRedirect(route('customer.dashboard'));

        $login->refresh();
        $this->assertTrue(Hash::check('my-new-password-1', $login->password));
        $this->assertFalse($login->needsPassword());
    }

    public function test_a_customer_with_a_password_must_confirm_it_before_changing(): void
    {
        $login = $this->makeAccount(needsPassword: false);

        // Without the current password.
        $this->actingAs($login, 'customer')
            ->post(route('customer.password.store'), [
                'password' => 'my-new-password-1',
                'password_confirmation' => 'my-new-password-1',
            ])->assertSessionHasErrors('current_password');

        // With the wrong current password.
        $this->actingAs($login, 'customer')
            ->post(route('customer.password.store'), [
                'current_password' => 'wrong-password',
                'password' => 'my-new-password-1',
                'password_confirmation' => 'my-new-password-1',
            ])->assertSessionHasErrors('current_password');

        $login->refresh();
        $this->assertTrue(Hash::check('old-password-1', $login->password));

        // With the right one.
        $this->actingAs($login, 'customer')
            ->post(route('customer.password.store'), [
                'current_password' => 'old-password-1',
                'password' => 'my-new-password-1',
                'password_confirmation' => 'my-new-password-1',
            ])->assertRedirect(route('customer.dashboard'));

        $login->refresh();
        $this->assertTrue(Hash::check('my-new-password-1', $login->password));
    }

    public function test_mismatched_confirmation_is_rejected(): void
    {
        $login = $this->makeAccount(needsPassword: true);

        $this->actingAs($login, 'customer')
            ->post(route('customer.password.store'), [
                'password' => 'my-new-password-1',
                'password_confirmation' => 'something-else-2',
            ])->assertSessionHasErrors('password');

        $this->assertTrue($login->refresh()->needsPassword());
    }

    public function test_password_setup_link_is_emailed_to_a_new_customer_who_gave_an_email(): void
    {
        Notification::fake();

        $this->travelTo(now());

        $product = \App\Models\Products::firstOrFail();
        \Gloudemans\Shoppingcart\Facades\Cart::instance('cart')->destroy();
        \Gloudemans\Shoppingcart\Facades\Cart::instance('cart')->add(
            $product->id, $product->product_name, 1, $product->regular_price,
            ['image' => null, 'slug' => $product->slug]
        );

        $this->post(route('order.store'), [
            'fname' => 'Arif',
            'lname' => 'Hossen',
            'phone' => '01711000222',
            'email' => 'newbuyer@example.com',
            'billing_address' => '12 Green Road',
            'delivery_zone' => 'inside_dhaka',
            'payment_mode' => 'cod',
        ])->assertRedirect(route('thankyou'));

        $login = Register_customer::where('phone', '01711000222')->firstOrFail();

        Notification::assertSentTo($login, CustomerSetPasswordNotification::class, function ($notification) {
            return $notification->isFirstTimeSetup === true;
        });
    }

    public function test_no_link_is_attempted_when_the_new_customer_gave_no_email(): void
    {
        Notification::fake();

        $product = \App\Models\Products::firstOrFail();
        \Gloudemans\Shoppingcart\Facades\Cart::instance('cart')->destroy();
        \Gloudemans\Shoppingcart\Facades\Cart::instance('cart')->add(
            $product->id, $product->product_name, 1, $product->regular_price,
            ['image' => null, 'slug' => $product->slug]
        );

        $this->post(route('order.store'), [
            'fname' => 'Arif',
            'lname' => 'Hossen',
            'phone' => '01711000333',
            'email' => '',
            'billing_address' => '12 Green Road',
            'delivery_zone' => 'inside_dhaka',
            'payment_mode' => 'cod',
        ])->assertRedirect(route('thankyou'));

        // The order itself still notifies admin; only the password link must be absent.
        Notification::assertNotSentTo(
            Register_customer::where('phone', '01711000333')->firstOrFail(),
            CustomerSetPasswordNotification::class
        );
    }

    public function test_an_emailed_link_lets_the_customer_set_a_password(): void
    {
        $login = $this->makeAccount(needsPassword: true);

        $token = app('auth.password')->broker('customers')->createToken($login);

        $this->get(route('customer.password.reset', ['token' => $token, 'email' => $login->email]))
            ->assertOk()
            ->assertSee('Set your password');

        $this->post(route('customer.password.update'), [
            'token' => $token,
            'email' => $login->email,
            'password' => 'link-password-1',
            'password_confirmation' => 'link-password-1',
        ])->assertRedirect(route('customer.dashboard'));

        $login->refresh();
        $this->assertTrue(Hash::check('link-password-1', $login->password));
        $this->assertFalse($login->needsPassword());
    }

    public function test_the_setup_email_renders_with_a_working_link(): void
    {
        // Notification::fake() never renders the mail, so a broken route name or
        // template in toMail() would otherwise go unnoticed until a real send.
        $login = $this->makeAccount(needsPassword: true);

        $mail = (new CustomerSetPasswordNotification('tok-123', true))->toMail($login);
        $rendered = html_entity_decode((string) $mail->render());

        $this->assertSame('Set your password', $mail->subject);
        $this->assertStringContainsString('Set password', $rendered);
        $this->assertStringContainsString(
            route('customer.password.reset', ['token' => 'tok-123', 'email' => $login->email], false),
            $rendered
        );
    }

    public function test_the_reset_email_uses_reset_wording_for_an_existing_password(): void
    {
        $login = $this->makeAccount(needsPassword: false);

        $mail = (new CustomerSetPasswordNotification('tok-123', false))->toMail($login);
        $rendered = (string) $mail->render();

        $this->assertSame('Reset your password', $mail->subject);
        $this->assertStringContainsString('Reset password', $rendered);
        $this->assertStringNotContainsString('An account was created for you', $rendered);
    }

    public function test_a_bogus_reset_token_is_rejected(): void
    {
        $login = $this->makeAccount(needsPassword: true);

        $this->post(route('customer.password.update'), [
            'token' => 'not-a-real-token',
            'email' => $login->email,
            'password' => 'link-password-1',
            'password_confirmation' => 'link-password-1',
        ])->assertSessionHasErrors('email');

        $this->assertTrue($login->refresh()->needsPassword());
    }

    public function test_setting_a_password_requires_being_logged_in(): void
    {
        $this->post(route('customer.password.store'), [
            'password' => 'my-new-password-1',
            'password_confirmation' => 'my-new-password-1',
        ])->assertRedirect();

        $this->assertGuest('customer');
    }

    public function test_customer_reset_tokens_do_not_share_the_staff_table(): void
    {
        $login = $this->makeAccount(needsPassword: true);

        app('auth.password')->broker('customers')->createToken($login);

        $this->assertDatabaseCount('customer_password_reset_tokens', 1);
        $this->assertDatabaseCount('password_reset_tokens', 0);
    }
}
