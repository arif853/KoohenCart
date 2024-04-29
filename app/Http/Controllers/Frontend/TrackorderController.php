<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Size;
use App\Models\Color;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class TrackorderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('frontend.trackorder.ordertrack');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function order_details(Request $request)
    {
        $trackNo = $request->input('trackid');

        // Fetch tracked order details
        $trackedOrder = Order::with('customer', 'order_item', 'shipping', 'transaction', 'orderStatus')
            ->where('order_track_id', $trackNo)->first();

        if ($trackedOrder) {
            // Process and prepare data for the response
            $orderProducts = $this->prepareOrderProducts($trackedOrder->order_item);
            // Convert created_at to Asia/Dhaka timezone and format it
            $trackedOrder->created_at_formatted = Carbon::parse($trackedOrder->created_at)
            ->setTimezone('Asia/Dhaka')
            ->format('M j, Y, g:iA');

            // You can add more data if needed
            $responseData = [
                'order' => $trackedOrder,
                'orderProducts' => $orderProducts,
            ];

            return response()->json($responseData);
        } else {
            // Return a response indicating that no order was found
            return response()->json(['error' => 'No order found for the provided track ID'], 404);
        }
    }

    
    public function orderTrack(string $trackid)
    {
        // $trackNo = $request->trackid;

        // Fetch tracked order details
        $trackedOrder = Order::with('customer', 'order_item', 'shipping', 'transaction', 'orderStatus')
            ->where('order_track_id', $trackid)->first();

        if ($trackedOrder) {
            // Process and prepare data for the response
            $orderProducts = $this->prepareOrderProducts($trackedOrder->order_item);

            // Convert created_at to Asia/Dhaka timezone and format it
            $trackedOrder->created_at_formatted = Carbon::parse($trackedOrder->created_at)
            ->setTimezone('Asia/Dhaka')
            ->format('M j, Y, g:iA');

            // You can add more data if needed
            $responseData = [
                'order' => $trackedOrder,
                'orderProducts' => $orderProducts,
            ];

            // return response()->json($responseData);
            // dd($responseData);
            return view('frontend.trackorder.myordertrack',compact('responseData'));
        } else {
            // Return a response indicating that no order was found
            return response()->json(['error' => 'No order found for the provided track ID'], 404);
        }
    }

    private function prepareOrderProducts($orderItems)
    {
        $orderProducts = [];

        foreach ($orderItems as $orderItem) {
            $product = $orderItem->product;
            $product->load('product_images');

            // Add price and quantity properties to the product
            $product->price = $orderItem->price;
            $product->quantity = $orderItem->quantity;

            $color = Color::find($orderItem->color_id);
            $size = Size::find($orderItem->size_id);

            $product->color = $color;
            $product->size = $size;

            $orderProducts[] = $product;
        }

        return $orderProducts;
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
