<?php

namespace App\Http\Controllers\Admin;

use App\Models\Campaign;
use App\Models\Order;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Products;
use App\Models\order_items;
use App\Models\Product_stock;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $total_orders = Order::count();
        $products = Products::count();
        $category = Category::count();
        $customers = Customer::count();
        $pending_order = Order::where('status','pending')->count();
        $completed_order = Order::where('status','completed')->count();
        $campaign = Campaign::where('status','Published')->count();

        $orders = Order::where('status','pending')->latest()->get();
        $sales = Order::where('status','completed')->sum('total');
        $subtotal = Order::where('status','completed')->sum('subtotal');
        $productInStock = Product_stock::sum('inStock') - Product_stock::sum('outStock');

        return view('admin.index',compact('orders','total_orders','sales','products','category','customers','pending_order','completed_order','campaign','subtotal','productInStock'));
    }
}
