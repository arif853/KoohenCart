

@extends('layouts.admin')
@section('title','Inventory')
@section('content')

<div>
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Inventory</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{'/dashborad'}}">Dashborad</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Basic Inventory</li>
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
                </style>
                <div class="card-body">
                    <div>
                        <div class="table-responsive table-desi">
                            <table class="table table-striped" id="datatable">
                                <thead>
                                    <tr>
                                        <th width=5%>ID</th>
                                        <th>Product</th>
                                        <th>Supplier</th>
                                        <th>Purchase Date</th>
                                        <th>Purchase Price</th>
                                        <th>Purchase Total</th>
                                        <th>In </th>
                                        <th>Out</th>
                                        <th>Balance</th>
                                        <th>Purchase Balance</th>
                                        <th>Action</th>
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

                                            @if ($product->supplier)
                                            <td>{{$product->supplier->supplier_name }} </td>
                                            @else
                                            <td>No Supplier. </td>
                                            @endif

                                            <td>{{$product->purchase_date}}</td>

                                            <td>৳{{$product->raw_price}}</td>
                                            <td>৳{{$product->purchasePrice}}</td>

                                            <td>{{$product->inStock}}</td>
                                            <td>{{$product->soldQuantity }}</td>
                                            {{-- @php
                                                $stock_balance = $product->inStock - $product->soldQuantity;
                                            @endphp --}}
                                            <td>
                                                @if ($product->balance > 0 )
                                                {{$product->balance}}
                                                @else
                                                <span class="text-danger"> Out of Stock</span>
                                                @endif
                                            </td>
                                            <td>৳{{$product->purchaseBalance}}</td>
                                            <td>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#NewStockModal" data-product-id="{{ $product->id}}" class="btn btn-brand btn-sm add-stock">Add Stock</a>
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

    // Edit Category
    $(document).on('click', '.add-stock', function (e) {
        e.preventDefault();
        var product = $(this).data('product-id');
        // console.log(categoryId);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{url('/dashboard/inventory/newstock')}}',
            method: 'GET',
            data: {
                id: product,
            },
            success: function (response) {
                console.log(response.stock);

                // Update other fields
                $('#product_id').val(response.product.id);
                $('#old_stock').val(response.stock ? response.stock.inStock : 0);
                $('#product_name').val(response.product.product_name);
                $('#supplier').val(response.product.supplier.supplier_name);


                // Create and append input fields for each size
                var inputContainer = $('#input_container');
                inputContainer.empty();

                var i = 0;
                    var balanceQuantity = 0, inStock = 0, outStock = 0;
                // Create and append input fields for each size
                $.each(response.product.sizes, function (index, size) {

                    $.each(response.stock, function (index, stock) {
                        // Check if stock information is available for the size
                        if (stock.size_id == size.id) {
                            // Calculate balance quantity
                            inStock = stock.inStock;
                            outStock = stock.outStock;
                            balanceQuantity = stock.inStock - stock.outStock;
                            // console.log(balanceQuantity);
                        }
                    });

                    // sizeSelect.append('<option value="' + size.id + '">' + size.size_name + '</option>');
                    var inputField = '<div class="input-group mb-3">' +
                                        '<input type="hidden" value="'+size.id+'" name=size['+i+']>'+
                                        '<label class="input-group-text" for="quantity_' + size.id + '">'+ size.size_name + '</label>' +
                                        '<input type="text" readonly class="form-control" value="' + inStock + '">' +
                                        '<input type="text" readonly class="form-control" value="' + outStock + '">' +
                                        '<input type="text" readonly class="form-control" value="' + balanceQuantity + '">' +
                                        '<input type="number" class="form-control" id="quantity_' + i + '" name="quantity[' + i + ']" value="0">' +
                                    '</div>';
                    inputContainer.append(inputField);

                    i++;
                });

            }
        });
    });

    //New stock update
    $("#newStock").submit(function (e) {
        e.preventDefault();
        const data = new FormData(this);
        console.log(data);
        $.ajax({
            url: '{{url('/dashboard/inventory/addstock')}}',
            method: 'post',
            data: data,
            cache: false,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.status == 200) {
                    // console.log(res);
                    location.reload();
                    // $.Notification.autoHideNotify('success', 'top right', 'Excellent!!', res.message);
                }
                else{
                    $.Notification.autoHideNotify('danger', 'top right', 'Failed', res.message);

                }
            }
        })
    });
</script>

@endpush


