<?php

namespace App\Http\Controllers\Admin;

use App\Models\Size;
use App\Models\Category;
use App\Models\SizeHeader;
use Illuminate\Http\Request;
use App\Models\CategorySizeHeader;
use App\Http\Controllers\Controller;

class SizeChartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::whereHas('categorySizeHeaders')->get();

        $sizes = Size::all();
        $sizeHeaders = SizeHeader::all();
        $sizeChartData = [];

        foreach ($categories as $category) {
            $categorySizeHeaders = CategorySizeHeader::where('category_id', $category->id)
                ->with(['size', 'sizeHeader'])
                ->get();

                $headers = [];
            foreach ($categorySizeHeaders as $entry) {
                $sizeChartData[$category->id][$entry->size->size_name][$entry->sizeHeader->name] = $entry->value;
                $headers[$entry->sizeHeader->id] = $entry->sizeHeader->name;
            }
            $categoryHeaders[$category->id] = $headers;
        }

        return view('admin.products.varient.sizechart.sizeChart', compact('categories', 'sizes', 'sizeHeaders', 'sizeChartData','categoryHeaders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $sizes = Size::all();
        return view('size_chart.create', compact('categories', 'sizes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category_id = $request->input('category_id');
        $headers = $request->input('headers');
        $values = $request->input('values');

        foreach ($headers as $headerKey => $headerName) {
            $header = SizeHeader::firstOrCreate(['name' => $headerName]);

            foreach ($values as $sizeId => $headerValues) {
                if (isset($headerValues[$headerKey])) {
                    CategorySizeHeader::create([
                        'category_id' => $category_id,
                        'size_id' => $sizeId,
                        'size_header_id' => $header->id,
                        'value' => $headerValues[$headerKey],
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Size chart created successfully.');
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
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        $sizes = Size::all();
        $sizeHeaders = SizeHeader::all();

        $categorySizeHeaders = CategorySizeHeader::where('category_id', $id)
            ->with(['size', 'sizeHeader'])
            ->get();

        $sizeChartData = [];
        $headers = [];
        foreach ($categorySizeHeaders as $entry) {
            $sizeChartData[$entry->size->size_name][$entry->sizeHeader->name] = $entry->value;
            $headers[$entry->sizeHeader->id] = $entry->sizeHeader->name;
        }
        $categoryHeaders[$category->id] = $headers;

        return view('admin.products.varient.sizechart.editSizeChart', compact('category', 'sizes', 'sizeHeaders', 'sizeChartData','categoryHeaders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category_id = $id;
        $headers = $request->input('headers');
        $values = $request->input('values');

        // Delete existing size chart data for this category
        CategorySizeHeader::where('category_id', $category_id)->delete();

        foreach ($headers as $headerKey => $headerName) {
            $header = SizeHeader::firstOrCreate(['name' => $headerName]);

            foreach ($values as $sizeId => $headerValues) {
                if (isset($headerValues[$headerKey])) {
                    CategorySizeHeader::create([
                        'category_id' => $category_id,
                        'size_id' => $sizeId,
                        'size_header_id' => $header->id,
                        'value' => $headerValues[$headerKey],
                    ]);
                }
            }
        }

        return redirect()->route('size_chart.index')->with('success', 'Size chart updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        CategorySizeHeader::where('category_id', $id)->delete();
        return redirect()->route('size_chart.index')->with('success', 'Size chart deleted successfully.');
    }
}
