<?php

namespace App\Http\Controllers\Admin;


use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Image;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view('admin.category.index',compact('categories'));
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
            'category_name' => 'required',
            'category_icon' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'category_image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
        ];

        $customMessages = [
            'category_name.required' => 'The category name field is required.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        // Validate the request
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else{

            $iconImage = $request->file('category_icon');
            // create new manager instance with desired driver
            $manager = new ImageManager(new Driver());

            $iconName = 'icon_' . time() . '.' . $iconImage->getClientOriginalExtension();
            // read image from filesystem
            $img = $manager->read($iconImage);

            // $img = $img->resize(150, 150);
            // Save the original image

            $iconPath = 'category_image/icons/' . $iconName;
            Storage::disk('public')->put( $iconPath , (string)$img->encode());

            $category = new Category;
            $category->categories_id = $request->categories_id;
            $category->category_name = $request->category_name;
            $category->parent_category = $request->parent_category;
            $category->category_icon = $iconPath;
            $category->status = $request->status ? 1 : 0;

            if ($request->hasFile('category_image')) {
                $image = $request->file('category_image');
                // create new manager instance with desired driver
                $manager = new ImageManager(new Driver());
                $imageName = $request->category_name . '_' . time() . '.' . $image->getClientOriginalExtension();
                // read image from filesystem
                
                $img = $manager->read($image);
                
                // $img = $img->resize(150, 150);
                // Save the original image
                
                $imagePath = 'category_image/' . $imageName;
                Storage::disk('public')->put( $imagePath , (string)$img->encode());

                // save image to db
                $category->category_image = $imageName;
            }

            // Save only if color_name is unique
            $existingcategory = Category::where('category_name', $category->category_name)->first();
            if (!$existingcategory) {
                $category->save();
                // Set success message in session
                Session::flash('success', 'Category added successfully.');
            } else {
                // Set error message in session
                Session::flash('danger', 'The category already exists.');
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
        $category = Category::findOrFail($id);

        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->category_id;
        $category = Category::find($id);

        $rules = [
            'category_name' => 'required',
            'category_icon' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'category_image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
        ];

        $customMessages = [
            'category_name.required' => 'The category name field is required.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        // Validate the request
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else{

                        if($request->hasFile('category_icon'))
            {
                $iconImage = $request->file('category_icon');
                // create new manager instance with desired driver
                $manager = new ImageManager(new Driver());
                $iconName = 'icon_' . time() . '.' . $iconImage->getClientOriginalExtension();
                // read image from filesystem
                $img = $manager->read($iconImage);

                // $img = $img->resize(150, 150);
                // Save the original image

                $iconPath = 'category_image/icons/' . $iconName;
                Storage::disk('public')->put( $iconPath , (string)$img->encode());
                Storage::delete('public/'.$category->category_icon);

                $cat_icon =  $iconPath;
            }
            else{
                $cat_icon = $category->category_icon;
            }

            if ($request->hasFile('category_image')) {

                $image = $request->file('category_image');
                // create new manager instance with desired driver
                $manager = new ImageManager(new Driver());
                $imageName = $request->category_name . '_' . time() . '.' . $image->getClientOriginalExtension();
                // read image from filesystem
                $img = $manager->read($image);

                // $img = $img->resize(200, 150);
                // Save the original image
                $imagePath = 'category_image/' . $imageName;
                Storage::disk('public')->put( $imagePath , (string)$img->encode());
                Storage::delete('public/category_image/'.$category->category_image);

                $cat_image = $imageName;
            }
            else{
                $cat_image = $category->category_image;
            }


            $category->update([
                'category_name' => $request->category_name,
                'parent_category' => $request->parent_category,
                'category_icon' => $cat_icon,
                'category_image' => $cat_image,
                'status' => $request->status ? 1 : 0,
            ]);
            
            Session::flash('success', 'Category Updated successfully.');
            return response()->json(['status'=> 200, 'message' => 'Category Updated Successfully!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
        $category = Category::find($id);

        Storage::delete('public/category_image/'.$category->category_image);
        Storage::delete('public/'.$category->category_icon);
        $category->delete();
        return redirect()->back()->with('success', 'Category deleted successfully.');
        } catch (\Exception $e) {
            // Log the exception or handle it in a way that makes sense for your application
            return redirect()->back()->with('danger', 'This Categoy have Subcategory.');
        }
    }
}
