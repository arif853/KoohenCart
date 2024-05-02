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
            'size_name' => ['required', Rule::unique('colors', 'color_name')],
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
            $existingSize = Size::where('size_name', $sizes->sizes_name)->first();
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
            $color = Color::find($id);
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
            $size = Size::find($id);
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
        try {
            $color = Color::findOrFail($id);

            $color->delete();

            return redirect()->route('varient.index')->with('danger', 'Color deleted successfully.');
        } catch (\Exception $e) {
            // Log the exception or handle it in a way that makes sense for your application
            return redirect()->route('varient.index')->with('error', 'Error deleting color.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function size_destroy(string $id)
    {
        try {
            $size = Size::findOrFail($id);

            $size->delete();

            return redirect()->route('varient.index')->with('danger', 'Size deleted successfully.');
        } catch (\Exception $e) {
            // Log the exception or handle it in a way that makes sense for your application
            return redirect()->route('varient.index')->with('error', 'Error deleting color.');
        }
    }
}
