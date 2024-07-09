<?php

namespace App\Http\Controllers\Admin;

use App\Models\Campaign;
use App\Models\Products;
use Illuminate\Support\Str;
use App\Models\Camp_product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Gd\Driver;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $campaigns = Campaign::all();
        return view('admin.campaign.index',compact('campaigns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = Products::all();

        // Filter products based on stock balance greater than zero
        $products = $items->filter(function ($product) {

                // Calculate total stock balance for the product
            $totalStock = $product->product_stocks->sum(function ($stock) {
                return $stock->inStock - $stock->outStock;
            });
            // Add a property to the product object with the total stock balance
            $product->totalStock = $totalStock;

            // Return true if total stock balance is greater than zero
            return $totalStock > 0;
        });

        return view('admin.campaign.create',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $rules = [
            'camp_name' => 'required|string',
            'camp_image' => 'required|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            // 'camp_price' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|string',
            'product.*' => 'nullable|string',
            'status' => ['nullable', 'string', Rule::in(['Draft', 'Published'])],
        ];
        // $customMessages = [
        //     'camp_name.required' => 'Please fill up first name field.',
        //     'lname.required' => 'Please fill up last name field.',
        //     'phone.required' => 'Please fill up phone field .',
        //     'email.required' => 'Please fill up email field.',
        //     'billing_address.required' => 'Please fill up billing address field.',
        // ];

        $validator = Validator::make($request->all(), $rules);

        // Validate the request
        if ($validator->fails()) {

            // Session::flash('danger', $validator->messages()->toArray());
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else{

            if($request->hasFile('camp_image')){

                $image = $request->file('camp_image');

                $manager = new ImageManager(new Driver());

                $imageName = time() . '.' . $image->getClientOriginalExtension();

                $img = $manager->read($image);
                // $encoded = $img->toWebp();
                // $img = $img->resize(400, 600);

                $imagePath = 'campaign/' . $imageName;

                Storage::disk('public')->put($imagePath , (string)$img->encode());
                // Storage::disk('public')->put($imagePath2 , (string)$encoded->encode());

            }
                $campaign = new Campaign;

                $campaign->camp_name = $request->camp_name;
                $campaign->image = $imagePath;
                $campaign->camp_offer = $request->camp_offer ;
                $campaign->status = $request->status;
                $campaign->start_date = $request->start_date;
                $campaign->end_date = $request->end_date;
                $campaign->save();

                // Save campaign products
                $products = $request->input('product');
                $regularPrices = $request->input('regular_price');
                $stock = $request->input('stock');
                $campaignPrices = $request->input('campaign_price');

                foreach ($products as $key => $productId) {
                    Camp_product::create([
                        'campaign_id' => $campaign->id,
                        'product_id' => $productId,
                        'regular_price' => $regularPrices[$key],
                        'camp_price' => $campaignPrices[$key],
                        'camp_qty' => $stock[$key],
                    ]);
                }

            return redirect()->route('campaign')->with('success','New Campaign added successfully.');
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
        $products = Products::all();
        $camp_id = $request->id;
        $campaign = Campaign::find($camp_id);
        return view('admin.campaign.edit',compact('products','campaign'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,string $id)
    {

        $campaign = Campaign::find($id);

        $rules = [
            'camp_name' => 'required|string',
            'camp_image' => 'mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            // 'camp_price' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|string',
            'product.*' => 'nullable|string',
            'status' => ['nullable', 'string', Rule::in(['Draft', 'Published'])],
        ];
        // $customMessages = [
        //     'camp_name.required' => 'Please fill up first name field.',
        //     'lname.required' => 'Please fill up last name field.',
        //     'phone.required' => 'Please fill up phone field .',
        //     'email.required' => 'Please fill up email field.',
        //     'billing_address.required' => 'Please fill up billing address field.',
        // ];

        $validator = Validator::make($request->all(), $rules);

        // Validate the request
        if ($validator->fails()) {

            // Session::flash('danger', $validator->messages()->toArray());
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else{

            if($request->hasFile('camp_image')){

                $image = $request->file('camp_image');

                $manager = new ImageManager(new Driver());

                $imageName = time() . '.' . $image->getClientOriginalExtension();

                $img = $manager->read($image);
                // $encoded = $img->toWebp();
                // $img = $img->resize(400, 600);

                $imagePath = 'campaign/' . $imageName;

                Storage::disk('public')->put($imagePath , (string)$img->encode());
                // Storage::disk('public')->put($imagePath2 , (string)$encoded->encode());
                $newImage = $imagePath;
            }
            else{
                $newImage = $campaign->image;
            }

                $campaign->camp_name = $request->camp_name;
                $campaign->slug = Str::slug($request->camp_name);
                $campaign->image = $newImage;
                $campaign->camp_offer = $request->camp_offer;
                $campaign->status = $request->status;
                $campaign->start_date = $request->start_date;
                $campaign->end_date = $request->end_date;
                $campaign->save();

                // Save campaign products
                $products = $request->input('product');
                $regularPrices = $request->input('regular_price');
                $stock = $request->input('stock');
                $campaignPrices = $request->input('campaign_price');

                foreach ($products as $key => $productId) {

                    $existedProduct = Camp_product::where('product_id', $productId)->first();

                    if(!$existedProduct){
                        Camp_product::create([
                            'campaign_id' => $campaign->id,
                            'product_id' => $productId,
                            'regular_price' => $regularPrices[$key],
                            'camp_price' => $campaignPrices[$key],
                            'camp_qty' => $stock[$key],
                        ]);
                    }
                    else{
                        $existedProduct->update([
                            // 'product_id' => $productId,
                            'regular_price' => $regularPrices[$key],
                            'camp_price' => $campaignPrices[$key],
                            'camp_qty' => $stock[$key],
                        ]);
                    }
                }

            return redirect()->route('campaign')->with('success','Campaign data has been updated successfully.');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Campaign::findOrFail($id);

        if ($item) {

            $item->delete();
            Session::flash('danger', 'Campaign has been deleted !!');

            // Return a JSON response indicating success
            return redirect()->back();
            // return response()->json(['message' => 'Campaign has been deleted'], Response::HTTP_OK);
        }

    }

    public function campItemRemove(Request $request){

        $item = Camp_product::findOrFail($request->id);

        if ($item) {

            $item->delete();
            Session::flash('success', 'Campaign item has been deleted !!');

            // Return a JSON response indicating success
            return response()->json(['message' => 'Campaign item has been deleted'], Response::HTTP_OK);
        } else {
            // Return a JSON response indicating failure
            return response()->json(['message' => 'Campaign item has not found '], Response::HTTP_OK);
        }
    }

}
