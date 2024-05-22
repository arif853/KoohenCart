<?php

namespace App\Http\Controllers\Admin;

use Datetime;
use App\Models\Offer;
use App\Models\Products;
use App\Models\OfferType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offers = Offer::latest('id')->with('products', 'OfferType')->get();
        $offerType = OfferType::latest('id')->get();

        $products = Products::latest('id')->get();
        return view('admin.offers.index', ['offerType' => $offerType, 'products' => $products, 'offers' => $offers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create_offer_type(Request $request)
    {
        $rules = [
            'offer_type_name' => 'required|string|max:255',
        ];

        $customMessages = [
            'offer_type_name.required' => 'Need a Offer Type Name.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        // Validate the request
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            OfferType::create([
                'offer_type_name' => $request->offer_type_name,
            ]);
            Session::flash('success', 'Offer Type Created successfully.');
            return redirect()->route('offers.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function SaveOfferData(Request $request)
    {
        $rules = [
            'offer_name' => 'required|string|max:255',
            'offer_type_id' => 'required',
            'offer_percent' => 'required',
            'offer_product_id' => 'required',
        ];
        $customMessages = [
            'offer_name.required' => 'Need an Offer Name.',
            'offer_type_id.required' => 'Need an Offer Type.',
            'offer_product_id.required' => 'Need an Offer Products Id.',
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);

        // Validate the request
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ]);
        } else {
            // Parse dates
            $from_date = $request->from_date;
            $to_date = $request->to_date;

            // Calculate days
            $from_date_dt = new DateTime($from_date);
            $to_date_dt = new DateTime($to_date);
            $days_diff = $from_date_dt->diff($to_date_dt)->days;

            // Create offer
            $offer = Offer::create([
                'offer_name' => $request->offer_name,
                'offer_percent' => $request->offer_percent,
                'offer_type_id' => $request->offer_type_id,
                'from_date' => $from_date,
                'to_date' => $to_date,
                'day' => $days_diff,
            ]);

            $productIdArray = $request->input('offer_product_id'); // Correcting array access
            $offerId = $offer->id; // If $offerId is an object, get its ID

            $insertValues = [];

            foreach ($productIdArray as $productId) {
                $insertValues[] = [
                    'offer_id' => $offerId,
                    'offer_product_id' => $productId, // Correcting field name to 'product_id'
                ];
            }

            // Insert multiple records into the pivot table
            DB::table('product_offer_types')->insert($insertValues);

            return response()->json([
                'status' => 'success',
                'message' => 'Offer Created Successfully.',
            ]);
        }
    }

    /**
     * Display the specified resource.
     */

    public function editOfferData(Request $request)
    {
        $offerId = $request->id;

        $offer = Offer::findOrFail($offerId);

        $relatedProducts = DB::table('product_offer_types')->where('offer_id', $offerId)->join('products', 'products.id', '=', 'product_offer_types.offer_product_id')->select('product_offer_types.offer_product_id AS product_id', 'products.product_name AS ProductName')->get();

        return response()->json([
            'offer' => $offer,
            'relatedProducts' => $relatedProducts,
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function UpdateOfferData(Request $request)
    {
        $rules = [
            'offer_name' => 'string|max:255',
            'offer_type_id' => 'integer',
            'offer_percent' => 'integer',
        ];
        $customMessages = [
            'offer_name.string' => ' Offer Name is a string.',
            'offer_type_id.integer' => 'Offer Type is a integer.',
        ];
        $validator = Validator::make($request->all(), $rules, $customMessages);

        // Validate the request
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(),
            ]);
        } else {
            $from_date = $request->from_date;
            $to_date = $request->to_date;

            // Calculate days
            $from_date_dt = new DateTime($from_date);
            $to_date_dt = new DateTime($to_date);
            $days_diff = $from_date_dt->diff($to_date_dt)->days;
            $id = $request->offer_id;
            $offerItem = Offer::find($id);
            $offerItem->offer_name = $request->offer_name;
            $offerItem->offer_percent = $request->offer_percent;
            $offerItem->offer_type_id = $request->offer_type_id;
            $offerItem->from_date = $request->from_date;
            $offerItem->to_date = $request->to_date;
            $offerItem->day = $days_diff;
            $offerItem->save();
            $offerItem->products()->sync($request->input('offer_product_id'));
            if ($offerItem == true) {
                return response()->json([
                    'status' => 'success',
                    'message' => 'Offer Updated Successfully.',
                ]);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Offer Not Updated.',
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delteOfferData(Request $request)
    {
        try {
            $offers = Offer::find($request->id);
            $offers->delete();
            return redirect()->back()->with('success', 'Item deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('danger', 'This item can be deleted.');
        }
    }
}