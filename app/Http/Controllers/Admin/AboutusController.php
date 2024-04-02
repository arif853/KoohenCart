<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Aboutus;
use Illuminate\Http\Request;

class AboutusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aboutus = Aboutus::all();
        return view('admin.aboutus.index',['aboutus' => $aboutus]);
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
        //
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
        $aboutus = Aboutus::find($request->id);

        return response()->json($aboutus);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = Aboutus::find($request->aboutId);
        $request->validate([
            'aboutusTitle' => 'required|string',
            'description' => 'required|string'
        ]);

        $data->update([
            'title' => $request->aboutusTitle,
            'about_desc' =>$request->description
        ]);

        return response()->json(['status' => 200]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
