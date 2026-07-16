<?php

namespace Tests\Feature;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class SslCommerzCallbackTest extends TestCase
{
    use RefreshDatabase;

    /**
     * These branches used to redirect to route('order.fail'), which does not exist,
     * so the gateway callback threw a RouteNotFoundException instead of responding.
     */
    public function test_success_callback_without_an_order_id_does_not_throw(): void
    {
        Log::spy();
        $before = Order::count();

        $this->post('/success', ['tran_id' => 'abc123'])
            ->assertRedirect(route('home'));

        $this->assertSame($before, Order::count());
    }

    public function test_success_callback_for_an_unknown_order_does_not_throw(): void
    {
        Log::spy();

        $this->post('/success', ['tran_id' => 'abc123', 'value_a' => 999999])
            ->assertRedirect(route('home'));
    }

    public function test_success_callback_never_tells_a_charged_customer_the_payment_failed(): void
    {
        Log::spy();

        $this->post('/success', ['tran_id' => 'abc123', 'value_a' => 999999]);

        $message = session('danger');
        $this->assertNotNull($message);
        $this->assertStringContainsString('could not confirm', $message);
        $this->assertStringNotContainsString('failed', strtolower($message));
    }
}
