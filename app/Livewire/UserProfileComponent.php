<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Customer;
use App\Models\District;
use App\Models\Division;
use App\Models\Postcode;
use App\Models\shipping;
use Illuminate\Support\Facades\Auth;

class UserProfileComponent extends Component
{
    public function render()
    {
        $divisions = Division::all();
        $districts = District::all();
        $postOffices = Postcode::all();

        $user = Auth::guard('customer')->user();
        $customer_id = $user->customer_id;

        $customer = Customer::find($customer_id);

        $customer_area = collect();

        // Billing Information
        $b_district = District::find($customer->district);
        $b_area = Postcode::find($customer->area);

        if($customer->billing_address != null ){
            $customer_area->put('billing', collect([
                'district' => $b_district->name,
                'upazilla' => $b_area->upazila,
                'area' => $b_area->postOffice,
                'postcode' => $b_area->postCode,
            ]));
        }
        else{
            $customer_area->put('billing', collect([
                'district' => 'Please update',
                'upazilla' => 'Please update',
                'area' => 'Please update',
                'postcode' => 'Please update',
            ]));
        }


        // Shipping Information
        $shipping = shipping::where('customer_id',$customer_id)->first();
        // $shipping = shipping::find($customer->shipping);
        if($shipping){
            $s_district = District::find($shipping->district);
            $s_area = Postcode::find($shipping->area);

            $customer_area->put('shipping', collect([
                'district' => $s_district->name,
                'upazilla' => $s_area->upazila ?? 0,
                'area' => $s_area->postOffice ?? 0,
                'postcode' => $s_area->postCode ?? 0,
            ]));
        }
        return view('livewire.user-profile-component',compact('customer_area','divisions','districts','postOffices','shipping'));
    }
}