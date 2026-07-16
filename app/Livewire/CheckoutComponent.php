<?php

namespace App\Livewire;

use App\Models\Customer;
use Livewire\Component;
use App\Models\Postcode;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;


class CheckoutComponent extends Component
{

    public $deliveryCharge = 0;

    #[On('postOfficeChanged')]

    public function postOfficeChanged($zoneCharge)
    {
        $this->deliveryCharge = $zoneCharge;
        // dd($this->deliveryCharge);
    }

    public function increaseQuantity($rowId)
    {
        $item = Cart::instance('cart')->get($rowId);
        $qty = $item->qty + 1;
        Cart::instance('cart')->update($rowId, $qty);
        $this->dispatch('cartRefresh')->to('cart-icon-component');
        $this->dispatch('refresh')->to('checkout-component');
    }

    public function decreaseQuantity($rowId)
    {
        $item = Cart::instance('cart')->get($rowId);
        // Never let the quantity drop below 1; use removecart to delete an item.
        if ($item->qty <= 1) {
            return;
        }
        $qty = $item->qty - 1;
        Cart::instance('cart')->update($rowId,$qty);
        $this->dispatch('cartRefresh')->to('cart-icon-component');
        // $this->dispatch('refresh')->to('checkout-component');
    }

    public function removecart($id){
        Cart::instance('cart')->remove($id);
        Session::flash('success','Product removed from cart.');
        $this->dispatch('cartRefresh')->to('cart-icon-component');
        // $this->dispatch('refresh')->to('checkout-component');
    }

    // #[On('postOfficeChanged')]

    public function render()
    {
        if(auth()->guard('customer')->check())
        {
            $user = auth()->guard('customer')->user();
            $customer = Customer::find($user->customer_id);
            // Guard against a missing/invalid saved area so the checkout page
            // doesn't 500 on a null Postcode.
            $postOffice = $customer ? Postcode::find($customer->area) : null;
            $this->deliveryCharge = $postOffice->zone_charge ?? 0;
        }

        return view('livewire.checkout-component', [
            'deliveryCharge' => $this->deliveryCharge,
        ]);
    }

}
