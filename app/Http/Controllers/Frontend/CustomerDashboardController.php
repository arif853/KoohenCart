<?php

namespace App\Http\Controllers\Frontend;

use Carbon\Carbon;
use App\Models\Size;
use App\Models\Color;
use App\Models\Order;
use App\Models\Customer;
use App\Models\District;
use App\Models\Division;
use App\Models\Postcode;
use App\Models\shipping;
use App\Models\Orderstatus;
use Illuminate\Http\Request;
use App\Models\Register_customer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class CustomerDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $divisions = Division::all();
        $districts = District::all();
        $postOffices = Postcode::all();


        return view('frontend.dashboard.dashboard',compact('divisions','districts','postOffices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function customer_update(Request $request, string $id)
    {
        $customer = Customer::find($id);
        $customer->update([
            'firstName' => $request->fname,
            'lastName' => $request->lname,
            'phone' => $request->phone,
            'email' => $request->email,
            'billing_address' => $request->billing_address
        ]);

        return redirect()->back()->with('success', 'Your Info updated successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function customerBillingUpdate(Request $request, string $id)
    {
        $request->validate([
            'b_division' => 'required|exists:divisions,id',
            'b_district' => 'required|exists:districts,id',
            'b_area' => 'required|exists:postcodes,id',
            'billing_address' => 'required|string',
        ]);

        $customer = Customer::find($id);

        $customer->update([
            'division' => $request->b_division,
            'district' => $request->b_district,
            'area' => $request->b_area,
            'billing_address' => $request->billing_address,
        ]);

        return redirect()->back()->with('success', 'Your billing info updated successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function newShipping(Request $request)
    {
        
        $request->validate([
            'customer_id' => 'exists:customers,id',
            'shipper_fname' => 'required|string',
            'shipper_phone' => 'required|string',
            'shipper_email' => 'required|email',
            'shipper_address' => 'required|string',
            's_division' => 'required|exists:divisions,id',
            's_district' => 'required|exists:districts,id',
            's_area' => 'required|exists:postcodes,id',
        ]);

        shipping::create([
            'customer_id' => $request->customer_id,
            'first_name' => $request->shipper_fname,
            'last_name' => $request->shipper_lname,
            's_phone' => $request->shipper_phone,
            's_email' => $request->shipper_email,
            'shipping_add' => $request->shipper_address,
            'division' => $request->s_division,
            'district' => $request->s_district,
            'area' => $request->s_area,
        ]);

        return redirect()->back()->with('success', 'Your shipping info updated successfully.');
    }

    public function shipping_update(Request $request, string $id)
    {
        $shipping = shipping::find($id);
        $request->validate([
            // 'customer_id' => 'exists:customers,id',
            'shipper_fname' => 'required|string',
            'shipper_phone' => 'required|string',
            'shipper_email' => 'required|email',
            'shipper_address' => 'required|string',
            's_division' => 'required|exists:divisions,id',
            's_district' => 'required|exists:districts,id',
            's_area' => 'required|exists:postcodes,id',
        ]);
        
        $shipping->update([
            'first_name' => $request->shipper_fname,
            'last_name' => $request->shipper_lname,
            's_phone' => $request->shipper_phone,
            's_email' => $request->shipper_email,
            'shipping_add' => $request->shipper_address,
            'division' => $request->s_division,
            'district' => $request->s_district,
            'area' => $request->s_area,
        ]);

        return redirect()->back()->with('success', 'Your shipping info updated successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function customerAuth_update( Request $request, string $id)
    {

        // Find the customer by ID
        $customer = Register_customer::find($id);

        // print_r($customer);
        // Check if the old password matches the current password
        if (!Hash::check($request->old_password, $customer->password)) {
            return redirect()->back()->with('danger','The old password is incorrect.');
        }else{
            // Update the password
        $customer->password = Hash::make($request->password);
        $customer->save();

        return redirect()->back()->with('success', 'Your password updated successfully.');
        }

    }
    
    public function userNameUpdate(Request $request, string $id)
    {
        $request->validate([
            'login_identifier' => 'required',
        ]);

        $userid = $request->input('login_identifier');

        // Check if the input is a valid email
        if (filter_var($userid, FILTER_VALIDATE_EMAIL)) {
            // Check if the email already exists
            if (Register_customer::where('email', $userid)->exists()) {
                return redirect()->back()->with('danger', 'An account already exists with this Email .');
            }

            // Update the email
            Register_customer::find($id)->update([
                'email' => $userid,
            ]);
        } else {
            // Check if the phone number already exists
            if (Register_customer::where('phone', $userid)->exists()) {
                return redirect()->back()->with('danger','An account already exists with this Phone number.');
            }

            // Update the phone number
            Register_customer::find($id)->update([
                'phone' => $userid,
            ]);
        }

        // You can add a success flash message if needed
        return redirect()->back()->with('success', 'User updated successfully');
    }


    public function orderReturn(Request $request)
    {
        $orderId = $request->orderId;
        $newStatus = $request->newStatus;

        // Retrieve the order
        $order = Order::find($orderId);

        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order not found']);
        }

        // Save the current order status
        $previousStatus = $order->status;

        // Update the order status
        $order->status = $newStatus;
        $order->save();

        // Update the OrderStatus table
        $statusColumn = $newStatus . '_date_time';
        Orderstatus::updateOrCreate(['order_id' => $orderId], ['status' => $newStatus, $statusColumn => Carbon::now()]);

        Session::flash('success','Your order has been returned. Someone will conatct with you soon.');

        return response()->json([
            'success' => true,
            'message' => 'Order status updated ' . $previousStatus . ' to ' . $newStatus . ' successfully']);
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
