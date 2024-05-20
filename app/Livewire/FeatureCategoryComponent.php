<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Campaign;
use App\Models\Products;
use App\Models\Product_image;
use App\Models\Feature_category;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class FeatureCategoryComponent extends Component
{
    public $product;

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
        $item_slug = $product->slug;
        $item_image = Product_image::where('product_id',$id)->select('product_image')->first();
        $data = Cart::add($id,$item_name,1,$item_price, ['image' => $item_image,'slug' => $item_slug]);
        Session::flash('success','Product added To cart.');
        // return redirect()->route('shop.cart');
        $this->dispatch('cartRefresh')->to('cart-icon-component');

    }

    public function render()
    {
        // $cat_features = Feature_category::where('status', 'Active')->first();

        // $items = Products::with([
        //     'overviews',
        //     'product_infos',
        //     'product_images',
        //     'product_extras',
        //     'tags',
        //     'sizes',
        //     'colors',
        //     'brand',
        //     'category',
        //     'subcategory',
        //     'product_price'

        // ])->where('category_id', $cat_features->category_id)->get();

        // $products = $items->filter(function ($product) {

        //     // Calculate total stock balance for the product
        //     $totalStock = $product->product_stocks->sum(function ($stock) {
        //         return $stock->inStock - $stock->outStock;
        //     });
        //     // Add a property to the product object with the total stock balance
        //     $product->totalStock = $totalStock;

        //     // Return true if total stock balance is greater than zero
        //     return $totalStock > 0;
        // });

        return view('livewire.feature-category-component');
    }
}
