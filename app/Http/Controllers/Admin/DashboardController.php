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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

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
        $totalLoss = $this->calculateTotalLoss();
        $totalPurchase = 0;
            foreach(Products::all() as $product)
            {
                $totalPurchase += $product->raw_price * $product->product_stocks->sum('inStock');
            }

        $paidOrders = Order::whereHas('transaction', function ($query) {
            $query->where('status', 'paid');
        })->get();

        // Count the number of paid orders
        $paidOrdersCount = $paidOrders->count();

        // Retrieve the count of unread notifications for low stock products


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
            'totalProfit',
            'totalLoss',
            'totalPurchase',
            'paidOrdersCount'
        ));
        // dd($unreadNotifications);
    }


    private function calculateTotalProfit()
    {
        // Get completed orders
        $orders = Order::where('status', 'completed')->get();

        $totalProfit = 0;

        foreach ($orders as $order) {
            // Get the total amount paid for the order (subtotal - discount)
            $sellingPrice = $order->subtotal - $order->discount;

            // Initialize total cost for products in this order
            $PurchasePrice = 0;

            // Calculate the total cost of products in the order
            foreach ($order->order_item as $orderItem) {
                // Assuming 'cost_price' is the column name in the product table for the cost price
                $PurchasePrice += $orderItem->product->raw_price * $orderItem->quantity;
            }

            // Calculate profit for this order
            $profit = $sellingPrice - $PurchasePrice;

            // Accumulate profit
            $totalProfit += $profit;
        }

        return $totalProfit;
    }

    private function calculateTotalLoss()
    {
        // Get completed orders
        $orders = Order::where('status', 'completed')->get();

        $totalLoss = 0;

        foreach ($orders as $order) {
            // Calculate the total amount paid for the order (subtotal - discount)
            $SellingPrice = $order->subtotal - $order->discount;

            // Initialize total cost for products in this order
            $purchasePrice = 0;

            // Calculate the total cost of products in the order
            foreach ($order->order_item as $orderItem) {
                // Assuming 'cost_price' is the column name in the product table for the cost price
                $purchasePrice += $orderItem->product->raw_price * $orderItem->quantity;
            }

            // If the total cost of products is greater than the total amount paid
            if ($purchasePrice > $SellingPrice) {
                // Calculate the loss for this order
                $loss = $purchasePrice - $SellingPrice;

                // Accumulate the total loss
                $totalLoss += $loss;
            }
        }

        return $totalLoss;
    }



    public function markNotificationAsRead(Request $request)
    {
        // Find the notification by its ID
        $notification = Auth::user()->notifications()->find($request->id);
        $stockNotify = \DB::table('notifications')->where('type', 'App\Notifications\LowStockNotification')->where('id', $request->id)->first();

        // If the notification exists and belongs to the authenticated user
        if ($notification) {
            // Mark the notification as read
            $notification->markAsRead();

        } elseif ($stockNotify) {

            \DB::table('notifications')->where('id', $request->id)->update(['read_at' => now()]);

        }
            // dd($stockNotify);
        // Redirect the user back to the previous page or to a specific route
        return response()->json(200);
    }
}
