<?php

namespace App\Livewire;

use App\Models\Size;
use App\Models\Color;
use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class MyOrderComponent extends Component
{

    public $trackedOrder;
    public $trackedProduct;

    #[On('orderTracked')]

    // protected $listeners = ['orderTracked' => 'setTrackedOrder'];

    public function orderTracked($orderId)
    {

        $trackedOrder = Order::with('customer', 'order_item', 'shipping', 'transaction','orderStatus')
        ->where('order_track_id', $orderId)->first();

        $orderProducts = collect();
        // Iterate through each order and collect the associated products with images

        $orderItems = $trackedOrder->order_item;

        foreach ($orderItems as $orderItem) {
            $product = $orderItem->product; // Get the product details for the order item
            $product->load('product_images');

            // Add price and quantity properties to the product
            $product->price = $orderItem->price;
            $product->quantity = $orderItem->quantity;

            $color = Color::find($orderItem->color_id);
            $size = Size::find($orderItem->size_id);

            $product->color = $color;
            $product->size = $size;

            $orderProducts->push($product);
        }
        // Set the tracked order in the component state
        $this->trackedOrder = $trackedOrder;
        $this->trackedProduct = $orderProducts;
        return view('livewire.my-order-component');

    }

    public function render()
    {

        $user = Auth::guard('customer')->user();
        $customer_id = $user->customer_id;

        //  // Fetch the latest order if $selectedOrder is not set
         if (!$this->trackedOrder) {
            $latestOrder = Order::with('customer', 'order_item', 'shipping', 'transaction')
            ->where('customer_id', $customer_id)
            ->latest()->first();

            $orderProducts = collect();
            // Iterate through each order and collect the associated products with images

            $orderItems = $latestOrder->order_item;

            foreach ($orderItems as $orderItem) {
                $product = $orderItem->product; // Get the product details for the order item
                $product->load('product_images');

                // Add price and quantity properties to the product
                $product->price = $orderItem->price;
                $product->quantity = $orderItem->quantity;

                $color = Color::find($orderItem->color_id);
                $size = Size::find($orderItem->size_id);

                $product->color = $color;
                $product->size = $size;

                $orderProducts->push($product);
            }
            // Set the tracked order in the component state
            $this->trackedOrder = $latestOrder;
            $this->trackedProduct = $orderProducts;
        }

        return view('livewire.my-order-component');
    }
}
