<?php

namespace App\Http\Controllers\Admin\Steadfast;

use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use SteadFast\SteadFastCourierLaravelPackage\Facades\SteadfastCourier;

class SteadfastController extends Controller
{
    public function send_bulk_to_courier(Request $request)
    {
        $order = Order::find($request->id);
        if (!$order) {
            return redirect()->back()->with('error', 'Order not found');
        }

        $data = [];

        $item = [
            'invoice' => $order->invoice_no ? $request->invoice_no : 'N/A',
            'recipient_name' => $request->recipient_name ? $request->recipient_name : 'N/A',
            'recipient_address' => $request->recipient_address ? $request->recipient_address : 'N/A',
            'recipient_phone' => $request->recipient_phone ? $request->recipient_phone : '',
            'cod_amount' => $request->cod_amount ? $request->cod_amount : 80,
            'note' => $request->note ? $request->note : '',
        ];
        $data[] = $item;

        $response = SteadfastCourier::bulkCreateOrders($data);
        // dd($response);
        if ($response['status'] == 200) {
            $responseData = $response['data'];
            // dd($responseData);
            //dd($responseData[0]['tracking_code']);
            // dd($order);
            $invoice = $responseData[0]['invoice'];
            $consignment_id = $responseData[0]['consignment_id'];
            $tracking_code = $responseData[0]['tracking_code'];
            $cod_amount = $responseData[0]['cod_amount'];
            $orders = DB::table('orders')
                ->where('id', $request->id)
                ->update([
                    'invoice_no' => $invoice,
                    'consignment_id' => $consignment_id, // it is not inseted in orders table
                    'tracking_code' => $tracking_code, // it is not inserted in orders table
                    'delivery_charge' => $cod_amount,
                ]);

            return redirect()->back()->with('success', 'Courier sent successfully');
        } else {
            return redirect()->back()->with('error', 'Courier send failed');
        }
    }

    public function place_order(Request $request)
    {
        $order = Order::find($request->id);

        if (!$order) {
            return redirect()->back()->with('error', 'Order not found');
        }

        // Check if the invoice number already exists
        $existingOrder = Order::where('invoice_no', $request->invoice)->first();
        if ($existingOrder) {
            // Generate a new unique invoice number
            $newInvoiceNo = $this->generateUniqueInvoiceNumber();
            $request->merge(['invoice' => $newInvoiceNo]);
        }

        $orderData = [
            'consignment_id' => $request->consignment_id ?: 'N/A',
            'invoice' => $request->invoice ?: 'N/A',
            'tracking_code' => $request->tracking_code ?: 'N/A',
            'recipient_name' => $request->recipient_name ?: 'N/A',
            'recipient_phone' => $request->recipient_phone ?: 'N/A',
            'recipient_address' => $request->recipient_address ?: 'N/A',
            'cod_amount' => $request->cod_amount ?: 80,
            'status' => 'in_review',
            'note' => 'Delivered',
        ];

        //dd($orderData);
        $response = SteadfastCourier::placeOrder($orderData);
        // dd($response);
        if ($response['status'] == 200) {
            return redirect()->back()->with('success', 'Consignment has been created successfully');
        } else {
            return redirect()->back()->with('error', 'Consignment creation failed');
        }
    }

    private function generateUniqueInvoiceNumber()
    {
        do {
            $invoiceNo = 'INV-' . strtoupper(Str::random(10));
        } while (Order::where('invoice_no', $invoiceNo)->exists());

        return $invoiceNo;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function checkingDeliveryStatus($consignmentId)
    {
        $checkDeliveryStatus = SteadfastCourier::checkDeliveryStatusByConsignmentId($consignmentId);
      //  dd($checkDeliveryStatus);
        return $checkDeliveryStatus;
        
      

    }

    /**
     * Store a newly created resource in storage.
     */
    public function getCurrentBalance()
    {
       $balance = SteadfastCourier::getCurrentBalance();
         return response()->json([
            
            $balance]);
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