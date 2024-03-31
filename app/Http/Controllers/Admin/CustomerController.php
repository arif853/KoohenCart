<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use App\Models\District;
use App\Models\Division;
use App\Models\Postcode;
use App\Models\shipping;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        return view('admin.customer.index',compact('customers'));
    }


    /**
     * Display a listing of the resource.
     */
    public function customer_details(Request $request)
    {
        $id = $request->id;
        $customer = Customer::find($id);
        // $division = Division::where('id',$customer->division)->get();
        // $district = District::where('id',$customer->district)->get();
        $division = Division::find($customer->division);
        $district = District::find($customer->district);
        $area = Postcode::find($customer->area);

        $shipping = shipping::where('customer_id',$customer->id)->get();

        $customerOrders = $customer->order; // Get all orders for the customer
        $totalOrderAmount = $customerOrders->sum('total');
        $customerProducts = collect();
        $totalProductCount = 0;

        // Iterate through each order and collect the associated products
        foreach ($customerOrders as $order) {
            $orderItems = $order->order_item; // Get all order items for the order

            foreach ($orderItems as $orderItem) {
                $product = $orderItem->product; // Get the product details for the order item
                $product->load('product_images');
                $customerProducts->push($product);
                $totalProductCount++;
            }
        }
        $totalOrders = $customerOrders->count();
        // echo '<pre>';
        // print_r($customerProducts);
        return view('admin.customer.customer_profile',compact(
            'customer',
            'division',
            'district',
            'area',
            'shipping',
            'customerProducts',
            'totalOrders',
            'totalProductCount',
            'totalOrderAmount',));
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
    public function CustomerFilter(Request $request)
    {
        $customerName = $request->customerName;
        $customerPhone = $request->customerPhone;
        $customerEmail = $request->customerEmail;

        // Debugging output to see the received parameters
      //  dd($customerName, $customerPhone, $customerEmail);

        $query = Customer::query();

        if ($customerName) {
            $query->where(function ($q) use ($customerName) {
                $q->where('firstName', 'like', "%$customerName%")
                  ->orWhere('lastName', 'like', "%$customerName%");
            });
        }

        if ($customerPhone) {
            $query->where('phone', 'like', "%$customerPhone%");
        }

        if ($customerEmail) {
            $query->where('email', 'like', "%$customerEmail%");
        }

        // Debugging output to see the generated query
      //  dd($query->toSql(), $query->getBindings());

        $customerFilters = $query->get();
       // dd(json_encode($customrFilters));
        return response()->json($customerFilters);
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $customer = Customer::findOrFail($request->id);
        return response()->json($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $customer = Customer::find($request->customer_id);

            $customer->update([
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'billing_address' => $request->customerAddress,
                'phone' => $request->customerPhone,
                'email' => $request->customerEmail
            ]);

        Session::flash('success', 'Customer data has beed Updated.');
        return response()->json(['status'=> 200]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try{
            $supplier = Customer::find($request->id);
            $supplier->delete();
            // Session::flash('success', 'Customer data has beed Deleted.');
            return redirect()->back()->with('success', 'Customer deleted successfully.');
        } catch (\Exception $e) {
            // Log the exception or handle it in a way that makes sense for your application
            return redirect()->back()->with('danger', 'This Customer can not be deleted .');
        }
    }

    public function export()
    {
        $customers = Customer::all();

        $csvFileName = 'CustomerList.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'COntent-Disposition' => 'attachment; filename = "'.$csvFileName.'"',
        ];

        $handle = fopen('php://output','w');
        fputcsv($handle,['First Name', 'Last Name', 'Phone', 'Email','Register Date']);

        foreach($customers as $customer)
        {
            // $customerName = $customer->firstName .' '. $customer->lastName;
            $registerdate = $customer->created_at->format('d M Y');
            fputcsv($handle,[$customer->firstName , $customer->lastName, $customer->phone, $customer->email, $registerdate]);
        }

        fclose($handle);

        return Response::make('',200,$headers);
    }

    public function import(Request $request)
    {
        if($request->hasFile('file')){
            $file = $request->file('file');
            $filecontent = file($file->getPathname());

        }

        foreach($filecontent as $content)
        {
            $data = str_getcsv($content);
            Customer::create([
                'firstName' => $data[0],
                'lastName' => $data[1],
                'phone' => $data[2],
                'email' => $data[3],
            ]);
            // dd($data[2]);
        }
        Session::flash('success','Customer store from csv successfully');
        return redirect()->back();
    }
}
