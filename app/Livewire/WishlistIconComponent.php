<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class WishlistIconComponent extends Component
{

    public function increaseQuantity($id)
    {
        $item = Cart::instance('wishlist')->get($id);
        $qty = $item->qty + 1;
        Cart::instance('wishlist')->update($id, $qty);
        $this->dispatch('cartRefresh')->to('cart-icon-component');
    }

    public function decreaseQuantity($id)
    {
        $item = Cart::instance('wishlist')->get($id);
        // Never let the quantity drop below 1; use removecart to delete an item.
        if ($item->qty <= 1) {
            return;
        }
        $qty = $item->qty - 1;
        Cart::instance('wishlist')->update($id,$qty);
        $this->dispatch('cartRefresh')->to('cart-icon-component');

    }
    public function removecart($id){
        Cart::instance('wishlist')->remove($id);
        Session::flash('success','Product removed from wishlist.');
        $this->dispatch('cartRefresh')->to('cart-icon-component');
    }

    #[On('cartRefresh')]

    public function render()
    {
        return view('livewire.wishlist-icon-component');
    }
}
