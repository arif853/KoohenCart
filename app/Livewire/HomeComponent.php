<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Campaign;
use App\Models\Products;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

class HomeComponent extends Component
{

    use WithPagination;
    // public $products;

    public function store($id)
    {
        $product = Products::find($id);
        if (!$product) {
            Session::flash('danger', 'That product is no longer available.');
            return;
        }

        $image = $product->primaryImage();
        Cart::instance('cart')->add(
            $id,
            $product->product_name,
            1,
            $product->effectivePrice(),
            ['image' => $image, 'slug' => $product->slug]
        );

        Session::flash('success','Product added To cart.');
        $this->dispatch('cartRefresh')->to('cart-icon-component');
    }

    public function AddToWishlist($id){

        $product = Products::find($id);
        if (!$product) {
            Session::flash('danger', 'That product is no longer available.');
            return;
        }

        Cart::instance('wishlist')->add(
            $id,
            $product->product_name,
            1,
            $product->effectivePrice(),
            ['slug' => $product->slug]
        );

        Session::flash('success','Product added To wishlist.');
        $this->dispatch('cartRefresh')->to('wishlist-icon-component');
    }

    public $paginate = 8;

    public function render()
    {
        // $products = Products::all();
        $products = Products::with([
            'overviews',
            'product_infos',
            'product_images',
            'product_extras',
            'tags',
            'sizes',
            'colors',
            'brand',
            'category',
            'subcategory',
            'product_price',
            'product_stocks'
        ])->where('status','active')->paginate($this->paginate);

         if(Auth::guard('customer')->check()){
            Cart::instance('wishlist')->store(Auth::guard('customer')->user()->email);
        }
                $campaign = Campaign::where('status','Published')->first();

        // print_r($products);
        return view('livewire.home-component',['products'=> $products,'campaign' => $campaign]);
    }

    public function loadMore()
    {
        $this->paginate += 4;
    }

}
