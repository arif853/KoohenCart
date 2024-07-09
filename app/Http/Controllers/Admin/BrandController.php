<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;


class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::paginate(10);
        return view('admin.brand.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('admin.brand.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'brand_name' => 'required',
            'brand_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
        ];

        $customMessages = [
            'brand_name.required' => 'The brand name field is required.',
            'brand_image.required' => 'The brand image field is required.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        // Validate the request
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('brand_image')) {
            $image = $request->file('brand_image');
            // create new manager instance with desired driver
            $manager = new ImageManager(new Driver());

            $imageName = $request->brand_name . '_' . time() . '.' . $image->getClientOriginalExtension();

            // read image from filesystem
            $img = $manager->read($image);
            // $img = $img->resize(120, 150);
            // Save the original image
            $imagePath = 'brand_image/' . $imageName;
            Storage::disk('public')->put( $imagePath , (string)$img->encode());
        }

        $brand = new Brand;
        $brand->brand_name = $request->brand_name;
        $brand->brand_image = $imageName;
        $brand->status = $request->status ? 1 : 0;

        // Save only if color_name is unique
        $existingBrand = Brand::where('brand_name', $brand->brand_name)->first();
        if (!$existingBrand) {
            $brand->save();
            // Set success message in session
            Session::flash('success', 'Brand added successfully.');
        } else {
            // Set error message in session
            Session::flash('danger', 'The Brand name already exists.');
        }
        return redirect()->back();

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
        $brand = Brand::findOrFail($id);

        return response()->json($brand);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->brand_id;
        $brand = Brand::find($id);

        $rules = [
            'brand_name' => 'required',
            'brand_image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
        ];

        $customMessages = [
            'brand_name.required' => 'The brand name field is required.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        // Validate the request
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else{

            if ($request->hasFile('brand_image')) {
                $image = $request->file('brand_image');
                // create new manager instance with desired driver
                $manager = new ImageManager(new Driver());

                $imageName = $request->brand_name . '_' . time() . '.' . $image->getClientOriginalExtension();

                // read image from filesystem
                $img = $manager->read($image);
                $img = $img->resize(120, 150);
                // Save the original image
                $imagePath = 'brand_image/' . $imageName;
                Storage::delete('public/brand_image/'.$brand->brand_image);
                Storage::disk('public')->put( $imagePath , (string)$img->encode());

                $brand->update([
                    'brand_name' => $request->brand_name,
                    'brand_image' => $imageName,
                    'status' => $request->status ? 1 : 0,
                ]);
            }else{
                $brand_old_image = $brand->brand_image;
                $brand->update([
                    'brand_name' => $request->brand_name,
                    'brand_image' => $brand_old_image,
                    'status' => $request->status ? 1 : 0,
                ]);
            }
            Session::flash('success', 'Brand Updated successfully.');
            return response()->json(['status'=> 200, 'message' => 'Brand Updated Successfully!']);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $brand = Brand::find($id);
            $brand->delete();
            Storage::delete('public/brand_image/'.$brand->brand_image);

            return redirect()->back()->with('danger', 'Brand deleted successfully.');
        } catch (\Exception $e) {
            // Log the exception or handle it in a way that makes sense for your application
            return redirect()->back()->with('danger', 'This Brand have product.');
        }
    }
}
