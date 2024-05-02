@extends('layouts.admin')
@section('title', 'Prodcuts')
@section('content')

<div class="content-header">
    <div>
        <h2 class="content-title card-title">Products List</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{'/dashborad'}}">Dashborad</a></li>
              <li class="breadcrumb-item active" aria-current="page">Product</li>
            </ol>
        </nav>
    </div>
    <div>

        <a href="{{route('products.create')}}" class="btn btn-primary btn-sm rounded">Create new</a>
    </div>
</div>
<div class="card mb-4">
    <header class="card-header">
        <h5 class="mb-3">Filter by</h5>
        <form method="post" id="productSearchForm">
            @csrf
            <div class="row">
                <div class="col-md-3 mb-4">
                    <label for="order_id" class="form-label">Product Name</label>
                    <input type="text" placeholder="Type product name here" name="product_name" class="form-control">
                </div>
                <div class="col-md-3 mb-4">
                    <label for="order_customer" class="form-label">Product SKU Code</label>
                    <input type="text" placeholder="Type product SKU code here" name="sku" class="form-control">
                </div>
                <div class="col-md-2 mb-4">
                    <label for="order_created_date" class="form-label">Starting Date</label>
                    <input type="date" placeholder="Type created date here" id="start_date" name="created_at"
                        class="form-control" id="order_created_date">
                </div>
                <div class="col-md-2 mb-4">
                    <label for="order_created_date" class="form-label">Ending Date</label>
                    <input type="date" placeholder="Type updated  date here" id="update_date" name="updated_at"
                        class="form-control" id="order_created_date">
                </div>
                <div class="col-md-2 pt-4 mt-1">
                    <button type="submit" class="btn btn-sm btn-primary"> Search </button>
                </div>
            </div>
        </form>

    </header>
    <style>
    .table tr td{
        vertical-align: middle;
    }
</style>
    <div class="card-body">
        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>#SN</th>
                    <th>Products</th>
                    <th>Brand</th>
                    <th>Category</th>
                    <th>Stock</th>
                    <th>overviews</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="productBody">
                @foreach ($products as $key=> $product)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>
                        <a class="itemside" href="#">
                            <div class="left">

                                <img src="{{asset('storage/product_images/thumbnail/'.$product->product_thumbnail->first()->product_thumbnail)}}" class="img-sm img-thumbnail" alt="{{$product->slug}}">

                            </div>
                            <div class="info">
                                <h6 class="mb-0">{{$product->product_name}}</h6>
                            </div>


                        </a>
                    </td>
                    <td>{{$product->brand->brand_name}}</td>
                    <td>
                        {{$product->category->category_name}}
                    </td>
                    <td>{{$product->balance}}</td>
                    <td>
                        @foreach ($product->overviews as $overview)
                        <span>{{$overview->overview_name}} {{$overview->overview_value}}</span><br>
                        @endforeach
                    </td>
                    <td>
                        @if ($product->status == "active")

                        <span class="badge rounded-pill alert-success">Active</span>
                        @else
                        <span class="badge rounded-pill alert-danger">Inactive</span>

                        @endif
                    </td>
                    <td class="text-end">
                        <a href="{{route('products.show',$product->slug)}}" class="btn btn-md rounded font-sm">Detail</a>
                        <div class="dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                            <div class="dropdown-menu">
                                {{-- <a class="dropdown-item text-primary" href="{{route('order.details')}}">Return</a> --}}
                                <a class="dropdown-item" href="{{route('products.edit',$product->id)}}">Edit info</a>

                                <a class="dropdown-item text-danger" href="{{route('products.destroy',$product->id)}}" onclick="confirmDelete(event)">Delete</a>
                            </div>
                        </div> <!-- dropdown //end -->
                    </td>

                </tr>
                @endforeach

            </tbody>

        </table>
    </div> <!-- card-body end// -->
</div> <!-- card end// -->
{{-- <div class="pagination-area mt-30 mb-50">
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-start">
            <li class="page-item active"><a class="page-link" href="#">01</a></li>
            <li class="page-item"><a class="page-link" href="#">02</a></li>
            <li class="page-item"><a class="page-link" href="#">03</a></li>
            <li class="page-item"><a class="page-link dot" href="#">...</a></li>
            <li class="page-item"><a class="page-link" href="#">16</a></li>
            <li class="page-item"><a class="page-link" href="#"><i class="material-icons md-chevron_right"></i></a></li>
        </ul>
    </nav>
</div> --}}

@endsection
@push('products_search')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#productSearchForm').on('submit', function(event) {
                event.preventDefault();

                var formData = $(this).serialize();
                console.log(formData);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('products.filter') }}",
                    type: 'POST',
                    data: formData, // Sending form data directly
                    dataType: 'json', // Expecting JSON response
                    success: function(response) {
                        var products = response.products;
                        var tableBody = $('#productBody');
                        tableBody.empty();

                        products.forEach(function(product, index) {

                            var row = $('<tr>');
                            row.append($('<td>').text(index + 1));
                            row.append($('<td>').html('<a class="itemside" href="#">' +
                                '<div class="left">' +
                                '<img src="{{ asset('storage/product_images/') }}' +
                                '/' + product.product_images[0].product_image +
                                '" class="img-sm img-thumbnail" alt="' + product
                                .slug + '">' +
                                '</div>' +
                                '<div class="info">' +
                                '<h6 class="mb-0">' + product.product_name +
                                '</h6>' +
                                '</div>' +
                                '</a>'));

                            row.append($('<td>').text(product.brand.brand_name));
                            row.append($('<td>').text(product.category.category_name));
                            row.append($('<td>').text(product.stock));

                            var overviews = product.overviews && product.overviews
                                .length > 0 ?
                                product.overviews.map(function(overview) {
                                    return overview.overview_name + ' ' + overview
                                        .overview_value;
                                }).join('<br>') :
                                'No overviews available';

                            row.append($('<td>').html(overviews));

                            var statusBadge = product.status == 'active' ?
                                '<span class="badge rounded-pill alert-success">Active</span>' :
                                '<span class="badge rounded-pill alert-danger">Inactive</span>';

                            row.append($('<td>').html(statusBadge));

                            var action = $('<td>').addClass('text-end');
                            var detailLink = $('<a>').attr('href', 'products/' + product
                                    .slug)
                                .addClass('btn btn-md rounded font-sm').text('Detail');
                            var dropdown = $('<div>').addClass('dropdown');
                            var dropdownButton = $('<a>').attr('href', '#').attr(
                                    'data-bs-toggle', 'dropdown')
                                .addClass('btn btn-light rounded btn-sm font-sm').html(
                                    '<i class="material-icons md-more_horiz"></i>');
                            var dropdownMenu = $('<div>').addClass('dropdown-menu');
                            // Adding your dropdown menu items

                            var editLink = $('<a>').attr('href', 'products/' + 'edit/' +
                                    product.id)
                                .addClass('dropdown-item').text('Edit info');
                            var deleteLink = $('<a>').attr('href', 'products/' +
                                    'destroy/' +
                                    product.id)
                                .addClass('dropdown-item text-danger').text('Delete')
                                .on('click', function(event) {
                                    if (!confirmDelete(event)) {
                                        event
                                            .preventDefault(); // Prevent navigation if delete is cancelled
                                    }
                                });
                            dropdownMenu.append(editLink, deleteLink);
                            dropdown.append(dropdownButton, dropdownMenu);
                            // Appending detail link and dropdown to the action
                            action.append(detailLink, dropdown);
                            row.append(action);
                            tableBody.append(row);

                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred while fetching products:', error);
                    }
                });
            });
        });
    </script>
@endpush
