<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ads;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allads = Ads::all();
        return view('admin.ads.index',compact('allads'));
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
        $rules = [
            'ads_header' => 'required|string',
            'ads_title' => 'required|string',
            'btnText' => 'nullable|string',
            'shop_url' => 'nullable|url',
            'ads_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ];

        $validator = Validator::make($request->all(),$rules);

        // Validate the request
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else{

            if($request->hasFile('ads_image')){

                $image = $request->file('ads_image');

                $manager = new ImageManager(new Driver());
                $imageName =  time() .  '.' . $image->getClientOriginalExtension();

                $img = $manager->read($image);
                $imagePath = 'ads_banner/' . $imageName;

                Storage::disk('public')->put($imagePath , (string)$img->encode());
            }

            $ads = new Ads;
            $ads->header = $request->ads_header;
            $ads->title = $request->ads_title;
            $ads->btntext = $request->btnText;
            $ads->shop_url = $request->shop_url;
            $ads->is_featured = $request->is_featured ? 1 : 0;
            $ads->is_feature_no = $request->is_feature_no;
            $ads->image = $imagePath;
            $ads->save();

            Session::flash('success', 'Ads-Banner has been added successfully.');

            return redirect()->back();
        }
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
        $id = $request->id;
        $ads = Ads::findOrFail($id);

        return response()->json($ads);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $id = $request->ads_id;
        $ads = Ads::find($id);

        $rules = [
            'ads_header' => 'required|string',
            'ads_title' => 'required|string',
            'btnText' => 'nullable|string',
            'shop_url' => 'nullable|url',
            'ads_image' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ];

        $validator = Validator::make($request->all(),$rules);

        // Validate the request
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else{

            if($request->hasFile('ads_image')){

                $image = $request->file('ads_image');

                $manager = new ImageManager(new Driver());
                $imageName =  time() .  '.' . $image->getClientOriginalExtension();

                $img = $manager->read($image);

                $imagePath = 'ads_banner/' . $imageName;

                Storage::disk('public')->put($imagePath , (string)$img->encode());
                Storage::delete('public/'.$ads->image);

                $ads_image = $imagePath;
            }
            else{
                $ads_image = $ads->image;
            }


            $ads->header = $request->ads_header;
            $ads->title = $request->ads_title;
            $ads->btntext = $request->btnText;
            $ads->shop_url = $request->shop_url;
            $ads->is_featured = $request->is_featured ? 1 : 0;
            $ads->is_feature_no = $request->is_feature_no;
            $ads->image = $ads_image;
            $ads->save();

            Session::flash('success', 'Ads-Banner has been updated successfully.');

            return response()->json(['status' => 200]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $ads = Ads::find($id);

            Storage::delete('public/'.$ads->image);
            $ads->delete();

            return redirect()->back()->with('success', 'Ads-banner has been removed.');

            } catch (\Exception $e) {
                // Log the exception or handle it in a way that makes sense for your application
                return redirect()->back()->with('danger', 'This Banner can not removed.');
            }
    }

    public function UpdateStatus(Request $request)
    {
        $ads = Ads::find($request->id);

        if ($ads) {
            $ads->status = $ads->status == 1 ? 0 : 1;
            $ads->save();

            Session::flash('success', 'Status Updated.');
        } else {
            Session::flash('error', 'Ad not found.');
        }

        return redirect()->back();
        // dd($ads);
    }
}
