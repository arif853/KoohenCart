@extends('layouts.admin')
@section('title', 'Product Feature')

@section('content')
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Feature Products</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/dashborad') }}">Dashborad</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> Feature Items</li>
                </ol>
            </nav>
        </div>
        <div>
            <a type="button" class="btn btn-primary btn-sm rounded" data-bs-toggle="modal" data-bs-target="#FproductModal">
                Add Featur Item
            </a>
        </div>
    </div>
    <div class="card mb-4">

        <div class="card-body">
            <style>
                .table tr td {
                    vertical-align: middle !important;
                }
            </style>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Title</th>
                            <th>Feature Image</th>
                            <th>Products </th>
                            <th>Status</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fproducts as $key => $item)
                            <tr>
                                <td hidden class="id">{{ $item->id }}</td>
                                <td>{{ $key + 1 }}</td>
                                <td class="products_title">{{ $item->feature_products_title }} </td>
                                <td>
                                    <img src="{{ asset('storage/' . $item->image) }}"
                                        alt="{{ $item->feature_products_title }}" width="70">
                                </td>
                                {{-- <td>{{$item->text}}</td> --}}
                                <td>{{ $item->products->count() }}</td>
                                <td>
                                    @if ($item->status == 'Active')
                                        <a href="{{ route('zonestatus.update', ['id' => $item->id]) }}">
                                            <span class="badge rounded-pill alert-success">{{ $item->status }}</span>
                                        </a>
                                    @else
                                        <a href="{{ route('zonestatus.update', ['id' => $item->id]) }}">

                                            <span class="badge rounded-pill alert-danger">{{ $item->status }}</span>
                                        </a>
                                    @endif
                                </td>
                                <td class="text-end">

                                    <form class="deleteForm"
                                        action="{{ route('product_feature.destroy', ['id' => $item->id]) }}"
                                        method="post">
                                        @csrf
                                        @method('DELETE')

                                        <a href="#" class="btn btn-sm font-sm rounded btn-brand productFeaturedUpdate"
                                            data-bs-toggle="modal" data-bs-target="#FproductModalEdit"
                                            data-item-id="{{ $item->id }}">
                                            <i class="material-icons md-edit"></i> Edit
                                        </a>
                                        <a href="#" class="btn btn-sm font-sm btn-light rounded delete_item">
                                            <i class="material-icons md-delete_forever"></i> Delete
                                        </a>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> <!-- table-responsive//end -->
        </div>
        <!-- card-body end// -->
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="FproductModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Feature Products</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form enctype="multipart/form-data" id="ProductfetureForm">
                    @csrf
                    @method('POST')
                    <div class="modal-body">

                        <input type="hidden" name="feature_id" id="feature_id" value="">
                        <div class="row g-3">
                            <div class="col-md-12 mb-2">
                                <label for="title" class="form-label">Feature title<span
                                        class="text-danger">*</span></label>

                                <input type="text" class="form-control" id="edit_feature_products_title"
                                    name="feature_products_title" placeholder="Feature products title">
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="products" class="form-label"> Products <span
                                        class="text-danger">*</span></label>
                                <select id="products_id_s" class="form-control select-nice"  multiple="multiple" name="products_id[]">
                                    <option value="">--Select product--</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- <div class="col-md-12 mb-2">
                        <label for="text" class="form-label">Feature Text<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="text" name="text" cols="30" rows="10" placeholder="Feature Text....."></textarea>
                    </div> --}}

                            <div class="col-md-12 mb-2">
                                <label for="products_feature_image" class="form-label">Feature Image<span
                                        class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="products_feature_image" name="image">
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-check ml-20">
                                    <input class="form-check-input" type="checkbox" name="status" id="status">
                                    <label class="form-check-label" for="status">
                                        Active
                                    </label>
                                </div>
                            </div>

                            <div class="col-12 mb-4">
                                <div id="image-preview2">
                                    <img id="output-image2" src="" alt="" width="250px">
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Save</button>
                                {{-- <button class="btn btn-primary" type="submit">Submit form</button> --}}
                            </div>
                        </div>
                    </div>
                </form>
                {{-- <div class="modal-footer">
        </div> --}}
            </div>
        </div>
    </div>


    <!-- Add Modal -->
    <div class="modal fade" id="FproductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Feature Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('product_feature.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <input type="hidden" name="feature_products_id" id="feature_products_id">
                        <div class="row g-3">
                            <div class="col-md-12 mb-2">
                                <label for="title" class="form-label">Feature Products title<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="feature_products_title"
                                    name="feature_products_title" placeholder="Feature title" required>
                            </div>
                            <div class="col-md-12 mb-2">
                                <label for="products_id" class="form-label"> Products <span
                                        class="text-danger">*</span></label>
                                <select id="products_id" class="form-control select-nice"  multiple="multiple" name="products_id[]">
                                    <option value="">--Select product--</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="col-md-12 mb-2">
                                <label for="image" class="form-label">Feature Image<span
                                        class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="image" name="image" required>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-check ml-20">
                                    <input class="form-check-input" type="checkbox" checked name="status"
                                        id="status" @checked(true)>
                                    <label class="form-check-label" for="status">
                                        Active
                                    </label>
                                </div>
                            </div>

                            <div class="col-12 mb-4">
                                <div id="image-preview">
                                    <img id="output-image" src="" alt="" width="250px">
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Save</button>
                                {{-- <button class="btn btn-primary" type="submit">Submit form</button> --}}
                            </div>
                        </div>
                    </div>
                </form>
                {{-- <div class="modal-footer">
        </div> --}}
            </div>
        </div>
    </div>


@endsection

@push('product_features')
    <script>
        // Edit Feature Products
        $(document).ready(function() {
            $('.productFeaturedUpdate').on('click',function(e) {
                e.preventDefault();
                var itemId = $(this).data('item-id');

                $.ajax({
                    url: '{{url('/dashboard/feature/product_feature/edit')}}',
                    method: 'GET',
                    data: {
                        id: itemId
                    },
                    success: function(response) {
                        console.log(response);
                        $('#feature_id').val(response.id);
                        $('#edit_feature_products_title').val(response.feature_products_title);
                        // Check the status and set the checkbox accordingly
                        if (response.status === 'Active') {
                            $('#status').prop('checked', true);
                        } else {
                            $('#status').prop('checked', false);
                        }
                        // Populate other fields as needed
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        // Handle error
                    }
                });
            });

            $('#ProductfetureForm').on('submit', function(event) {
                event.preventDefault();
                const data = new FormData(this);

                $.ajax({
                    url: '{{url('/dashboard/feature/product_feature/update')}}',
                    method: 'post',
                    data: data,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.status == 'success') {
                            // Hide the edit modal
                            $('#FproductModalEdit').modal('hide');
                            // Reload the page
                            location.reload();
                        } else {
                            $.Notification.autoHideNotify('success', 'top right', 'Success', res
                                .message);
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error(xhr.responseText);
                    }
                })
            });

        });
        document.querySelectorAll('.delete_item').forEach(function (element) {
        element.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default link behavior
            console.log('click');
            // Find the closest form element related to the clicked link
            var form = this.closest('form');

            // Display SweetAlert confirmation
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                // If confirmed, submit the corresponding form
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
    </script>
@endpush
