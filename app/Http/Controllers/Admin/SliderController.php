<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::all();

        return view('admin.slider.index',compact('sliders'));
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
            'slider_title' => 'required|string',
            'slider_sub_title' => 'required|string',
            'btnText' => 'nullable|string',
            'slider_url' => 'nullable|url',
            'slider_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ];

        $validator = Validator::make($request->all(),$rules);

        // Validate the request
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else{

            if($request->hasFile('slider_image')){

                $image = $request->file('slider_image');

                $manager = new ImageManager(new Driver());
                $imageName =  time() .  '.' . $image->getClientOriginalExtension();

                $img = $manager->read($image);

                $imagePath = 'slider/' . $imageName;

                Storage::disk('public')->put($imagePath , (string)$img->encode());

            }

            $slider = new Slider;
            $slider->title = $request->slider_title;
            $slider->subtitle = $request->slider_sub_title;
            $slider->btntext = $request->btnText;
            $slider->slider_url = $request->slider_url;
            $slider->image = $imagePath;
            $slider->save();

            Session::flash('success', 'Slider added successfully.');
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
        $slider = Slider::findOrFail($id);

        return response()->json($slider);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $id = $request->slider_id;
        $slider = Slider::find($id);

        $rules = [
            'slider_title' => 'required|string',
            'slider_sub_title' => 'required|string',
            'btnText' => 'nullable|string',
            'slider_url' => 'nullable|url',
            'slider_image' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ];

        $validator = Validator::make($request->all(),$rules);

        // Validate the request
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else{

            if($request->hasFile('slider_image')){

                $image = $request->file('slider_image');

                $manager = new ImageManager(new Driver());
                $imageName =  time() .  '.' . $image->getClientOriginalExtension();

                $img = $manager->read($image);

                $imagePath = 'slider/' . $imageName;

                Storage::disk('public')->put($imagePath , (string)$img->encode());

                Storage::delete('public/'.$slider->image);

                $sliderImage = $imagePath;
            }
            else{
                $sliderImage = $slider->image;
            }

            $slider->title = $request->slider_title;
            $slider->subtitle = $request->slider_sub_title;
            $slider->btntext = $request->btnText;
            $slider->slider_url = $request->slider_url;
            $slider->image = $sliderImage;
            $slider->save();

            Session::flash('success', 'Slider has been updated successfully.');

            return response()->json(['status' => 200]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $slider = Slider::find($id);

            Storage::delete('public/'.$slider->image);
            $slider->delete();
            return redirect()->back()->with('success', 'Slider has been removed.');

            } catch (\Exception $e) {
                // Log the exception or handle it in a way that makes sense for your application
                return redirect()->back()->with('danger', 'This slider can not be removed.');
            }
    }
}
