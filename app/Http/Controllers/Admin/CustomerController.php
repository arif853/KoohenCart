<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\District;
use App\Models\Division;
use App\Models\Postcode;
use App\Models\shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::latest('id')->get();
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
            'totalOrderAmount'));
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
            Session::flash('success', 'Customer data has beed Deleted.');
            return redirect()->back()->with('danger', 'Customer deleted successfully.');
        } catch (\Exception $e) {
            // Log the exception or handle it in a way that makes sense for your application
            return redirect()->back()->with('danger', 'This Customer can not be deleted .');
        }
    }


    public function CustomerFilter(Request $request)
    {
        $customerName = $request->customer_name;
        $customerPhone = $request->customer_phone;
        $customerEmail = $request->customer_email;

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

        $customerFilters = $query->latest('created_at')->get();
       // dd(json_encode($customrFilters));
        return response()->json($customerFilters);
    }
}
