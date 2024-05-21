<?php

namespace App\Http\Controllers\Admin\Steadfast;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SteadfastController extends Controller
{
    private $base_url;

    public function __construct()
    {
        $this->base_url = 'https://portal.steadfast.com.bd/api/v1';
    }
   

    public function authHeaders()
    {
        return ['Api-Key: wp6wnz0lm5f3romt0zo7w5wlwzx0oz0q', 'Secret-Key: cbwqozzzghsial4lffpvmwnb', 'Content-Type: application/json', 'Accept: application/json'];
    }
    public function curlWithBody($url, $header, $method, $body_data_json = null)
    {
        $curl = curl_init($this->base_url . $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $body_data_json);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
    public function create(){
        return view('form');
    }
    public function store(Request $request)
{
    $orderData = [
        'consignment_id' => $request->consignment_id,
        'invoice' => $request->invoice,
        'tracking_code' => $request->tracking_code,
        'recipient_name' => $request->recipient_name,
        'recipient_phone' => $request->recipient_phone,
        'recipient_address' => $request->recipient_address,
        'cod_amount' => $request->cod_amount,
        'status' => $request->status,
        'note' => $request->note
    ];

    // Debugging to check the orderData
    // dd($orderData);

    // Ensure URL is correctly formatted
    $url = 'https://portal.steadfast.com.bd/api/v1/create_order';

    // cURL request to Steadfast API
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($orderData));

    // If Steadfast API requires Basic Auth, add the following lines
    // Replace 'username' and 'password' with actual credentials
    curl_setopt($ch, CURLOPT_USERPWD, 'username:password');
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        $error_msg = curl_error($ch);
        curl_close($ch);
        return response()->json([
            'status' => 500,
            'message' => 'Error: ' . $error_msg,
        ]);
    }

    curl_close($ch);

    $consignment = json_decode($response, true);

    return response()->json([
        'status' => 200,
        'message' => 'Consignment has been created successfully.',
        'consignment' => $consignment
    ]);
}


  
    public function index()
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
