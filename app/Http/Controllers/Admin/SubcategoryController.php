<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // The view lives at admin.Old_style_category.subcategory.index; this used
        // to point at admin.category.subcategory.index, which does not exist
        // anywhere in the project, so this page 500'd unconditionally.
        $categories = Category::all();
        $subcategories = Subcategory::with('category')->get();
        return view('admin.Old_style_category.subcategory.index',['categories' => $categories,'subcategories' => $subcategories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'category' => 'required',
            // Uniqueness is checked here, before the image is ever written to disk.
            // It used to be checked only after uploading, so a duplicate subcategory
            // name left an orphaned image file behind on every rejected submission.
            'subcategory_name' => ['required', Rule::unique('subcategories', 'subcategory_name')],
            'subcategory_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
        ];

        $customMessages = [
            'subcategory_name.required' => 'The category name field is required.',
            'subcategory_name.unique' => 'The subcategory name already exists.',
            'subcategory_image.required' => 'The category code field is required.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        // Validate the request
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $image = $request->file('subcategory_image');
        // create new manager instance with desired driver
        $manager = new ImageManager(new Driver());

        $imageName = $request->subcategory_name . '_' . time() . '.' . $image->getClientOriginalExtension();

        // read image from filesystem
        $img = $manager->read($image);
        $img = $img->resize(200, 150);
        // Save the original image
        $imagePath = 'subcategory_image/' . $imageName;
        Storage::disk('public')->put( $imagePath , (string)$img->encode());

        $subcategory = new Subcategory;
        $subcategory->category_id = $request->category;
        $subcategory->subcategory_name = $request->subcategory_name;
        $subcategory->subcategory_image = $imageName;
        $subcategory->status = $request->status ? 1 : 0;
        $subcategory->save();

        Session::flash('success', 'Subcategory added successfully.');

        return redirect()->back();
    }

    public function get_subcategory($category)
    {
        $subcategories = Subcategory::where('category_id', $category)->get();

        return response()->json($subcategories);
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
        $subcategory = Subcategory::findOrFail($id);

        return response()->json($subcategory);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->subcategory_id;
        $subcategory = Subcategory::findOrFail($id);
        $rules = [
            'category' => 'required',
            'subcategory_name' => 'required',
            'subcategory_image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
        ];

        $customMessages = [
            'subcategory_name.required' => 'The category name field is required.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        // Validate the request
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else
        {
            if($request->hasFile('subcategory_image')){
                $image = $request->file('subcategory_image');
                // create new manager instance with desired driver
                $manager = new ImageManager(new Driver());

                $imageName = $request->subcategory_name . '_' . time() . '.' . $image->getClientOriginalExtension();

                // read image from filesystem
                $img = $manager->read($image);
                $img = $img->resize(200, 150);
                // Save the original image
                $imagePath = 'subcategory_image/' . $imageName;
                Storage::disk('public')->put( $imagePath , (string)$img->encode());
                Storage::delete('public/subcategory_image/'.$subcategory->subcategory_image);

                $subcategory->update([
                    'subcategory_name' => $request->subcategory_name,
                    'subcategory_image' => $imageName,
                    'status' => $request->status ? 1 : 0,
                ]);
            }
            else{
                $subcategory_old_image = $subcategory->subcategory_image;
                $subcategory->update([
                    'subcategory_name' => $request->subcategory_name,
                    'subcategory_image' => $subcategory_old_image,
                    'status' => $request->status ? 1 : 0,
                ]);
            }
            Session::flash('success', 'Subcategory Updated successfully.');
            // Set success message in session
            return response()->json(['status'=> 200, 'message' => 'Subcategory Updated Successfully!']);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subcategory = Subcategory::findOrFail($id);

        Storage::delete('public/subcategory_image/'.$subcategory->subcategory_image);
        $subcategory->delete();

        return redirect()->back()->with('success', 'Subcategory deleted successfully.');
    }
}
