<?php

namespace App\Http\Controllers\Admin;

use App\Models\Products;
use Illuminate\Http\Request;

use Intervention\Image\Image;
use App\Models\FeatureProducts;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;

class FeatureProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::latest('id')->get();
        $fproducts = FeatureProducts::latest('id')->get();
        return view('admin.feature.product_feature', ['products' => $products, 'fproducts' => $fproducts]);
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
            'feature_products_title' => 'required',
            'products_id' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ];

        $customMessages = [
            'feature_products_title.required' => 'Need a title for Feature item.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        // Validate the request
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $featureImage = $request->file('image');
            // create new manager instance with desired driver
            $manager = new ImageManager(new Driver());

            $featureName = time() . '.' . $featureImage->getClientOriginalExtension();

            // read image from filesystem
            $img = $manager->read($featureImage);

            // $img = $img->resize(150, 150);
            // Save the original image

            $featurePath = 'feature/products/' . $featureName;
            Storage::disk('public')->put($featurePath, (string) $img->encode());

            $item = new FeatureProducts();
            $item->feature_products_title = $request->feature_products_title;
            // $item->text = $request->text;
            $item->image = $featurePath;
            $item->status = $request->status ? 'Active' : 'Inactive';

            $productIdArray = $request['products_id'];

            // Prepare an array to hold multiple insert values
            $insertValues = [];
            $item->save();
            foreach ($productIdArray as $productId) {
                $insertValues[] = [
                    'feature_products_id' => $item->id,
                    'products_id' => $productId,
                ];
            }

            // Insert multiple records into the pivot table
            DB::table('feature_products_with_pivot')->insert($insertValues);

            // Set success message in session
            Session::flash('success', 'Feature item has been added successfully.');
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
        $feature_products = FeatureProducts::findOrFail($id);
        return response()->json($feature_products);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->feature_id;
        $featureItem = FeatureProducts::find($id);


        // Check if there's a new image uploaded
        if ($request->hasFile('image')) {
            $featureImage = $request->file('image');
            $featurePath = 'feature/products/' . time() . '.' . $featureImage->getClientOriginalExtension();

            // Save the image
            Storage::disk('public')->put($featurePath, file_get_contents($featureImage));

            // Delete the old image
            Storage::delete('public/' . $featureItem->image);
            $featureItem->image = $featurePath;
        }

        // Update feature product details
        $featureItem->feature_products_title = $request->feature_products_title;
        $featureItem->status = $request->status ? 'Active' : 'Inactive';
        $featureItem->save();

        // Sync the products in the pivot table
        $featureItem->products()->sync($request->input('products_id'));

        return response()->json([
            'status' => 'success',
            'message' => 'Feature Products Updated Successfully!',
        ]);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try{
            $feature_item = FeatureProducts::find($request->id);

            Storage::delete('public/'.$feature_item->image);
            $feature_item->delete();

            return redirect()->back()->with('success', 'Item deleted successfully.');
        } catch (\Exception $e) {
            // Log the exception or handle it in a way that makes sense for your application
            return redirect()->back()->with('danger', 'This item can be deleted.');
        }
    }
}
