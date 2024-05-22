<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\TermsCondition;
use App\Http\Controllers\Controller;

class TermsConditionController extends Controller
{
    public function index(){
        $terms_conditioin = TermsCondition::first();
        return view('admin.terms_conditioin.index',compact('terms_conditioin'));
    }
    public function update(Request $request){
        $request->validate([
            'title' => 'required|string',
            'description' => 'required'
        ]);
       
        $terms_conditioin = TermsCondition::first();
        if ($terms_conditioin == null) {
            TermsCondition::create([
                'title' => $request->title,
                'description' => $request->description
            ]);
        } else {
            $terms_conditioin->update([
                'title'=>$request->title,
                'description'=>$request->description
            ]);
        }
        return redirect()->route('terms_conditioin.index')->with('success','Terms and condition updated successfully');
    }
}
