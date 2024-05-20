<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Products;
use App\Models\Product_image;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class WishlistComponent extends Component
{

    public function store($id)
    {
        $product = Products::find($id);
        $item_name = $product->product_name;
        $offer_price = $product->product_price->offer_price;
        if($offer_price > 0)
        {
            $item_price = $offer_price;
        }
        else{
            $item_price = $product->regular_price;
        }
            // $item_price = $product->regular_price;
        $item_slug = $product->slug;
        $item_image = Product_image::where('product_id',$id)->select('product_image')->first();
        $data = Cart::instance('cart')->add($id,$item_name,1,$item_price, ['image' => $item_image,'slug' => $item_slug]);

        Session::flash('success','Product added To cart.');

        $this->dispatch('cartRefresh')->to('cart-icon-component');

    }

    public function removewish($id){
       
        if(Auth::guard('customer')->check()){

            $userEmail = Auth::guard('customer')->user()->email;

            // Use parameter binding to avoid SQL injection
            DB::delete('DELETE FROM shoppingcart WHERE identifier = ?', [$userEmail]);

            // Destroy the entire wishlist for the authenticated customer
            Cart::instance('wishlist')->destroy($userEmail);

        }else{
            Cart::instance('wishlist')->remove($id);
            Session::flash('success','Product removed from wishlist.');
        }

        $this->dispatch('cartRefresh')->to('wishlist-icon-component');
    }

    public function render()
    {
        if(Auth::guard('customer')->check()){
            Cart::instance('wishlist')->restore(Auth::guard('customer')->user()->email);
            $this->dispatch('cartRefresh')->to('wishlist-icon-component');
        }
        return view('livewire.wishlist-component');
    }
}
