<?php

namespace App\Http\Controllers\Admin;

use App\Models\Size;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Category;
use App\Models\Products;
use App\Models\Product_tag;
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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;
use Throwable;

class ProductController extends Controller
{

    public function __construct()
    {
        // examples:
        // $this->middleware(['role:Admin','permission:CREATE PRODUCT']);
        // $this->middleware(['role_or_permission:Admin|CREATE PRODUCT']);
        // or with specific guard
        // $this->middleware(['role_or_permission:manager|edit articles,api']);
    }
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
        $colors = Color::all();
        $sizes = Size::all();
        $suppliers = Supplier::all();
        return view('admin.products.create',[
            'brands' => $brands,
            'categories' => $categories,
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

            // Field is product_thumbnail[] on the form; the "product_thumnail" rule
            // used to validate a field that doesn't exist, so a required thumbnail
            // was never actually enforced. The array itself also needs its own
            // "required" rule: a wildcard rule like 'product_image.*' => 'required'
            // only validates elements that are present - if the field is missing
            // entirely, Laravel considers the wildcard satisfied and no images are
            // enforced at all.
            'product_image' => 'required|array|min:1',
            'product_image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:10240',
            'product_thumbnail' => 'required|array|min:1',
            'product_thumbnail.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',

            'product_size.*' => 'nullable|exists:sizes,id',
            'product_color.*' => 'nullable|exists:colors,id',

            'warranty' => 'nullable|string',
            'return_policy' => 'nullable|string',
            'delivery_type' => ['nullable', 'string', Rule::in(['0', '1', '2'])],
            'emi' => ['nullable', 'string', Rule::in(['Available', 'Not Available'])],

            // Percentage/Fixed amount/No offer are a mutually exclusive radio
            // group now, so which field is actually required depends on which
            // one was picked - offer_type is the single source of truth for
            // that, rather than inferring it from whichever of percentage/
            // amount happens to be non-empty.
            'offer_type' => ['nullable', Rule::in(['percentage', 'amount', ''])],
            'percentage' => ['nullable', 'required_if:offer_type,percentage', 'numeric', 'min:0', 'max:100'],
            'amount' => ['nullable', 'required_if:offer_type,amount', 'numeric', 'min:0'],
        ];


        $validator = Validator::make($request->all(),$rules);

        // Validate the request
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Everything below is wrapped in one DB transaction and any file written to
        // disk is tracked in $writtenFiles: if anything throws partway through (a
        // corrupt upload the image library can't decode is the realistic case),
        // the DB rows are rolled back and the already-written files are deleted too
        // - otherwise a failed create left a half-built, image-less product behind
        // permanently, since Storage::put() isn't covered by the DB transaction.
        $writtenFiles = [];

        try {
            $product = DB::transaction(function () use ($request, &$writtenFiles) {
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

                if ($request->hasFile('product_thumbnail')) {
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
                        $writtenFiles[] = $imagePath;
                        // Storage::disk('public')->put($imagePath2 , (string)$encoded->encode());

                        Product_thumbnail::create([
                            'product_id' => $product->id,
                            'product_thumbnail' => $imageName,
                        ]);
                    }
                }


                if ($request->hasFile('product_image')) {
                    $images = $request->file('product_image');

                    foreach ($images as $index => $image) {
                        $manager = new ImageManager(new Driver());

                        $imageName = $product->slug.'_' .$index . '.' . $image->getClientOriginalExtension();

                        $img = $manager->read($image);
                        // $img = $img->resize(400, 600);
                        $imagePath = 'product_images/' . $imageName;
                        Storage::disk('public')->put($imagePath , (string)$img->encode());
                        $writtenFiles[] = $imagePath;

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

                // Offer price store. offer_type (radio: percentage/amount/none)
                // says which mode the admin actually chose, so only that field
                // is trusted - the other is ignored even if it somehow still
                // carries a value, instead of guessing from whichever field is
                // non-empty.
                $price = (float) ($product->regular_price ?? 0);
                $offerType = $request->input('offer_type');
                $percentage = $request->input('percentage');
                $amount = $request->input('amount');
                $offer_price = 0;
                $percentage_offer = null;
                $amount_offer = null;
                $appliedOfferType = null;

                if ($offerType === 'percentage' && !empty($percentage) && $price > 0) {
                    $amount_offer = ($percentage / 100) * $price;
                    $offer_price = $price - $amount_offer;
                    $percentage_offer = $percentage;
                    $appliedOfferType = 'percentage';
                } elseif ($offerType === 'amount' && !empty($amount) && $price > 0) {
                    $offer_price = $price - $amount;
                    $amount_offer = $amount;
                    $percentage_offer = number_format(($amount / $price) * 100, 1);
                    $appliedOfferType = 'amount';
                }

                Product_price::create([
                    'product_id' => $product->id,
                    'offer_price' => max(0, $offer_price),
                    'percentage' => $percentage_offer,
                    'amount' => $amount_offer,
                    'offer_type' => $appliedOfferType,
                ]);


                // The create form ships with no tag-input JS, so 'tags' is normally ''
                // and never null - but a blank/absent field must not create a junk
                // empty-string tag or crash explode() on null.
                $tags = array_filter(array_map('trim', explode(',', (string) $request->input('tags'))));
                foreach ($tags as $tagName) {
                    Product_tag::firstOrCreate([
                        'product_id' => $product->id,
                        'tag' => $tagName,
                    ]);
                }

                return $product;
            });
        } catch (Throwable $e) {
            Storage::disk('public')->delete($writtenFiles);

            // A corrupt/unreadable upload throws from inside the image library, not
            // from a validation rule - without this it was an unhandled 500 debug
            // page instead of a message the admin could act on.
            return redirect()->back()->withErrors([
                'product_image' => 'One of the uploaded images could not be processed. Please try a different image file.',
            ])->withInput();
        }

        Session::flash('success', 'Product added successfully.');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        // The view renders a single product ($product), but this used to fetch a
        // collection via get() and pass it as $products with no matching foreach -
        // every $product-> reference in the view was an access on an undefined
        // variable, so the admin "Detail" link 500'd unconditionally.
        $product = Products::with([
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
        ])->where('slug', $slug)->firstOrFail();

        return view('admin.products.product-details', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brands = Brand::all();
        $categories = Category::all();
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

            return view('admin.products.edit',compact('products','brands','categories','colors','sizes','suppliers'));
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

            // Percentage/Fixed amount/No offer are a mutually exclusive radio
            // group now, so which field is actually required depends on which
            // one was picked - offer_type is the single source of truth for
            // that, rather than inferring it from whichever of percentage/
            // amount happens to be non-empty.
            'offer_type' => ['nullable', Rule::in(['percentage', 'amount', ''])],
            'percentage' => ['nullable', 'required_if:offer_type,percentage', 'numeric', 'min:0', 'max:100'],
            'amount' => ['nullable', 'required_if:offer_type,amount', 'numeric', 'min:0'],
        ];


        $validator = Validator::make($request->all(),$rules);

        // Validate the request
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Same rationale as store(): wrap in a transaction and track written files
        // so a failure partway through (e.g. a corrupt image upload) can't leave
        // the product partially updated or an orphaned file on disk.
        $writtenFiles = [];

        try {
            DB::transaction(function () use ($request, $id, &$writtenFiles) {
                $product = Products::findOrFail($id);

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

                // Uploads on the edit form are always ADDITIONAL images/thumbnails, never
                // replacements: removing an existing one is a separate action, handled
                // by the per-image delete buttons wired to image_destroy()/thumb_destroy()
                // below. (The previous code tried to detect "the same image" by matching
                // a freshly generated filename - which always embeds time() - against
                // existing filenames, so that branch could never match; every edit only
                // ever added rows/files and old ones were never cleaned up.)
                if ($request->hasFile('product_image')) {
                    foreach ($request->file('product_image') as $index => $newImage) {
                        $manager = new ImageManager(new Driver());

                        $imageName = $product->slug . '_' . $index . '_' . time() . '.' . $newImage->getClientOriginalExtension();
                        $img = $manager->read($newImage);
                        $imagePath = 'product_images/' . $imageName;

                        Storage::disk('public')->put($imagePath, (string) $img->encode());
                        $writtenFiles[] = $imagePath;

                        Product_image::create([
                            'product_id' => $product->id,
                            'product_image' => $imageName,
                        ]);
                    }
                }

                if ($request->hasFile('product_thumbnail')) {
                    foreach ($request->file('product_thumbnail') as $index => $image) {
                        $manager = new ImageManager(new Driver());

                        $imageName = $product->slug . '_' . $index . '_' . time() . '.' . $image->getClientOriginalExtension();
                        $img = $manager->read($image);
                        $imagePath = 'product_images/thumbnail/' . $imageName;

                        Storage::disk('public')->put($imagePath, (string) $img->encode());
                        $writtenFiles[] = $imagePath;

                        Product_thumbnail::create([
                            'product_id' => $product->id,
                            'product_thumbnail' => $imageName,
                        ]);
                    }
                }


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
                            'additional_name' => $infoNames[$index],
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

                $product_extra = Product_extra::firstOrNew(['product_id' => $product->id]);
                // Extra info store
                $product_extra->warranty_type = $request->input('warranty');
                $product_extra->return_policy = $request->input('return_policy');
                $product_extra->delivery_type = $request->input('delivery_type');
                $product_extra->emi = $request->input('emi');
                $product_extra->save();

                // Offer price store. offer_type (radio: percentage/amount/none)
                // says which mode the admin actually chose, so only that field
                // is trusted - the other is ignored even if it somehow still
                // carries a value, instead of guessing from whichever field is
                // non-empty.
                $price = (float) ($product->regular_price ?? 0);
                $offerType = $request->input('offer_type');
                $percentage = $request->input('percentage');
                $amount = $request->input('amount');
                $offer_price = 0;
                $percentage_offer = null;
                $amount_offer = null;
                $appliedOfferType = null;

                if ($offerType === 'percentage' && !empty($percentage) && $price > 0) {
                    $amount_offer = ($percentage / 100) * $price;
                    $offer_price = $price - $amount_offer;
                    $percentage_offer = $percentage;
                    $appliedOfferType = 'percentage';
                } elseif ($offerType === 'amount' && !empty($amount) && $price > 0) {
                    $offer_price = $price - $amount;
                    $amount_offer = $amount;
                    $percentage_offer = number_format(($amount / $price) * 100, 1);
                    $appliedOfferType = 'amount';
                }

                $product_price = Product_price::firstOrNew(['product_id' => $product->id]);
                $product_price->offer_price = max(0, $offer_price);
                $product_price->percentage = $percentage_offer;
                $product_price->amount = $amount_offer;
                $product_price->offer_type = $appliedOfferType;
                $product_price->save();


                // Replace this product's tags with whatever the form submitted. A plain
                // updateOrCreate() loop only ever added tags and could crash on a blank/
                // absent field (explode(',', null)); tags removed from the form were
                // never deleted, so removed tags stuck around forever.
                $tags = array_filter(array_map('trim', explode(',', (string) $request->input('tags'))));
                $product->tags()->whereNotIn('tag', $tags)->delete();
                foreach ($tags as $tagName) {
                    $product->tags()->firstOrCreate(['tag' => $tagName]);
                }
            });
        } catch (Throwable $e) {
            Storage::disk('public')->delete($writtenFiles);

            return redirect()->back()->withErrors([
                'product_image' => 'One of the uploaded images could not be processed. Please try a different image file.',
            ])->withInput();
        }

        Session::flash('success', 'Product has been Updated successfully.');

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = Products::findOrFail($id);

            // Image/thumbnail files are removed in Products::boot()'s deleting hook.
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
            Storage::disk('public')->delete('product_images/' . $product_image->product_image);
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
            Storage::disk('public')->delete('product_images/thumbnail/' . $product_thumbnail->product_thumbnail);
            $product_thumbnail->delete();

            Session::flash('success', 'Product thumbnail image has been deleted !!');


            // Return a JSON response indicating success
            return response()->json(['message' => 'Thumbnail image deleted successfully'], Response::HTTP_OK);
        } else {
            // Return a JSON response indicating failure
            return response()->json(['error' => 'Product image not found'], Response::HTTP_NOT_FOUND);
        }
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
