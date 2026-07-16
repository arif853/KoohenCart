<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\Product_image;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.cart');
    }
    public function checkout()
    {
        return view('frontend.checkout');
    }

    public function increaseQuantity($id)
    {
        $item = Cart::instance('cart')->get($id);
        if ($item) {
            Cart::instance('cart')->update($id, $item->qty + 1);
        }
        return redirect()->back();
    }

    public function decreaseQuantity($id)
    {
        $item = Cart::instance('cart')->get($id);
        // Never let the quantity drop below 1; use removecart to delete an item.
        if (!$item || $item->qty <= 1) {
            return redirect()->back();
        }
        Cart::instance('cart')->update($id, $item->qty - 1);
        return redirect()->back();
    }
    public function addtocart(string $id)
    {
        $product = Products::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found.'], 404);
        }
        $item_name = $product->product_name;
        $item_price = $product->regular_price;
        $item_slug = $product->slug;
        $item_image = Product_image::where('product_id', $id)->select('product_image')->first();
        $data = Cart::instance('cart')->add($id,$item_name,1,$item_price, ['image' => $item_image,'slug' => $item_slug])->associate('\App\Models\Products');
        Session::flash('success','Product added To cart.');
        return response()->json(['data'=> $data]);
    }
    public function removecart($id){
        Cart::instance('cart')->remove($id);
        Session::flash('success','Product removed from cart.');
        return redirect()->back();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
