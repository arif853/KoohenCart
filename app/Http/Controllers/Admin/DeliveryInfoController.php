<?php

namespace App\Http\Controllers\Admin;

use App\Models\DeliveryInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeliveryInfoController extends Controller
{
    public function index(){
        $delivery_info = DeliveryInfo::first();
        return view('admin.delivery_info.index',compact('delivery_info'));
    }
    
    public function update(Request $request){
        $request->validate([
            'title' => 'required|string',
            'description' => 'required'
        ]);
      
        $delivery_info = DeliveryInfo::first();

        if ($delivery_info == null) {
            DeliveryInfo::create([
                'title' => $request->title,
                'description' => $request->description
            ]);
        } else {
            $delivery_info->update([
                'title' => $request->title,
                'description' => $request->description
            ]);
        }
        
      
        return redirect()->route('delivery_info.index')->with('success','Delivery Info updated successfully');
    }
}
