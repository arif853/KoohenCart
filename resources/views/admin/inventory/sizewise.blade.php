@extends('layouts.admin')
@section('title','Size Wise Inventory')
@section('content')

<div>
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Size Inventory</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{'/dashborad'}}">Dashborad</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Size wise Inventory</li>
                </ol>
            </nav>
        </div>
        <div class="content-header">
            <a href="javascript:history.back()"><i class="material-icons md-arrow_back"></i> Go back </a>
        </div>

    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">

                <style>
                    .table tr td{
                        vertical-align: middle;
                    }
                    .size-stock-container {
                        display: flex;
                        flex-wrap: wrap;
                    }

                    .size-stock-item {
                        width: 150px;
                        padding: 10px;
                        margin: 5px;
                        border: 1px solid #ccc;
                        border-radius: 5px;
                    }
                    .size-stock-balance {
                        width: 150px;
                        padding: 10px;
                        margin: 5px;
                        border: none;
                    }

                    .size-name {
                        font-weight: bold;
                        margin-bottom: 5px;
                        text-align: center;
                        border-bottom: 2px solid;
                    }

                    .stock-info {
                        display: flex;
                        margin-bottom: 3px;
                    }

                    .stock-label {
                        width: 60px;
                        font-size: 12px;
                    }

                    .stock-value {
                        font-size: 12px;
                        font-weight: bold;
                        color: #088178;
                    }
                </style>
                <div class="card-header">
                    <button id="print-btn" class="btn btn-warning ">print</button>
                </div>
                <div class="card-body">
                    <div>
                        <div class="table-responsive table-desi">
                            <table class="table table-striped" id="datatable">
                                <thead>
                                    <tr>
                                        <th width=5%>ID</th>
                                        <th width=30%>Product</th>
                                        <th>Size</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $key => $product)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>
                                                <a class="itemside" href="#">
                                                    <div class="info">
                                                        <h6 class="mb-0">{{$product->product_name}}</h6>
                                                    </div>
                                                </a>
                                            </td>
                                            {{-- {{$stockSize}} --}}
                                            <td class="size-stock-container">
                                                @foreach ($product->sizes as $data)
                                                <div class="size-stock-item">
                                                    <div class="size-name">S-{{$data->size_name}}</div>
                                                    <div class="stock-info">
                                                        <div class="stock-label">In:</div>
                                                        <div class="stock-value">{{$data->inStock}} <sub style="font-size: 9px">Pcs</sub></div>
                                                    </div>
                                                    <div class="stock-info">
                                                        <div class="stock-label">Out:</div>
                                                        <div class="stock-value">{{$data->outStock}} <sub style="font-size: 9px">Pcs</sub></div>
                                                    </div>
                                                    <div class="stock-info">
                                                        <div class="stock-label">Balance:</div>
                                                        @if ($data->balance > 0)
                                                        <div class="stock-value">{{$data->balance}} <sub style="font-size: 9px">Pcs</sub></div>
                                                        @else
                                                        <span class="text-danger">Stock out</span>
                                                        @endif
                                                    </div>
                                                </div>

                                                @endforeach
                                                
                                                <div class="size-stock-balance">
                                                    <div class="size-name">Total</div>
                                                    <div class="stock-info">
                                                        <div class="stock-label">=</div>
                                                        <div class="stock-value">{{$product->totalInStock}} <sub style="font-size: 9px">Pcs</sub></div>
                                                    </div>
                                                    <div class="stock-info">
                                                        <div class="stock-label">=</div>
                                                        <div class="stock-value">{{$product->totalOutStock}} <sub style="font-size: 9px">Pcs</sub></div>
                                                    </div>
                                                    <div class="stock-info">
                                                        <div class="stock-label">=</div>
                                                        <div class="stock-value">{{$product->totalBalance}} <sub style="font-size: 9px">Pcs</sub></div>

                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@include('admin.inventory.new-stock')

@endsection
@push('product')
<script>
    var printBtn = $('#print-btn');
    function printTable() {
        var printWindow = window.open('', '_blank');

        // Copy the content of the table to the new window
        printWindow.document.write('<html><head><title>Size Wise Inventory Report</title>');

        // Include custom CSS styles for the printed table
        printWindow.document.write('<style>');

        printWindow.document.write('body { font-family: Arial, sans-serif; }');
        printWindow.document.write('h2 { color: #333; }');
        printWindow.document.write('table { width: 100%; border-collapse: collapse; }');
        printWindow.document.write('table, th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }');
        printWindow.document.write('th { background-color: #f2f2f2; }');
        printWindow.document.write('a { text-decoration: none; color:#000; }');
        printWindow.document.write('.size-stock-container {display: flex;flex-wrap: wrap;}');
        printWindow.document.write('.size-stock-item {width: 150px;padding: 10px;margin: 5px;border: 1px solid #ccc;border-radius: 5px;}');
        printWindow.document.write('a { text-decoration: none; color:#000; }');
        printWindow.document.write('.size-name { font-weight: bold; margin-bottom: 5px; text-align: center; border-bottom: 2px solid; }');
        printWindow.document.write('.stock-info { display: flex;  margin-bottom: 3px; }');
        printWindow.document.write('.stock-label { width: 60px; font-size: 12px; }');
        printWindow.document.write('.stock-value { font-size: 12px; font-weight: bold; color: #088178; }');
        printWindow.document.write('</style>');

        printWindow.document.write('</head><body>');
        printWindow.document.write('<h2>Size Wise Inventory Report</h2>');
        printWindow.document.write('<table>' + $('#datatable').html() + '</table>');
        printWindow.document.write('</body></html>');

        // Close the document stream
        printWindow.document.close();

        // Print the new window
        printWindow.print();
    }


    // Print button click event
    printBtn.click(function() {
        printTable();
    });
</script>

@endpush


