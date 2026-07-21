<?php

namespace App\Livewire;

use App\Models\Size;
use App\Models\Color;
use Livewire\Component;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\Products;
use Livewire\WithPagination;
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
        // Never let the quantity drop below 1; use removecart to delete an item.
        if (!$item || $item->qty <= 1) {
            return;
        }
        Cart::instance('cart')->update($id, $item->qty - 1);
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

        // Eager-load what the Blade view reads per product (product_images,
        // product_stocks, product_price via effectivePrice()) - none of this
        // was loaded before, so every product row on this page triggered 3
        // separate lazy-load queries. status=active is now filtered here in
        // SQL instead of in the Blade @foreach: filtering after ->paginate()
        // had already sliced the page meant a page could render with fewer
        // products than perPage (or none) whenever an inactive product fell
        // on that page, and "$products->total()" counted inactive products
        // that were never actually shown.
        $productsQuery = Products::with(['product_images', 'product_stocks', 'product_price'])
            ->where('status', 'active');

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
        // withCount('products') does one aggregate query for every size's
        // product count together, instead of $size->productCount() running a
        // fresh COUNT query per size inside the Blade @foreach on every render.
        $sizes = Size::withCount('products')->get();

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
        // Top-level categories have no parent_category. where('parent_category')
        // alone throws (Builder::where() needs a value or closure), so nothing
        // here ever rendered.
        $parentCategories = Category::whereNull('parent_category')->get();
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
