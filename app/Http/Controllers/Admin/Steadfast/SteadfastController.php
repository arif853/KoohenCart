<?php

namespace App\Http\Controllers\Admin\Steadfast;

use App\Models\Order;
use Illuminate\Http\Request;
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

        $customer = Auth::guard('customer')->user();
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
   
 $order = Order::find($request->id);
 
    $order->update([
        'invoice_no' => $responseData[0]['invoice'], 
        'consignment_id' => $responseData[0]['consignment_id'],
        'tracking_code' => $responseData[0]['tracking_code'],
        'delivery_charge' => $responseData[0]['cod_amount'] 
    ]);
    
            return redirect()->back()->with('success', 'Courier sent successfully');
        } else {
            return redirect()->back()->with('error', 'Courier send failed');
        }
     

    }

    public function index()
    {
        //
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