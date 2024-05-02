<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Setting;
use App\Models\District;
use App\Models\Postcode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::first();
        return view('admin.settings',compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     */

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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request)
    {

        $settings = Setting::first();

        if (!$settings) {
            $settings = new Setting(); // Create a new instance if no settings found
        }

        $settings->primary_mobile_no = $request->input('primary_mobile_no');
        $settings->secondary_mobile_no = $request->input('secondary_mobile_no');
        $settings->whatsapp_url = $request->input('whatsapp_url');
        $settings->email = $request->input('email');
        $settings->company_address = $request->input('company_address');
        $settings->company_short_details = $request->input('company_short_details');
        $settings->save();

        Session::flash('success', 'Web Settings have been updated successfully.');

        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
