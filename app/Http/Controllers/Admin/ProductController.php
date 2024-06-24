<?php

namespace App\Http\Controllers\Admin;

use App\Models\Size;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Category;
use App\Models\Products;
use App\Models\Product_tag;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Models\Product_extra;
use App\Models\Product_image;
use App\Models\Product_price;
use App\Models\products_size;
use Illuminate\Http\Response;
use App\Models\products_color;
use Illuminate\Validation\Rule;
use App\Models\Product_overview;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use App\Models\Product_additionalinfo;
use App\Models\Product_thumbnail;
use App\Models\Supplier;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // Retrieve overviews for a product
        // $products = Products::all();
        // $overviews = $products->overviews;
        $products = Products::with([
            'overviews',
            'product_infos',
            'product_images',
            'product_extras',
            'tags',
            'sizes',
            'colors',
            'brand',
            'category',
            'product_stocks',
        ])->get();


        foreach($products as $product)
        {
            $product->balance = $product->product_stocks->sum('inStock') - $product->product_stocks->sum('outStock');
        }

        return view('admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::all();
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $colors = Color::all();
        $sizes = Size::all();
        $suppliers = Supplier::all();
        return view('admin.products.create',[
            'brands' => $brands,
            'categories' => $categories,
            'subcategories' => $subcategories,
            'colors' =>$colors,
            'sizes' =>$sizes,
            'suppliers'=> $suppliers
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'product_name' => 'required|string',
            'product_brand' => 'required|exists:brands,id',
            'product_category' => 'required|exists:categories,id',
            'raw_price' => 'nullable|numeric',
            'regular_price' => 'nullable|numeric',
            'offer_price' => 'nullable|numeric',
            'description' => 'required|string',
            'sku' => 'required|string|unique:products,sku',
            'status' => 'required|in:active,inactive',

            'featurename.*' => 'nullable|string',
            'featurevalue.*' => 'nullable|string',

            'tags.*' => 'nullable|string',

            'info_name.*' => 'nullable|string',
            'info_value.*' => 'nullable|string',

            'product_image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
            'product_thumnail.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',

            'product_size.*' => 'nullable|exists:sizes,id',
            'product_color.*' => 'nullable|exists:colors,id',

            'warranty' => 'nullable|string',
            'return_policy' => 'nullable|string',
            'delivery_type' => ['nullable', 'string', Rule::in(['0', '1', '2'])],
            'emi' => ['nullable', 'string', Rule::in(['Available', 'Not Available'])],
        ];


        $validator = Validator::make($request->all(),$rules);

        // Validate the request
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else{
            // Save the product with dynamic fields data
            $product = new Products;
            $product->product_name = $request->product_name;
            $product->brand_id = $request->product_brand;
            $product->category_id = $request->product_category;
            $product->supplier_id = $request->supplier;
            $product->raw_price = $request->raw_price;
            $product->regular_price = $request->regular_price;
            // $product->offer_price = $request->offer_price;
            $product->description = $request->description;
            $product->sku = $request->sku;
            $product->status = $request->status;
            $product->save();

            // Save product sizes
            $sizes = $request->input('product_size', []);

            foreach ($sizes as $sizeId) {
                products_size::create([
                    'product_id' => $product->id,
                    'size_id' => $sizeId,
                ]);
            }
            // Save product sizes
            $colors = $request->input('product_color', []);

            foreach ($colors as $colorId) {
                products_color::create([
                    'product_id' => $product->id,
                    'color_id' => $colorId,
                ]);
            }

             if($request->hasFile('product_thumbnail')){
                $thumbnail = $request->file('product_thumbnail');

                foreach ($thumbnail as $index => $image) {
                    $manager = new ImageManager(new Driver());

                    $imageName = $product->slug.'_' .$index . '.' . $image->getClientOriginalExtension();

                    $img = $manager->read($image);
                    // $encoded = $img->toWebp();
                    // $img = $img->resize(400, 600);

                    $imagePath = 'product_images/thumbnail/' . $imageName;
                    // $imagePath2 = 'product_images/thumbnail/' . $encoded;

                    Storage::disk('public')->put($imagePath , (string)$img->encode());
                    // Storage::disk('public')->put($imagePath2 , (string)$encoded->encode());

                    Product_thumbnail::create([
                        'product_id' => $product->id,
                        'product_thumbnail' => $imageName,
                    ]);
                }
            }


            if($request->hasFile('product_image')){
                $images = $request->file('product_image');

                foreach ($images as $index => $image) {
                    $manager = new ImageManager(new Driver());

                    $imageName = $product->slug.'_' .$index . '.' . $image->getClientOriginalExtension();

                    $img = $manager->read($image);
                    // $img = $img->resize(400, 600);
                    $imagePath = 'product_images/' . $imageName;
                    Storage::disk('public')->put($imagePath , (string)$img->encode());

                    Product_image::create([
                        'product_id' => $product->id,
                        'product_image' => $imageName,
                    ]);
                }
            }

            // overview store here
            $featureNames = $request->input('featurename',[]);
            $featureValues = $request->input('featurevalue',[]);

            foreach ($featureNames as $index => $name) {
                Product_overview::create([
                    'product_id' => $product->id,
                    'overview_name' => $featureNames[$index],
                    'overview_value' => $featureValues[$index],
                ]);
            }
            // additional info store
            $infoNames = $request->input('additional_name', []);
            $infoValues = $request->input('additional_value', []);

            foreach ($infoNames as $index => $name) {

                Product_additionalinfo::create([
                    'product_id' => $product->id,
                    'additional_name' => $infoNames[$index],
                    'additional_value' => $infoValues[$index],
                ]);
            }

            // Extra info store
            Product_extra::create([
                'product_id' => $product->id,
                'warranty_type' => $request->input('warranty'),
                'return_policy' => $request->input('return_policy'),
                'delivery_type' => $request->input('delivery_type'),
                'emi' => $request->input('emi'),
            ]);

            // Offer price store
            $price = $product->regular_price;

            $percentage = $request->input('percentage');
            $amount = $request->input('amount');
            $offer_price = 0;

            // If offer is in percentage, convert percentage to amount
            if (!empty($percentage)) {
                $amount_offer = ($percentage / 100) * $price;
                $offer_price = $price - $amount_offer;
            }else{
                $amount_offer = $amount;
            }

            // If offer is in amount, convert amount to percentage
            if (!empty($amount)) {
                $percentage_offer = ($amount / $price) * 100;
                $percentage_offer = number_format($percentage_offer,1);
                //$amount_discount = ($percentage_offer / 100) * $price; // Calculate the discount amount based on the percentage
                $offer_price = $price - $amount;
            }
            else{
                $percentage_offer = $percentage;
            }

            Product_price::create([
                'product_id' => $product->id,
                'offer_price' => $offer_price,
                'percentage' => $percentage_offer,
                'amount' => $amount_offer,
            ]);


            $tags = explode(',', $request->input('tags'));
            foreach ($tags as $tagName) {
                Product_tag::firstOrCreate([
                    'product_id' => $product->id,
                    'tag' => trim($tagName),
                ]);
            }

            Session::flash('success', 'Product added successfully.');
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $products = Products::with([
            'overviews',
            'product_infos',
            'product_images',
            'product_extras',
            'tags',
            'sizes',
            'colors',
            'brand',
            'category',
            'product_price',
            'supplier'
        ])->where('slug', $slug)->get();
        return view('admin.products.product-details',compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brands = Brand::all();
        $categories = Category::all();
        $subcategories = Subcategory::all();
        $colors = Color::all();
        $sizes = Size::all();
        $suppliers = Supplier::all();

        $products = Products::with([
            'overviews',
            'product_infos',
            'product_images',
            'product_extras',
            'tags',
            'sizes',
            'colors',
            'brand',
            'category',
            'product_price',
            'supplier'
        ])->findOrFail($id);
            // dd($products);
        // return response()->json($products, 200, [], JSON_PRETTY_PRINT);

            return view('admin.products.edit',compact('products','brands','categories','subcategories','colors','sizes','suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'product_name' => 'required|string',
            'product_brand' => 'required|exists:brands,id',
            'product_category' => 'required|exists:categories,id',
            'raw_price' => 'nullable|numeric',
            'regular_price' => 'nullable|numeric',
            'offer_price' => 'nullable|numeric',
            'description' => 'required|string',
            // 'sku' => 'required|string|unique:products,sku',
            'status' => 'required|in:active,inactive',

            'featurename.*' => 'nullable|string',
            'featurevalue.*' => 'nullable|string',

            'tags.*' => 'nullable|string',

            'info_name.*' => 'nullable|string',
            'info_value.*' => 'nullable|string',

           'product_image.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
            'product_thumnail.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',

            'product_size.*' => 'nullable|exists:sizes,id',
            'product_color.*' => 'nullable|exists:colors,id',

            'warranty' => 'nullable|string',
            'return_policy' => 'nullable|string',
            'delivery_type' => ['nullable', 'string', Rule::in(['0', '1', '2'])],
            'emi' => ['nullable', 'string', Rule::in(['Available', 'Not Available'])],
        ];


        $validator = Validator::make($request->all(),$rules);

        // Validate the request
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else{
            $product = Products::find($id);

            // Update general product information
            $product->update([
                'product_name' => $request->product_name,
                'brand_id' => $request->product_brand,
                'category_id' => $request->product_category,
                'supplier_id' => $request->supplier,
                'raw_price' => $request->raw_price,
                'regular_price' => $request->regular_price,
                'description' => $request->description,
                // 'sku' => $request->sku,
                'status' => $request->status,
            ]);

            // Update product sizes
            $sizes = $request->input('product_size', []);
            $product->sizes()->sync($sizes);

            // Update product colors
            $colors = $request->input('product_color', []);
            $product->colors()->sync($colors);

            // $images = $request->file('product_image');

            // Retrieve the existing images associated with the product
            $existingImages = $product->product_images;

            // Get the new set of images from the request
            if($request->hasFile('product_image')){
                $newImages = $request->file('product_image');

                // Update or add new images
                foreach ($newImages as $index => $newImage) {
                    $manager = new ImageManager(new Driver());

                    $imageName = $product->slug . '_' . $index . '_' . time() . '.' . $newImage->getClientOriginalExtension();

                    $img = $manager->read($newImage);
                    // $img = $img->resize(400, 600);
                    $imagePath = 'product_images/' . $imageName;

                    // Check if an image with the same name already exists
                    $existingImage = $existingImages->where('product_image', $imageName)->first();

                    if ($existingImage) {
                        // Update existing image
                        $existingImage->update([
                            'product_image' => $imageName,
                        ]);
                    } else {
                        // Add new image
                        Product_image::create([
                            'product_id' => $product->id,
                            'product_image' => $imageName,
                        ]);
                    Storage::disk('public')->put($imagePath, (string) $img->encode());

                    }
                }
            }

            $existingthumbs = $product->product_thumbnail;

            if($request->hasFile('product_thumbnail')){
                $thumbnail = $request->file('product_thumbnail');

                foreach ($thumbnail as $index => $image) {
                    $manager = new ImageManager(new Driver());

                    $imageName = $product->slug.'_' .$index . '_' . time() . '.' . $image->getClientOriginalExtension();

                    $img = $manager->read($image);
                    // $encoded = $img->toWebp();
                    // $img = $img->resize(400, 600);

                    $imagePath = 'product_images/thumbnail/' . $imageName;

                    // Check if an image with the same name already exists
                    $existingthumb = $existingthumbs->where('product_thumbnail', $imageName)->first();

                    if ($existingthumb) {
                        // Update existing image
                        $existingthumb->update([
                            'product_thumbnail' => $imageName,
                        ]);
                    } else {

                    Product_thumbnail::create([
                        'product_id' => $product->id,
                        'product_thumbnail' => $imageName,
                    ]);

                    Storage::disk('public')->put($imagePath , (string)$img->encode());
                }
            }
        }

            // // Delete images that were removed
            // $removedImages = $existingImages->pluck('product_image')->diff($newImages->pluck('product_image'));

            // foreach ($removedImages as $removedImage) {
            //     // Find and delete the removed image
            //     Product_image::where('product_id', $product->id)->where('product_image', $removedImage)->delete();

            //     // Optionally, you may want to delete the actual image file from storage
            //     Storage::disk('public')->delete('product_images/' . $removedImage);
            // }


            // Update overview information
            $featureNames = $request->input('featurename', []);
            $featureValues = $request->input('featurevalue', []);

            foreach ($featureNames as $index => $name) {
                $overview = Product_overview::where('product_id', $product->id)->where('overview_name', $featureNames[$index])->first();

                if ($overview) {
                    $overview->update([
                        'overview_name' => $featureNames[$index],
                        'overview_value' => $featureValues[$index],
                    ]);
                } else {
                    Product_overview::create([
                        'product_id' => $product->id,
                        'overview_name' => $featureNames[$index],
                        'overview_value' => $featureValues[$index],
                    ]);
                }
            }

            // additional info store
            $infoNames = $request->input('additional_name', []);
            $infoValues = $request->input('additional_value', []);

            foreach ($infoNames as $index => $name) {
                $additionalInfo = Product_additionalinfo::where('product_id', $product->id)->where('additional_name', $infoNames[$index])->first();

                if ($additionalInfo) {
                    $additionalInfo->update([
                        'additional_name', $infoNames[$index],
                        'additional_value' => $infoValues[$index],
                    ]);
                } else {
                    Product_additionalinfo::create([
                        'product_id' => $product->id,
                        'additional_name' => $infoNames[$index],
                        'additional_value' => $infoValues[$index],
                    ]);
                }
            }

            $product_extra = Product_extra::where('product_id', $product->id)->first();
            // Extra info store
            $product_extra->update([
                // 'product_id' => $product->id,
                'warranty_type' => $request->input('warranty'),
                'return_policy' => $request->input('return_policy'),
                'delivery_type' => $request->input('delivery_type'),
                'emi' => $request->input('emi'),
            ]);

            // Offer price store
            $price = $product->regular_price;

            $percentage = $request->input('percentage');
            $amount = $request->input('amount');
            $offer_price = 0;

            // If offer is in percentage, convert percentage to amount
            if (!empty($percentage)) {
                $amount_offer = ($percentage / 100) * $price;
                $offer_price = $price - $amount_offer;
            }else{
                $amount_offer = $amount;
            }

            // If offer is in amount, convert amount to percentage
            if (!empty($amount)) {
                $percentage_offer = ($amount / $price) * 100;
                //$amount_discount = ($percentage_offer / 100) * $price; // Calculate the discount amount based on the percentage
                $offer_price = $price - $amount;
                // $percentage_offer = intval($percentage_offer);
                $percentage_offer = number_format($percentage_offer, 0);
            }
            else{
                $percentage_offer = $percentage;
            }
            $product_price = Product_price::where('product_id',$product->id)->first();
            $product_price->update([
                // 'product_id' => $product->id,
                'offer_price' => $offer_price,
                'percentage' => $percentage_offer,
                'amount' => $amount_offer,
            ]);


            // Update tags
            $tags = explode(',', $request->input('tags'));
            foreach ($tags as $tagName) {
                $product->tags()->updateOrCreate(
                    ['tag' => trim($tagName)]
                    // additional attributes if needed
                );
            }

            Session::flash('success', 'Product has been Updated successfully.');
        }

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = Products::findOrFail($id);

            $product_image = Product_image::where('product_id',$id);
            // Trigger the deleting event
            // foreach ($product->product_image as $image) {
            //     Storage::delete('public/product_images/' . $image->product_image);
            // }
            $product->delete();

            return redirect()->route('products.index')->with('success', 'Product deleted successfully.');

        } catch (\Exception $e) {
            // Log the exception or handle it in a way that makes sense for your application
            return redirect()->back()->with('warning', 'Error deleting product.');
        }
    }

    public function image_destroy($id)
    {
        $product_image = Product_image::findOrFail($id);
        if ($product_image) {
            Storage::delete('public/product_images/' . $product_image->product_image);
            $product_image->delete();

            Session::flash('success', 'Product image has been deleted successfully!!');

            // Return a JSON response indicating success
            return response()->json(['message' => 'Product image deleted successfully'], Response::HTTP_OK);
        } else {
            // Return a JSON response indicating failure
            return response()->json(['error' => 'Product image not found'], Response::HTTP_NOT_FOUND);
        }
    }

    public function thumb_destroy($id){

        $product_thumbnail = Product_thumbnail::findOrFail($id);
        if ($product_thumbnail) {
            Storage::delete('public/product_images/thumbnail' . $product_thumbnail->product_thumbnail);
            $product_thumbnail->delete();

            Session::flash('success', 'Product thumbnail image has been deleted !!');


            // Return a JSON response indicating success
            return response()->json(['message' => 'Thumbnail image deleted successfully'], Response::HTTP_OK);
        } else {
            // Return a JSON response indicating failure
            return response()->json(['error' => 'Product image not found'], Response::HTTP_NOT_FOUND);
        }
    }

    public function sizeChartUpdate(string $id)
    {
        $product = Products::findOrFail($id);

        if($product)
        {
            $product->is_sizechart = !$product->is_sizechart;
            $product->save();
        }
        Session::flash('success','Size chart status updated for '.$product->sku);
        return redirect()->back();
    }

    public function productStatusUpdate(string $id)
    {
        $product = Products::findOrFail($id);

        if($product)
        {
            $product->status = $product->status == 'active' ? 'inactive' : 'active';
            $product->save();
        }
        Session::flash('success','Status updated for '.$product->sku);
        return redirect()->back();
    }


    public function ProductFilter(Request $request)
    {
        $product_name = $request->input('product_name');
        $productSku = $request->input('sku');
        $startDate = $request->input('created_at');
        $endDate = $request->input('updated_at');

        $query = Products::query()->with(['overviews', 'product_infos', 'product_images', 'product_extras', 'tags', 'sizes', 'colors', 'brand', 'category']);

        $query->where(function ($query) use ($product_name, $productSku, $startDate, $endDate) {
            if ($product_name) {
                $query->where('product_name', 'like', "%{$product_name}%");
            }
            if ($productSku) {
                $query->orWhere('sku', 'like', "%{$productSku}%");
            }
            if ($startDate && $endDate) {
                $query
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->orWhereBetween('updated_at', [$startDate, $endDate])
                    ->whereDate('created_at', $startDate)
                    ->orWhereDate('updated_at', $endDate);
            } elseif ($startDate) {
                $query->whereDate('created_at', $startDate);
            } elseif ($endDate) {
                $query->whereDate('updated_at', $endDate);
            }
        });
        $products = $query->get();
        return response()->json(['products' => $products]);
    }
}
