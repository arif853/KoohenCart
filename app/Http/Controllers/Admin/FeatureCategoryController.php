<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Feature_category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;

class FeatureCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feature_items = Feature_category::all();
        $categories = Category::all();
        return view('admin.feature.category_feature',compact('categories','feature_items'));
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
            'title' => 'required',
            'parent_category' => 'required',
            'feature_image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
        ];

        $customMessages = [
            'title.required' => 'Need a title for Feature item.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        // Validate the request
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else{

            $featureImage = $request->file('feature_image');
            // create new manager instance with desired driver
            $manager = new ImageManager(new Driver());

            $featureName = time() . '.' . $featureImage->getClientOriginalExtension();

            // read image from filesystem
            $img = $manager->read($featureImage);

            // $img = $img->resize(150, 150);
            // Save the original image

            $featurePath = 'feature/category/' . $featureName;
            Storage::disk('public')->put( $featurePath , (string)$img->encode());

            $item = new Feature_category;
            $item->category_id  = $request->parent_category;
            $item->title = $request->title;
            // $item->text = $request->text;
            $item->image = $featurePath;
            $item->status = $request->status ? 'Active' : 'Inactive';

            // Save only if color_name is unique
            $existingcategory = Feature_category::where('category_id', $request->parent_category)->first();
            if (!$existingcategory) {
                $item->save();
                // Set success message in session
                Session::flash('success', 'Feature item has been added successfully.');
            } else {
                // Set error message in session
                Session::flash('danger', 'Feature item already exists.');
            }
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
        $feature_cat = Feature_category::findOrFail($id);

        return response()->json($feature_cat);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->feature_id;
        $featureItem = Feature_category::find($id);

        $rules = [
            'title' => 'required',
            'parent_category' => 'required',
            'cat_feature_image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
        ];

        $customMessages = [
            'title.required' => 'Need a title for Feature item.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        // Validate the request
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else{

            if ($request->hasFile('cat_feature_image')) {

                $featureImage = $request->file('cat_feature_image');
                // create new manager instance with desired driver
                $manager = new ImageManager(new Driver());

                $featureName = time() . '.' . $featureImage->getClientOriginalExtension();

                // read image from filesystem
                $img = $manager->read($featureImage);

                // $img = $img->resize(150, 150);
                // Save the original image

                $featurePath = 'feature/category/' . $featureName;
                Storage::disk('public')->put( $featurePath , (string)$img->encode());
                Storage::delete('public/'.$featureItem->image);

                $featureItem->update([
                    'category_id' => $request->parent_category,
                    'title' => $request->title,
                    'image' => $featurePath,
                    'status' => $request->status ? 'Active' : 'Inactive',
                ]);

            }
            else{
                $category_old_image = $featureItem->image;
                $featureItem->update([
                    'category_id' => $request->parent_category,
                    'title' => $request->title,
                    'image' => $category_old_image,
                    'status' => $request->status ? 'Active' : 'Inactive',
                ]);
            }

            Session::flash('success', 'Feature category updated successfully.');
            return response()->json(['status'=> 200, 'message' => 'Feature category Updated Successfully!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try{
            $feature_item = Feature_category::find($request->id);

            Storage::delete('public/'.$feature_item->image);
            $feature_item->delete();

            return redirect()->back()->with('success', 'Item deleted successfully.');
        } catch (\Exception $e) {
            // Log the exception or handle it in a way that makes sense for your application
            return redirect()->back()->with('danger', 'This item can be deleted.');
        }
    }
}
