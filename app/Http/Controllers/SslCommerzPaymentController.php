<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Library\SslCommerz\SslCommerzNotification;

class SslCommerzPaymentController extends Controller
{

    public function success(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        $sslc = new SslCommerzNotification();

        $order_id = $request->input('value_a');
        if (!$order_id) {
            return redirect()->route('order.fail')->withErrors(['error' => 'Invalid Order ID']);
        }

        $order = Order::find($order_id);
        if (!$order) {
            return redirect()->route('order.fail')->withErrors(['error' => 'Order not found']);
        }

        $transaction = transactions::where('order_id', $order->id)->first();
        if ($transaction) {
            $transaction->update(['status' => 'paid','transaction_no' => $tran_id]);
        } else {
            return redirect()->route('order.fail')->withErrors(['error' => 'Transaction not found']);
        }

        Log::alert('Payment success '.$transaction);
        // dd($order_id, $transaction, $sslc);

        return redirect()->route('thankyou')->with(['success' => 'Your order has been placed, Payment successful.']);

    }

    public function fail(Request $request)
    {
        $order_id = $request->input('value_a');
        $transaction = transactions::where('order_id', $order_id)->first();
        if ($transaction) {
            // Payment failed - mark the transaction as declined (NOT paid).
            $transaction->update(['status' => 'declined']);
        }

        return redirect()->route('home')->with('danger', 'Your payment failed. Please try again or choose Cash on Delivery.');
    }

    public function cancel(Request $request)
    {
        $order_id = $request->input('value_a');
        $transaction = transactions::where('order_id', $order_id)->first();
        if ($transaction) {
            // Customer cancelled the payment - keep it unpaid/declined.
            $transaction->update(['status' => 'declined']);
        }

        return redirect()->route('home')->with('warning', 'Your payment was cancelled.');
    }

    public function ipn(Request $request)
    {
        $tran_id = $request->input('tran_id');
        $order_id = $request->input('value_a');

        if (!$tran_id || !$order_id) {
            return response()->json(['status' => 'fail', 'message' => 'Invalid Data'], 400);
        }

        $order = Order::find($order_id);
        $transaction = $order ? transactions::where('order_id', $order->id)->first() : null;

        if (!$order || !$transaction) {
            return response()->json(['status' => 'fail', 'message' => 'Order not found'], 404);
        }

        // Already settled - no need to update again.
        if ($transaction->status === 'paid') {
            return response()->json(['status' => 'success', 'message' => 'Transaction is already successfully Completed']);
        }

        $sslc = new SslCommerzNotification();
        $validation = $sslc->orderValidate($request->all(), $tran_id, $order->total, $request->input('currency'));

        if ($validation == TRUE) {
            $transaction->update(['status' => 'paid', 'transaction_no' => $tran_id]);
            return response()->json(['status' => 'success', 'message' => 'Transaction is successfully Completed']);
        }

        return response()->json(['status' => 'fail', 'message' => 'Transaction validation failed'], 400);
    }

    // public function exampleEasyCheckout()
    // {
    //     return view('exampleEasycheckout');
    // }

    // public function exampleHostedCheckout()
    // {
    //     return view('exampleHosted');
    // }

    // public function index(Request $request)
    // {
    //     # Here you have to receive all the order data to initate the payment.
    //     # Let's say, your oder transaction informations are saving in a table called "payments"
    //     # In "payments" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

    //     $post_data = array();
    //     $post_data['total_amount'] = '10'; # You cant not pay less than 10
    //     $post_data['currency'] = "BDT";
    //     $post_data['tran_id'] = uniqid(); // tran_id must be unique

    //     # CUSTOMER INFORMATION
    //     $post_data['cus_name'] = 'Customer Name';
    //     $post_data['cus_email'] = 'customer@mail.com';
    //     $post_data['cus_add1'] = 'Customer Address';
    //     $post_data['cus_add2'] = "";
    //     $post_data['cus_city'] = "";
    //     $post_data['cus_state'] = "";
    //     $post_data['cus_postcode'] = "";
    //     $post_data['cus_country'] = "Bangladesh";
    //     $post_data['cus_phone'] = '8801XXXXXXXXX';
    //     $post_data['cus_fax'] = "";

