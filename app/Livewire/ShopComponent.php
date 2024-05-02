<?php

namespace App\Livewire;

use App\Models\Size;
use App\Models\Color;
use Livewire\Component;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\Products;
use Livewire\WithPagination;
use App\Models\Product_image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class ShopComponent extends Component
{

    public function increaseQuantity($id)
    {
        $item = Cart::instance('cart')->get($id);
        $qty = $item->qty + 1;
        Cart::instance('cart')->update($id, $qty);
        $this->dispatch('cartRefresh')->to('cart-icon-component');
    }

    public function decreaseQuantity($id)
    {
        $item = Cart::instance('cart')->get($id);
        $qty = $item->qty - 1;
        Cart::instance('cart')->update($id,$qty);
        $this->dispatch('cartRefresh')->to('cart-icon-component');
    }
    public function removecart($id){
        Cart::instance('cart')->remove($id);
        Session::flash('success','Product removed from cart.');
        $this->dispatch('cartRefresh')->to('cart-icon-component');
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
        // $size = $product->sizes[0]->id;
        // if($product->colors){
        //     $color = $product->colors[0]->id;
        // }
        // else{
        //     $color = null;
        // }

        $item_slug = $product->slug;
        $item_image = Product_image::where('product_id',$id)->select('product_image')->first();
        Cart::instance('cart')->add($id,$item_name,1,$item_price, ['image' => $item_image,'slug' => $item_slug]);

        Session::flash('success','Product added To cart.');
        // return response()->json($data);
        // return redirect()->route('shop.cart');
        $this->dispatch('cartRefresh')->to('cart-icon-component');
            // print_r($offer_price);
    }

    public function AddToWishlist($id){

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
        $data = Cart::instance('wishlist')->add($id,$item_name,1,$item_price, ['slug' => $item_slug]);

        Session::flash('success','Product added To wishlist.');
        // return redirect()->route('shop.cart');

        $this->dispatch('cartRefresh')->to('wishlist-icon-component');
    }


    public $selectedColors = [], $colorBadge = [];
    public $selectedSizes = [], $sizeBadge = [];
    public $perPage = 12;
    // public $products,
    public $groupedCategories ;
    public $selectedBadges = [];
    public $selectedCategory ;
    // public $priceRange = [0, 10000]; // Initial price range

    public $min_value = 0;
    public $max_value = 10000;

    public function mount()
    {
        $this->selectedSizes = [];
        $this->selectedColors = [];

    }
    use WithPagination;

    public function changePerPage($value)
    {
        $this->perPage = $value;
    }

    public function render()
    {

        $productsQuery = Products::query();

        //  // Apply category filter if selected
         if ($this->selectedCategory) {
            // Assuming you have a relationship between products and categories
            $productsQuery->whereHas('category', function ($query) {
                $query->where('category_name', $this->selectedCategory);
            });
        }

        // Apply color filter if selected
        if (!empty($this->selectedColors)) {
            $productsQuery->whereHas('colors', function ($query) {
                $query->whereIn('color_id', $this->selectedColors);
            });
        }

        // Apply size filter if selected
        if (!empty($this->selectedSizes)) {
            $productsQuery->whereHas('sizes', function ($query) {
                $query->whereIn('size_id', $this->selectedSizes);
            });
        }

        $colors = Color::all();
        $sizes = Size::all();

        if ($this->min_value > 0 || $this->max_value < 10000) {
            $productsQuery->whereBetween('regular_price', [$this->min_value, $this->max_value]);
        }

        $this->groupedCategories = $this->getGroupedCategories();

        if(Auth::guard('customer')->check()){

            Cart::instance('wishlist')->store(Auth::guard('customer')->user()->email);

        }

        $campaign = Campaign::where('status','Published')->first();

        $products = $productsQuery->paginate($this->perPage);

        return view('livewire.shop-component', [
            'products' => $products,
            'groupedCategories' => $this->groupedCategories,
            'colors' => $colors,
            'sizes' => $sizes,
            'campaign' => $campaign,
        ]);
    }

    // protected function getFilteredProducts()
    // {
    //     return Products::whereBetween('regular_price', [$this->min_value, $this->max_value])->get();
    // }


    public function applyCategoryFilter($categoryName)
    {
        $this->selectedCategory = $categoryName;
        $this->updateSelectedBadges();
    }

    public function removeCategoryFilter()
    {
        $this->selectedCategory = null;
    }

    public function applyColorFilter($colorId)
    {
        if (in_array($colorId, $this->selectedColors)) {
            // Remove the color if already selected
            $this->selectedColors = array_diff($this->selectedColors, [$colorId]);
        } else {
            // Add the color if not selected
            $this->selectedColors[] = $colorId;
        }

        $this->updateSelectedBadges();
    }

    public function applySizeFilter($sizeId)
    {
        if (in_array($sizeId, $this->selectedSizes)) {
            // Remove the size if already selected
            $this->selectedSizes = array_diff($this->selectedSizes, [$sizeId]);
        } else {
            // Add the size if not selected
            $this->selectedSizes[] = $sizeId;
        }

        $this->updateSelectedBadges();
    }

    public function removeBadge($badge)
    {
        // Remove the selected color or size
        $colorNames = Color::whereIn('color_name', [$badge])->pluck('id')->toArray();
        $sizeNames = Size::whereIn('size_name', [$badge])->pluck('id')->toArray();

        // Use array_diff to remove the selected color or size
        $this->selectedColors = array_diff($this->selectedColors, $colorNames);
        $this->selectedSizes = array_diff($this->selectedSizes, $sizeNames);

        // Remove the selected category by name
        if ($badge === $this->selectedCategory) {
            $this->selectedCategory = null;
        }

        // Update the selected badges
        $this->updateSelectedBadges();
    }


    private function updateSelectedBadges()
    {
        $categoryBadge = $this->selectedCategory ? [$this->selectedCategory] : [];
        $colorNames = Color::whereIn('id', $this->selectedColors)->pluck('color_name')->toArray();
        $sizeNames = Size::whereIn('id', $this->selectedSizes)->pluck('size_name')->toArray();
        $this->selectedBadges = array_merge($colorNames, $sizeNames, $categoryBadge);
    }

    private function getGroupedCategories()
    {
        $parentCategories = Category::where('parent_category')->get();
        $groupedCategories = [];

        foreach ($parentCategories as $parentCategory) {
            $groupedCategories[$parentCategory->category_name] = $this->getChildren($parentCategory->category_name);
        }

        return $groupedCategories;
    }

    private function getChildren($categoryName)
    {
        $children = Category::where('parent_category', $categoryName)->get();

        foreach ($children as $child) {
            $child->children = $this->getChildren($child->category_name);
        }

        return $children;
    }

}
