<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Models\Order;
use App\Models\Campaign;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Products;
use App\Models\order_items;
use Illuminate\Http\Request;
use App\Models\Product_stock;
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
        $subtotal = Order::where('status','completed')->sum('subtotal') - Order::where('status','completed')->sum('discount');
        $productInStock = Product_stock::sum('inStock') - Product_stock::sum('outStock');

        $topOrderedProducts = order_items::with('product')
            ->whereHas('order', function ($query) {
                $query->where('status', 'completed');
            })
            ->select('product_id', \DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->take(10) // Adjust the number of top products as needed
            ->get();

        // Calculate total profit
        $totalProfit = $this->calculateTotalProfit();

        return view('admin.index',compact(
            'orders',
            'total_orders',
            'sales',
            'products',
            'category',
            'customers',
            'pending_order',
            'completed_order',
            'campaign',
            'subtotal',
            'productInStock',
            'topOrderedProducts',
            'totalProfit'
        ));
    }


    private function calculateTotalProfit()
    {
        $orders = Order::where('status', 'completed')->get();

        $totalProfit = 0;

        foreach ($orders as $order) {
            // Get the total amount of the order
            $totalAmount = $order->total;

            // Initialize total raw price for products in this order
            $totalRawPrice = 0;

            // Calculate the total raw price of products in the order
            foreach ($order->order_item as $orderItem) {
                // Assuming 'raw_price' is the column name in the product table for the raw price
                $totalRawPrice += $orderItem->product->raw_price * $orderItem->quantity;
            }

            // Calculate profit for this order
            $profit = $totalAmount - $totalRawPrice;

            // Accumulate profit
            $totalProfit += $profit;
        }

        return $totalProfit;
    }
}
