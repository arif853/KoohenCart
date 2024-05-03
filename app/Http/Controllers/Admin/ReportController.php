<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Log;
class ReportController extends Controller
{
    public function saleReport()
    {
        $orders = Order::where('status','completed')->get();
        return view('admin.reports.sale',compact('orders'));
    }


    public function searchSale(Request $request)
    {
        // log::info($request);
        $customer = $request->input('customer');
        $invoice_no = $request->input('invoice_no');
        $productsku = $request->input('sku');
        $size = $request->input('size');
        // $categoryId = $request->input('category');

        $startDate = $request->input('start');
        $endDate = $request->input('end');

        $query = Order::where('status', 'completed')->orderBy('created_at')->with(
            ['customer','order_item',
            'order_item.product',
            'order_item.product_sizes'
            ]);

        if (!empty($customer)) {
            $query->whereHas('customer', function ($innerQuery) use ($customer) {
                $innerQuery->where(function ($subQuery) use ($customer) {
                    $subQuery->where('firstName', 'like', "%{$customer}%")
                              ->orWhere('lastName', 'like', "%{$customer}%");
                });
            });
        }

        if (!empty($invoice_no)) {
            $query->where('invoice_no', 'like', "%{$invoice_no}%");
        }

        if (!empty($startDate) && !empty($endDate)) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        if(!empty($productsku))
        {
            $query->whereHas('order_item.product',function($innerQuery) use ($productsku)
            {
                $innerQuery->where('sku', 'like', "%{$productsku}%");
            });
        }

        if(!empty($size))
        {
            $query->whereHas('order_item.product_sizes',function($innerQuery) use ($size)
            {
                $innerQuery->where('size', 'like', "%{$size}%");
            });
        }

        $orders = $query->get();

        // dd($orders);
        return response()->json($orders);
    }
}
