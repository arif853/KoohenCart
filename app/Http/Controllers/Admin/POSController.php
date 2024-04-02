<?php

namespace App\Http\Controllers\Admin;

use DB;
use PDF;
use App\Models\Order;
use App\Models\Campaign;
use App\Models\Customer;
use App\Models\Products;
use App\Models\order_items;
use App\Models\transactions;
use Illuminate\Http\Request;
use App\Models\Product_image;
use App\Models\Product_stock;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Notifications\LowStockNotification;

class POSController extends Controller
{
    public function index()
    {
        $products = Products::with([
                            'sizes',
                            'colors',
                            'category',
                            'product_price',
                            'product_thumbnail',
                            'product_stocks',
                        ])->paginate(15);

        foreach ($products as $product) {
            $stock = $product->product_stocks;

            $inStock = $stock->sum('inStock');
            $soldQuantity = $stock->sum('outStock');

            $product->inStock = $inStock;
            $product->balance =  $inStock - $soldQuantity;

            $product->balance = ($product->balance > 0) ? $product->balance : 0;
        }

        return view('admin.pos.index',compact('products'));
    }

    public function searchProducts(Request $request)
    {
        $searchTerm = $request->input('term');

        $products = Products::where('product_name', 'like', "%{$searchTerm}%")
                          ->orWhere('sku', 'like', "%{$searchTerm}%")
                          ->with([
                            'sizes',
                            'colors',
                            'category',
                            'product_price',
                            'product_thumbnail',
                            'product_stocks',
                        ])->get();

        return response()->json($products);
    }


    public function searchcustomer(Request $request)
    {
        $searchTerm = $request->input('customer');

        $customers = Customer::where('email', 'like', "%{$searchTerm}%")
                          ->orWhere('phone', 'like', "%{$searchTerm}%")
                          ->get();

        return response()->json($customers);
    }

    public function posCart(Request $request, $id)
    {
        $product = Products::find($id);
        if($product){
            $item_name = $product->product_name;
            $offer_price = $product->product_price->offer_price;


            $item_price = $request->input('price');
            $color = $request->input('color');
            $size = $request->input('size');

                // $item_price = $product->regular_price;
            $item_slug = $product->slug;
            $data = Cart::instance('pos_cart')->add($id,$item_name,1,$item_price, ['color' => $color,'size' => $size,'slug' => $item_slug]);

            Session::flash('success','Product added To list.');
            return response()->json(['status' => 200, 'message' => 'Product added to list', 'data' => $data]);
        }
        else{
            Session::flash('success','Product not found.');
        }


    }

    public function cart_remove($id){

        Cart::instance('pos_cart')->remove($id);
        $cartItems = Cart::instance('pos_cart')->content();

        Session::flash('danger','Product removed from list.');
        return response()->json(['status' => 200,'message' => 'Product remove from cart','cartItems' => $cartItems]);
    }


    public function posOrderCancel()
    {
        Cart::instance('pos_cart')->destroy();
        Session::flash('danger','Order canceled,Products removed.');
        return response()->json(['status' => 200,'message' => 'Product remove from cart']);
    }

    public function increaseQuantity($rowId)
    {
        $item = Cart::instance('pos_cart')->get($rowId);
        $qty = $item->qty + 1;
        Cart::instance('pos_cart')->update($rowId, $qty);
        return redirect()->back()->with('success','Item quantity updated.');
    }

    public function decreaseQuantity($rowId)
    {
        $item = Cart::instance('pos_cart')->get($rowId);
        $qty = $item->qty - 1;
        Cart::instance('pos_cart')->update($rowId,$qty);
        return redirect()->back()->with('success','Item quantity updated.');
    }


    public function generateCode()
    {
    do {
        // Generate a 4-digit random number
        $randomNumber = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);

        // Get the current year
        $currentYear = date('y');
        // Concatenate the components to create the final code
        $generatedCode = 'K'.$currentYear.'-'.$randomNumber;
        // Check if the generated code already exists in the database
        $codeExists = DB::table('orders')->where('order_track_id', $generatedCode)->exists();

    } while ($codeExists);

