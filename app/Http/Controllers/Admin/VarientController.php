<?php

namespace App\Http\Controllers\Admin;

use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class VarientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $colors = Color::all();
        $sizes = Size::all();
        return view('admin.products.varient.index',compact('colors','sizes'));
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
    public function color_store(Request $request)
    {

        $rules = [
            'color_name' => ['required', Rule::unique('colors', 'color_name')],
            'color_code' => 'required',
        ];

        $customMessages = [
            'color_name.required' => 'The color name field is required.',
            'color_name.unique' => 'The color name already exists.',
            'color_code.required' => 'The color code field is required.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        // Validate the request
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // If validation passes, proceed to insert data into the database.
        $colors = new Color;
        $colors->color_name = $request->color_name;
        $colors->color_code = $request->color_code;
        $colors->status = $request->status ? 1 : 0;
        // $colors->save();
            // Save only if color_name is unique
            $existingColor = Color::where('color_name', $colors->color_name)->first();
            if (!$existingColor) {
                $colors->save();
                // Set success message in session
                Session::flash('success', 'Color added successfully.');
            } else {
                // Set error message in session
                Session::flash('danger', 'The color name already exists.');
            }
        return redirect()->back();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function size_store(Request $request)
    {
        $rules = [
            // Was Rule::unique('colors', 'color_name') - checked size names for
            // uniqueness against the colors table, so a duplicate size name only
            // ever failed validation if a color happened to share that name.
            'size_name' => ['required', Rule::unique('sizes', 'size_name')],
            'size_value' => 'required',
        ];

        $customMessages = [
            'size_name.required' => 'The size name field is required.',
            'size_name.unique' => 'The size name already exists.',
            'size_value.required' => 'The size field is required.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        // Validate the request
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // If validation passes, proceed to insert data into the database.
        $sizes = new Size;
        $sizes->size_name = $request->size_name;
        $sizes->size = $request->size_value;
        $sizes->status = $request->status ? 1 : 0;

            // Save only if size_name is unique
            $existingSize = Size::where('size_name', $sizes->size_name)->first();
            if (!$existingSize) {
                $sizes->save();
                // Set success message in session
                Session::flash('success', 'Size added successfully.');
            } else {
                // Set error message in session
                Session::flash('danger', 'The Size name already exists.');
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
    public function color_edit(Request $request)
    {
        $id = $request->id;
        $color = Color::findOrFail($id);

        return response()->json($color);
    }

    public function size_edit(Request $request)
    {
        $id = $request->id;
        $size = Size::findOrFail($id);

        return response()->json($size);
    }

    /**
     * Update the specified resource in storage.
     */
    public function color_update(Request $request)
    {
        $id = $request->id;
        // Log::info($request->all());
        $rules = [
            'color_name' => ['required'],
            'color_code' => 'required',
        ];

        $customMessages = [
            'color_name.required' => 'The color name field is required.',
            // 'color_name.unique' => 'The color name already exists.',
            'color_code.required' => 'The color code field is required.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);
        // print_r($validator);
        // Validate the request
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else{
            $color = Color::findOrFail($id);
            $color->update([
                'color_code' => $request->color_code,
                'color_name' => $request->color_name,
                'status' => $request->status ? 1 : 0,
            ]);
            Session::flash('success', 'Color updated successfully!');
            
            return response()->json(['status' => 200]);
            // return redirect()->back()->with('success', 'Color updated successfully.');
        }

    }


    /**
     * Update the specified resource in storage.
     */
    public function size_update(Request $request)
    {
        $id = $request->size_id;
        $rules = [
            'size_name' => 'required',
            'size_value' => 'required',
        ];

        $customMessages = [
            'size_name.required' => 'The size name field is required.',
            'size_value.required' => 'The size field is required.',
        ];

        $validator = Validator::make($request->all(), $rules, $customMessages);

        // Validate the request
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else{
            $size = Size::findOrFail($id);
            $size->update([
                'size_name' => $request->size_name,
                'size' => $request->size_value,
                'status' => $request->status ? 1 : 0,
            ]);
            
            Session::flash('success', 'Size updated successfully!');

            return response()->json(['status' => 200]);
            // return redirect()->back()->with('success', 'Color updated successfully.');
        }

    }


    /**
     * Remove the specified resource from storage.
     */
    public function color_destroy($id)
    {
        $color = Color::findOrFail($id);

        // products_colors.color_id cascades at the DB level, so delete() below
        // would never throw for a color still assigned to products - it would
        // silently detach it from every one of them with no warning.
        if ($color->products()->exists()) {
            return redirect()->route('varient.index')->with('danger', 'This color is assigned to products and cannot be deleted.');
        }

        $color->delete();

        return redirect()->route('varient.index')->with('success', 'Color deleted successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function size_destroy(string $id)
    {
        $size = Size::findOrFail($id);

        // products_sizes.size_id cascades at the DB level, so delete() below
        // would never throw for a size still assigned to products - it would
        // silently detach it from every one of them with no warning.
        if ($size->products()->exists()) {
            return redirect()->route('varient.index')->with('danger', 'This size is assigned to products and cannot be deleted.');
        }

        $size->delete();

        return redirect()->route('varient.index')->with('success', 'Size deleted successfully.');
    }
}
