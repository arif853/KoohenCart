<?php

namespace App\Http\Controllers\Admin;

use DB;
use PDF;
use Carbon\Carbon;
use App\Models\Size;
use App\Models\Color;
use App\Models\Order;
use App\Models\Customer;
use App\Models\District;
use App\Models\Postcode;
use App\Models\Products;
use App\Models\shipping;
use App\Models\order_items;
use App\Models\Orderstatus;
use App\Models\transactions;
use Illuminate\Http\Request;
use App\Models\Product_stock;
use Illuminate\Validation\Rule;
use App\Models\Register_customer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('customer', 'order_item', 'shipping', 'transaction')->latest('created_at')->get();
        return view('admin.order.index', compact('orders'));
    }

    public function order_track(Request $request)
    {
        $orderid = $request->id;
        $order = Order::find($orderid);
        $district = District::find($order->customer->district);
        $postOffice = Postcode::find($order->customer->area);

        // $customer_id = $order->customer->id;
        // $customer = shipping::where('customer_id',$customer_id)->
        if ($order->shipping) {
            $s_district = District::find($order->shipping->district);
            $s_postOffice = Postcode::find($order->shipping->area);
        } else {
            $s_district = '';
            $s_postOffice = '';
        }

        $orderItems = $order->order_item;
        $orderProducts = collect();

        foreach ($orderItems as $orderItem) {
            $product = $orderItem->product; // Get the product details for the order item
            $product->load('product_images');

            // Add price and quantity properties to the product
            $product->price = $orderItem->price;
            $product->quantity = $orderItem->quantity;

            // Add the product to the orderProducts collection
            $orderProducts->push($product);

            // Optionally, you can also retrieve color and size information
            $color = Color::find($orderItem->color_id);
            $size = Size::find($orderItem->size_id);
            // Add color and size information to the product if needed
            $product->color = $color;
            $product->size = $size;
        }
        // $customer = $order->customer;
        return view('admin.order.order_track', compact('order', 'orderProducts', 'district', 'postOffice', 's_district', 's_postOffice'));
    }

    public function order_details(Request $request)
    {
        $orderid = $request->id;
        $order = Order::find($orderid);
        $district = District::find($order->customer->district);
        $postOffice = Postcode::find($order->customer->area);
        $orderItems = $order->order_item;
        $orderProducts = collect();

        foreach ($orderItems as $orderItem) {
            $product = $orderItem->product; // Get the product details for the order item
            $product->load('product_images');

            // Add price and quantity properties to the product
            $product->price = $orderItem->price;
            $product->quantity = $orderItem->quantity;

            // Add the product to the orderProducts collection

            // Optionally, you can also retrieve color and size information
            $color = Color::find($orderItem->color_id);
            $size = Size::find($orderItem->size_id);
            // Add color and size information to the product if needed
            $product->color = $color;
            $product->size = $size;

            $orderProducts->push($product);
        }
        // $customer = $order->customer;
        return view('admin.order.order_details', compact('order', 'orderProducts', 'district', 'postOffice'));
    }


    public function OrderFilter(Request $request)
    {
        if($request->ajax()) {
            $orderId = $request->orderId;
            $customerName = $request->customerName;
            $status = $request->status;
            $customerPhone = $request->customerPhone;

            $query = Order::with('customer','order_item.product','order_item.product_sizes','order_item.product_colors');

            if ($orderId) {
                $query->where('id', $orderId);
            }

            if ($customerName) {
                $query->whereHas('customer', function ($query) use ($customerName) {
                    $query->where('firstName', 'LIKE', '%' . $customerName . '%')
                          ->orWhere('lastName', 'LIKE', '%' . $customerName . '%');
                });
            }

            if ($status) {
                $query->where('status', $status);
            }

            if ($customerPhone) {
                $query->whereHas('customer', function ($query) use ($customerPhone) {
                    $query->where('phone', 'LIKE', '%' . $customerPhone . '%');
                });
            }

            $orders = $query->limit(10)->get();
            return response()->json($orders);
        }
    }

    public function pendingfilters(Request $request)
    {
        if($request->ajax()) {
            $orderId = $request->orderId;
            $customerName = $request->customerName;
            $status = $request->status;
            $customerPhone = $request->customerPhone;

            $query = Order::with('customer','order_item.product','order_item.product_sizes','order_item.product_colors')->where('status','pending');

            if ($orderId) {
                $query->where('id', 'LIKE', '%' . $orderId . '%');
            }

            if ($customerName) {
                $query->whereHas('customer', function ($query) use ($customerName) {
                    $query->where('firstName', 'LIKE', '%' . $customerName . '%')
                          ->orWhere('lastName', 'LIKE', '%' . $customerName . '%');
                });
            }

            if ($customerPhone) {
                $query->whereHas('customer', function ($query) use ($customerPhone) {
                    $query->where('phone', 'LIKE', '%' . $customerPhone . '%');
                });
            }

            $orders = $query->limit(10)->get();
            return response()->json($orders);
        }
    }

    public function completedfilters( Request $request)
    {
        if($request->ajax()) {
            $orderId = $request->orderId;
            $customerName = $request->customerName;
            $customerPhone = $request->customerPhone;

            $query = Order::with('customer','order_item.product','order_item.product_sizes','order_item.product_colors')->where('status','completed');

            if ($orderId) {
                $query->where('id', 'LIKE', '%' . $orderId . '%');
            }

            if ($customerName) {
                $query->whereHas('customer', function ($query) use ($customerName) {
                    $query->where('firstName', 'LIKE', '%' . $customerName . '%')
                          ->orWhere('lastName', 'LIKE', '%' . $customerName . '%');
                });
            }

            if ($customerPhone) {
                $query->whereHas('customer', function ($query) use ($customerPhone) {
                    $query->where('phone', 'LIKE', '%' . $customerPhone . '%');
                });
            }

            $orders = $query->limit(10)->get();
            return response()->json($orders);
        }
    }

    public function order_return()
    {
        $order_return = Order::with('customer')->where('status','returned')->latest('created_at')->get();
        return view('admin.order.order_return.index',compact('order_return'));
    }

    public function return_confirm(string $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order not found']);
        }


        // Update the order status
        $order->return_confirm = 1;
        $order->save();

        Session::flash('success', ' Order return confirmation done.');
        return redirect()->back();
    }
    // OrderController.php
    public function updateOrderStatus(Request $request)
    {
        $selectedStatus = $request->input('status');
        $selectedOrders = $request->input('orders');

        // Retrieve the selected orders
        $orders = Order::whereIn('id', $selectedOrders)->get();

        // Update the status for each selected order
        foreach ($orders as $order) {
            // Save the current order status
            $previousStatus = $order->status;

            // Update the order status
            $order->status = $selectedStatus;
            $order->save();

            // Update the OrderStatus table
            $statusColumn = $selectedStatus . '_date_time';
            OrderStatus::updateOrCreate(
                ['order_id' => $order->id],
                [
                    'status' => $selectedStatus,
                    $statusColumn => Carbon::now(),
                ],
            );

            if($selectedStatus == 'completed')
            {
                $transaction = transactions::where('order_id', $order->id);
                $transaction->update([
                    'status' => 'paid',
                ]);
            }

            if($selectedStatus == 'confirmed')
            {
                foreach ($order->order_item as $item) {

                    if($item && $item->size_id){
                        Product_stock::updateOrCreate(
                            [
                                'product_id' => $item->product_id,
                                'size_id' => $item->size_id,
                            ],
                            [
                                // 'inStock' => \DB::raw("inStock"), // Increment the inStock column
                                'outStock' => \DB::raw("outStock + $item->quantity"), // Assuming outStock starts at 0
                            ]
                        );
                        Session::flash('success','stock counted..');
                    }
                }
            }
        }
        Session::flash('success', 'Order ' . $selectedStatus . ' updated successfully.');

        return response()->json(['success' => true, ]);
    }

    // OrderController.php
    public function updateOneOrderStatus(Request $request)
    {
        $orderId = $request->input('orderId');
        $newStatus = $request->input('newStatus');

        // Retrieve the order
        $order = Order::find($orderId);

        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order not found']);
        }

        // Save the current order status
        $previousStatus = $order->status;


        // Update the OrderStatus table
        $statusColumn = $newStatus . '_date_time';

        Orderstatus::updateOrCreate(['order_id' => $orderId], ['status' => $newStatus, $statusColumn => Carbon::now()]);


        if($newStatus == 'completed')
        {
            $transaction = transactions::where('order_id', $order->id);
            $transaction->update([
                'status' => 'paid',
            ]);
        }

        if($newStatus == 'confirmed')
        {
            foreach ($order->order_item as $item) {

                if($item && $item->size_id){
                    Product_stock::updateOrCreate(
                        [
                            'product_id' => $item->product_id,
                            'size_id' => $item->size_id,
                        ],
                        [
                            // 'inStock' => \DB::raw("inStock"), // Increment the inStock column
                            'outStock' => \DB::raw("outStock + $item->quantity"), // Assuming outStock starts at 0
                        ]
                    );
                    Session::flash('warning','Product count on inventory.');
                }
            }
        }

        if($newStatus == 'returned' && $order->is_pos == 1){

            foreach($order->order_item as $item){

                if($item && $item->size_id){
                    Product_stock::updateOrCreate(
                        [
                            'product_id' => $item->product_id,
                            'size_id' => $item->size_id,
                        ],
                        [
                            // 'inStock' => \DB::raw("inStock"), // Increment the inStock column
                            'outStock' => \DB::raw("outStock - $item->quantity"), // Assuming outStock starts at 0
                        ]
                    );

                }
            }
            $order->return_confirm = 1;
            Session::flash('warning','Order has been returned successfully.');
        }

        // Update the order status
        $order->status = $newStatus;
        $order->save();

        return response()->json([
            'success' => true,
            'message' => 'Order status updated ' . $previousStatus . ' to ' . $newStatus . ' successfully',
            'previousStatus' => $previousStatus,
            'newStatus' => $newStatus,
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function pending_order()
    {
        $pendingOrders = Order::with('customer', 'order_item', 'shipping', 'transaction')->where('status', 'pending')->latest('created_at')->get();
        return view('admin.order.pending_list', compact('pendingOrders'));
    }

    /**
     * Display the specified resource.
     */
    public function completed_order()
    {
        $completedOrders = Order::with('customer', 'order_item', 'shipping', 'transaction')->where('status', 'completed')->latest('created_at')->get();
        return view('admin.order.completed_order', compact('completedOrders'));
    }

    /**
     * Show the form for editing the specified resource.
     */


    public function orderInvoice($id)
    {

       // ini_set('max_execution_time',3600);
        $order = Order::where('id', $id)->first();
        if (!$order) {
            return 'Order not found';
        }
        else{
            $pdf= PDF::loadView('admin.order.invoice',['order'=>$order]);
            // $pdf->SetWatermarkText('DRAFT');
            // $pdf->showWatermarkText = true;
            return $pdf->stream('Koohen Invoice-'.$order->id.'.pdf');
        }

    }

    public function invoicePage($id)
    {
        $order = Order::with('customer', 'order_item', 'order_item.product', 'order_item.product_sizes')->where('id', $id)->first();
        return view('admin.order.print-invoice', compact('order'));
    }

    public function getColorOptions()
    {
        $colors = Color::all();
        return response()->json($colors);
    }

    public function getSizeOptions()
    {
        $sizes = Size::all();
        return response()->json($sizes);
    }

    public function orderUpdate(Request $request)
    {
        $orderId = $request->orderId;
        $itemId = $request->productId;
        $sizeId = $request->sizeId;
        $colorId = $request->colorId;

        $orderItem = order_items::where('product_id', $itemId)
            ->where('order_id', $orderId)
            ->first(); // Use first() to get a single result

            // dd($orderItem);
        if (!$orderItem) {
            return response()->json(['error' => 'Order item not found'], 404);
        }
        else{
            $stocks = Product_stock::where('product_id', $itemId)->get();

            if ($stocks->isEmpty()) {
                return response()->json(['error' => 'Stock not found'], 404);
            }
            else
            {
                foreach($stocks as $stock){
                    // Update stock based on quantity change
                    if($stock->size_id == $orderItem->size_id){
                        $quantityDifference = $request->quantity - $orderItem->quantity;
                        $stock->update([
                            'outStock' => $stock->outStock + $quantityDifference
                        ]);
                    }elseif($stock->size_id == $sizeId){
                        $stock->update([
                            'outStock' => $stock->outStock + $request->quantity
                        ]);
                    }
                }
            }

            // Update order item
            $orderItem->update([
                'color_id' => $colorId,
                'size_id' => $sizeId,
                'price' => $request->price,
                'quantity' => $request->quantity,
            ]);

            $order = Order::find($orderId);

            $order->update([
                'subtotal' => $request->subtotal,
                'discount' => $request->discount,
                'total' => $request->grandTotal,
                'total_paid' => $request->totalPaid,
                'total_due' => $request->totalDue,
                'delivery_charge' => $request->deliveryCharge,
            ]);
            Session::flash('success','Order updated successfully');

            return response()->json(['message' => 'Order item updated successfully'], 200);
        }

    }


}
