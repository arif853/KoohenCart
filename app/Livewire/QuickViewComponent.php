<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Products;
use Livewire\Attributes\On;
use App\Models\Product_image;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class QuickViewComponent extends Component
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
        Cart::instance('cart')->add($id,$item_name,1,$item_price, ['image' => $item_image,'slug' => $item_slug]);

        Session::flash('success','Product added To cart.');
        $this->dispatch('cartRefresh')->to('cart-icon-component');

        return redirect()->route('cart');

    }

    // buy now product by cart
    public $productId;
    
    public function buyNow()
    {
        $product = Products::find($this->productId);

        $item_id = $product->id;
        $item_name = $product->product_name;

        $item_qty = session()->get('quantity') + 1;
        $item_size = session()->get('product_size');
        $item_color = session()->get('product_color');

        $offer_price = $product->product_price->offer_price;
        $item_price = ($offer_price > 0) ? $offer_price : $product->regular_price;

        $item_slug = $product->slug;
        $item_image = Product_image::where('product_id', $this->productId)->select('product_image')->first();

        $item_data = Cart::instance('cart')->add($item_id,$item_name,$item_qty,$item_price,
        ['image' => $item_image,
        'slug' => $item_slug,
        'size' => $item_size,
        'color' =>$item_color ]);

        // $item_data = [
        //     'item_id' => $item_id,
        //     'item_name' => $item_name,
        //     'item_qty' => $item_qty,
        //     'item_price' => $item_price,
        //     'item_slug' => $item_slug,
        //     'item_image' => $item_image ? $item_image->product_image : null,
        // ];
        // Session::put('item_data', $item_data );

        session()->forget('quantity');
        session()->forget('product_size');
        session()->forget('product_color');

        Session::flash('success', 'Product added to cart.');
            // return response()->json( $item_data);
        return redirect()->route('checkout');
    }

    #[On('qtyRefresh')]

    #[On('showQuickViewModal')]


    public function render()
    {
        return view('livewire.quick-view-component');
    }

}
