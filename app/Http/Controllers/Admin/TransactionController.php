<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Models\Order;
use App\Models\transactions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = transactions::with('order','customer')->latest('id')->get();
        return view('admin.transactions.index', ['data' => $data]);
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
     * Store a newly created resource in storage.
     */
    public function paymentInfo(Request $request)
    {
        $transaction = transactions::with('order','customer')->find($request->id);
        return response()->json($transaction);
    }

    /**
     * Display the specified resource.
     */
        public function paymentUpdate(Request $request)
    {
        $order = Order::find($request->orderNo);
        $transaction = transactions::find($request->trans_id);

        // Calculate new total_paid and total_due values
        $newTotalPaid = $order->total_paid + $request->payment;
        $newTotalDue = $order->total_due - $request->payment;

        // Update order
        $order->update([
            'total_paid' => $newTotalPaid,
            'total_due' => $newTotalDue,
        ]);

        // Update transaction status
        if ($newTotalDue == 0) {
            $transaction->update([
                'mode' => $request->paymentMode,
                'status' => 'paid',
                'transaction_no' => $request->trans_ref
            ]);
        } else {
            $transaction->update([
                'mode' => $request->paymentMode,
                'status' => 'unpaid',
                'transaction_no' => $request->trans_ref
            ]);
        }

        Session::flash('success','Payment Successful');

        return response()->json(['status'=> 200]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function transactionSearch( Request $request)
    {
        $orderNo = $request->input('orderNo');
        $customerName = $request->input('customerName');

        $transactions = transactions::with(['customer', 'order'])
        ->where('order_id', 'like', '%' . $orderNo . '%')
        ->whereHas('customer', function ($query) use ($customerName) {
            $query->where('firstName', 'like', '%' . $customerName . '%')
                ->orWhere('lastName', 'like', '%' . $customerName . '%');
        })
        ->limit(10)
        ->latest('id')
        ->get();

        // Return the response as JSON
        return response()->json(['transactions' => $transactions]);
    }
}
