<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PrivacyPolicy;
use App\Http\Controllers\Controller;

class PrivacyController extends Controller
{
    public function index(){
        $privacy_policy = PrivacyPolicy::first();
        return view('admin.privacy_policy.index',compact('privacy_policy'));
    }

    
    public function update(Request $request){
        $request->validate([
            'title' => 'required|string',
            'description' => 'required'
        ]);
        $privacy_policy = PrivacyPolicy::first();
      
        if ($privacy_policy == null) {
            PrivacyPolicy::create([
                'title' => $request->title,
                'description' => $request->description
            ]);
        } else {
            $privacy_policy->update([
                'title'=>$request->title,
                'description'=>$request->description
            ]);
        }
        return redirect()->route('privacy_policy.index')->with('success','Privacy policy updated successfully');
    }
}
