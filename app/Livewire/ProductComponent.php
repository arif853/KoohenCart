<?php

namespace App\Livewire;

use App\Models\Size;
use Livewire\Component;
use App\Models\Products;
use Livewire\Attributes\On;
use App\Models\CategorySizeHeader;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
        if (!$product) {
            Session::flash('danger', 'That product is no longer available.');
            return redirect()->route('cart');
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

        return redirect()->route('cart');
    }

    // buy now product by cart
    public function buyNow($id)
    {
        $product = Products::find($id);
        if (!$product) {
            Session::flash('danger', 'That product is no longer available.');
            return redirect()->route('cart');
        }

        $item_qty = max(1, (int) session()->get('quantity', 1));
        $item_size = session()->get('product_size');
        $item_color = session()->get('product_color');
        $image = $product->primaryImage();

        Cart::instance('cart')->add(
            $product->id,
            $product->product_name,
            $item_qty,
            $product->effectivePrice(),
            [
                'image' => $image,
                'slug' => $product->slug,
                'size' => $item_size,
                'color' => $item_color,
            ]
        );

        session()->forget('quantity');
        session()->forget('product_size');
        session()->forget('product_color');

        Session::flash('success', 'Product added to cart.');

        return redirect()->route('checkout');
    }

    public $sizeChartData = [], $categoryHeaders = [], $headers = [], $sizes;


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
        ])->where('slug', $this->slug)->where('status','active')->first();

        if (!$product) {
            throw new NotFoundHttpException('Product not found.');
        }

        $categorySizeHeaders = CategorySizeHeader::where('category_id', $product->category_id)
        ->with(['size', 'sizeHeader'])
        ->get();

        foreach ($categorySizeHeaders as $entry) {
            $this->sizeChartData[$product->category_id][$entry->size->size_name][$entry->sizeHeader->name] = $entry->value;
            $this->headers[$entry->sizeHeader->id] = $entry->sizeHeader->name;
        }
        $this->sizes = Size::all();

        $this->categoryHeaders[$product->category_id] = $this->headers;



        return view('livewire.product-component',
        [
            'product'=>$product,
            'categoryHeaders' => $this->categoryHeaders,
            'sizeChartData' => $this->sizeChartData,
            'sizes' => $this->sizes,
        ]);
    }
}