    //     # SHIPMENT INFORMATION
    //     $post_data['ship_name'] = "Store Test";
    //     $post_data['ship_add1'] = "Dhaka";
    //     $post_data['ship_add2'] = "Dhaka";
    //     $post_data['ship_city'] = "Dhaka";
    //     $post_data['ship_state'] = "Dhaka";
    //     $post_data['ship_postcode'] = "1000";
    //     $post_data['ship_phone'] = "";
    //     $post_data['ship_country'] = "Bangladesh";

    //     $post_data['shipping_method'] = "NO";
    //     $post_data['product_name'] = "Computer";
    //     $post_data['product_category'] = "Goods";
    //     $post_data['product_profile'] = "physical-goods";

    //     # OPTIONAL PARAMETERS
    //     $post_data['value_a'] = "ref001";
    //     $post_data['value_b'] = "ref002";
    //     $post_data['value_c'] = "ref003";
    //     $post_data['value_d'] = "ref004";

    //     #Before  going to initiate the payment order status need to insert or update as Pending.
    //     $update_product = DB::table('payments')
    //         ->where('transaction_id', $post_data['tran_id'])
    //         ->updateOrInsert([
    //             'name' => $post_data['cus_name'],
    //             'email' => $post_data['cus_email'],
    //             'phone' => $post_data['cus_phone'],
    //             'amount' => $post_data['total_amount'],
    //             'status' => 'Pending',
    //             'address' => $post_data['cus_add1'],
    //             'transaction_id' => $post_data['tran_id'],
    //             'currency' => $post_data['currency']
    //         ]);

    //     $sslc = new SslCommerzNotification();
    //     # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
    //     $payment_options = $sslc->makePayment($post_data, 'hosted');

    //     if (!is_array($payment_options)) {
    //         print_r($payment_options);
    //         $payment_options = array();
    //     }

    // }

    // public function payViaAjax(Request $request)
    // {

    //     # Here you have to receive all the order data to initate the payment.
    //     # Lets your oder trnsaction informations are saving in a table called "payments"
    //     # In payments table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

    //     $post_data = array();
    //     $post_data['total_amount'] = '10'; # You cant not pay less than 10
    //     $post_data['currency'] = "BDT";
    //     $post_data['tran_id'] = uniqid(); // tran_id must be unique

    //     # CUSTOMER INFORMATION
    //     $post_data['cus_name'] = 'Customer Name';
    //     $post_data['cus_email'] = 'customer@mail.com';
    //     $post_data['cus_add1'] = 'Customer Address';
    //     $post_data['cus_add2'] = "";
    //     $post_data['cus_city'] = "";
    //     $post_data['cus_state'] = "";
    //     $post_data['cus_postcode'] = "";
    //     $post_data['cus_country'] = "Bangladesh";
    //     $post_data['cus_phone'] = '8801XXXXXXXXX';
    //     $post_data['cus_fax'] = "";

    //     # SHIPMENT INFORMATION
    //     $post_data['ship_name'] = "Store Test";
    //     $post_data['ship_add1'] = "Dhaka";
    //     $post_data['ship_add2'] = "Dhaka";
    //     $post_data['ship_city'] = "Dhaka";
    //     $post_data['ship_state'] = "Dhaka";
    //     $post_data['ship_postcode'] = "1000";
    //     $post_data['ship_phone'] = "";
    //     $post_data['ship_country'] = "Bangladesh";

    //     $post_data['shipping_method'] = "NO";
    //     $post_data['product_name'] = "Computer";
    //     $post_data['product_category'] = "Goods";
    //     $post_data['product_profile'] = "physical-goods";

    //     # OPTIONAL PARAMETERS
    //     $post_data['value_a'] = "ref001";
    //     $post_data['value_b'] = "ref002";
    //     $post_data['value_c'] = "ref003";
    //     $post_data['value_d'] = "ref004";


    //     #Before  going to initiate the payment order status need to update as Pending.
    //     $update_product = DB::table('payments')
    //         ->where('transaction_id', $post_data['tran_id'])
    //         ->updateOrInsert([
    //             'name' => $post_data['cus_name'],
    //             'email' => $post_data['cus_email'],
    //             'phone' => $post_data['cus_phone'],
    //             'amount' => $post_data['total_amount'],
    //             'status' => 'Pending',
    //             'address' => $post_data['cus_add1'],
    //             'transaction_id' => $post_data['tran_id'],
    //             'currency' => $post_data['currency']
    //         ]);

    //     $sslc = new SslCommerzNotification();
    //     # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
    //     $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

    //     if (!is_array($payment_options)) {
    //         print_r($payment_options);
    //         $payment_options = array();
    //     }

    // }



}
