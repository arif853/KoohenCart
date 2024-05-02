<?php

namespace App\Livewire;

use App\Models\Size;
use App\Models\Color;
use Livewire\Component;
use App\Models\Campaign;
use App\Models\Products;
use App\Models\Product_image;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Attributes\On;

class ProductComponent extends Component
{

    public $slug;

    public function mount($slug)
    {
        $this->slug= $slug;
    }
    public function store($id)
    {
        $product = Products::find($id);
        $item_name = $product->product_name;
        $offer_price = $product->product_price->offer_price;
       $campaign = Campaign::where('status','Published')->first();
        $flag = 0;
        if ($campaign) {
            $camp_products = $campaign->camp_product;

            foreach ($camp_products as $key => $camp_product) {
                if ($product->id == $camp_product->product_id) {

                    $camp_price = $camp_product->camp_price;
                    $flag = 1;
                }
            }
        }

        if( $flag == 1)
        {
            $item_price = $camp_price;
        }
        elseif($offer_price > 0)
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
    public function buyNow($id)
    {
        $product = Products::find($id);
        $item_id = $product->id;
        $item_name = $product->product_name;
        $item_qty = session()->get('quantity') + 1;
        $item_size = session()->get('product_size');
        $item_color = session()->get('product_color');

        $offer_price = $product->product_price->offer_price;
        $campaign = Campaign::where('status','Published')->first();
        $flag = 0;
        if ($campaign) {
            $camp_products = $campaign->camp_product;

            foreach ($camp_products as $key => $camp_product) {
                if ($product->id == $camp_product->product_id) {

                    $camp_price = $camp_product->camp_price;
                    $flag = 1;
                }
            }
        }

        if( $flag == 1)
        {
            $item_price = $camp_price;
        }
        elseif($offer_price > 0)
        {
            $item_price = $offer_price;
        }
        else{
            $item_price = $product->regular_price;
        }
        // $item_price = ($offer_price > 0) ? $offer_price : $product->regular_price;

        $item_slug = $product->slug;
        $item_image = Product_image::where('product_id', $id)->select('product_image')->first();
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

    public function render()
    {
        $product = Products::with([
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
            'product_thumbnail',
            'product_stocks',
        ])->where('slug', $this->slug)->first();

        return view('livewire.product-component',['product'=>$product]);
    }
}