        // Concatenate the components to create the final code
        return $generatedCode;
    }

    public function generateInvoiceNo()
    {

    do {
        // Generate a 2-digit random number
        $randomNumber = str_pad(mt_rand(1, 99), 2, '0', STR_PAD_LEFT);

        // Get the current year
        $currentYear = date('y');
        $currentMonth = date('m');

        // Concatenate the components to create the final code
        $invoiceNo= $currentMonth.$currentYear.$randomNumber;
        // Check if the generated code already exists in the database
        $codeExists = DB::table('orders')->where('invoice_no', $invoiceNo)->exists();

    } while ($codeExists);

        // Concatenate the components to create the final code

        return $invoiceNo;
    }

    public function posOrder(Request $request)
    {
        $track_id = $this->generateCode();
        $invoiceNo = $this->generateInvoiceNo();
        $customer_id = null;

        if ($request->input('customer')) {
            // Existing customer selected
            $customer_id = $request->input('customer');
        } else {
            // New customer selected
            $newCustomerData = $request->input('newCustomer');
            foreach($newCustomerData as $customer)
            {
                // Save new customer information to the customers table
                $newCustomer = new Customer();
                $newCustomer->firstName = $customer['name'];
                // Add logic to extract last name if available in new customer data
                $newCustomer->lastName = ' ';
                $newCustomer->email = ' ';
                $newCustomer->phone = $customer['phone'];
                $newCustomer->billing_address = $customer['address'];
                $newCustomer->save();

                $customer_id = $newCustomer->id;
            }
            // Use the newly created customer's ID for the order
        }

        $order = new Order();
        $order->customer_id = $customer_id;
        $order->invoice_no = $invoiceNo;
        $order->order_track_id = null;
        $order->subtotal = $request->input('subtotal');
        $order->delivery_charge = $request->input('delivery_charge');
        $order->discount = $request->input('discount');
        $order->total = $request->input('total');
        $order->total_paid = $request->input('totalPaid') ;
        $order->total_due = $request->input('totalDue');
        $order->is_shipping_different =  0;
        $order->order_from  = $request->input('orderFrom');
        $order->comment = "Pos order";
        $order->is_pos = 1;
        $order->status = 'completed';
        $order->save();

        $cartItems = Cart::instance('pos_cart')->content();

        // Loop through the cart items and save them to the order item table
        foreach ($cartItems as $cartItem) {

            order_items::create([
                'product_id' => $cartItem->id,
                'order_id' => $order->id,
                'color_id' => $cartItem->options->color,
                'size_id' => $cartItem->options->size,
                'price' => $cartItem->price,
                'quantity' => $cartItem->qty,
            ]);

            Product_stock::updateOrCreate(
                [
                    'product_id' => $cartItem->id,
                    'size_id' => $cartItem->options->size,
                ],
                [
                    // 'inStock' => \DB::raw("inStock"), // Increment the inStock column
                    'outStock' => \DB::raw("outStock + $cartItem->qty"), // Assuming outStock starts at 0
                ]
            );

            $product = Products::find($cartItem->id);
            $stock = $product->product_stocks->sum('inStock') - $product->product_stocks->sum('outStock');
            if ($stock < 5) {
                // Trigger the low stock notification
                $product->notify(new LowStockNotification($product));
            }
        }

        $transaction_data = [
            'customer_id' => $customer_id,
            'order_id' => $order->id,
            'mode' => 'cash',
        ];

        if($order->total_due == 0){
            $transaction_data += [
                'status' => 'paid'
            ];

        }else{
            $transaction_data += [
                'status' => 'unpaid'
            ];
        }



        transactions::create($transaction_data);

        Cart::instance('pos_cart')->destroy();
        Session::flash('success','Order has been created.');

        // Generate and stream the invoice
        // $invoice = $this->Invoice($order->id)->stream();

        // dd($order);
        return response()->json(route('pos.invoice', ['id' => $order->id]));
    }

    public function orderInvoice($id)
    {

       // ini_set('max_execution_time',3600);
        $order = Order::where('id', $id)->first();
        if (!$order) {
            return 'Order not found';
        }
        else{
            $pdf= PDF::loadView('admin.pos.invoice',['order'=>$order]);
            // $pdf->SetWatermarkText('DRAFT');
            // $pdf->showWatermarkText = true;
            return $pdf->stream('Koohen Invoice-'.$order->id.'.pdf');
        }

    }

}
