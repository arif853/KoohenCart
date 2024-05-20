<?php

namespace App\Http\Controllers\Admin;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $suppliers = Supplier::paginate(10);
        return view('admin.supplier.index',compact('suppliers'));
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
            'supplier_name' => 'required',
            'address' => 'required',
            'phone' => 'required'
        ];

        $customMessages = [
            'supplier_name.required' => 'The Supplier name field is required.',
            'address.required' => 'Enter an address.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        // Validate the request
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else{

            $supplier = Supplier::create([
                'supplier_name' => $request->supplier_name,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'status' => $request->status ? 'Active' : 'Inactive',
            ]);
        }
        return redirect()->back()->with('success','New supplier added.');
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
        $supplier = Supplier::findOrFail($request->id);
        return response()->json($supplier);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $supplier = Supplier::find($request->supplier_id);

        $rules = [
            'supplier_name' => 'required',
            'address' => 'required',
            'phone' => 'required'
        ];

        $customMessages = [
            'supplier_name.required' => 'The Supplier name field is required.',
            'address.required' => 'Enter an address.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        // Validate the request
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else{

            $supplier->update([
                'supplier_name' => $request->supplier_name,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'status' => $request->status ? 'Active' : 'Inactive',
            ]);
        }
        Session::flash('success', 'Supplier data has beed Updated.');
        return response()->json(['status'=> 200]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try{
            $supplier = Supplier::find($request->id);
            $supplier->delete();

            return redirect()->back()->with('danger', 'Supplier deleted successfully.');
        } catch (\Exception $e) {
            // Log the exception or handle it in a way that makes sense for your application
            return redirect()->back()->with('danger', 'This Supplier can not be deleted .');
        }
    }


    public function SupplierFilter(Request $request)
    {
        $supplierName = $request->supplier_name;

        $supplierPhone = $request->supplier_phone;

        $supplierEmail = $request->supplier_email;

        // Construct the query without fetching any records yet
        $query = Supplier::query();

        if ($supplierName) {
            $query->where('supplier_name', 'like', "%$supplierName%");
        }

        if ($supplierPhone) {
            $query->where('phone', 'like', "%$supplierPhone%");
        }

        if ($supplierEmail) {
            $query->where('email', 'like', "%$supplierEmail%");
        }

        // Execute the query and fetch the results
        $supplierFilters = $query->get();

        return response()->json($supplierFilters);
    }

}
