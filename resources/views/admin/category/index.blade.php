@extends('layouts.admin')
@section('title','Manage categories')
@section('content')

<div class="content-header">
    <div>
        <h2 class="content-title card-title">Categories</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{'/dashborad'}}">Dashborad</a></li>
              <li class="breadcrumb-item active" aria-current="page">Category</li>
            </ol>
        </nav>
    </div>
    <div>
        {{-- <a href="#" class="btn btn-primary btn-sm rounded">Add New category</a> --}}
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-sm rounded" data-bs-toggle="modal" data-bs-target="#categoryModal">
            New Category
        </button>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card mb-4">
            <header class="card-header">
                
            </header> <!-- card-header end// -->
            <div class="card-body">
                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#SN</th>
                            <th>Category</th>
                            <th>Parent Category</th>
                            <th>Category icon</th>
                            <th>Category Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $key => $category)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$category->category_name}}</td>
                            <td>{{$category->parent_category}}</td>
                            <td>
                                <img src="{{asset('storage/'.$category->category_icon)}}" alt="{{$category->slug}}" width="60">
                            </td>
                            <td>
                                @if ($category->category_image != null)
                                <img src="{{asset('storage/category_image/'.$category->category_image)}}" alt="{{$category->slug}}" width="60">
                                @else
                                    No image.
                                @endif
                            </td>
                            <td>
                                @if ($category->status == 1)
                                <span class="badge rounded-pill alert-success">Active</span>
                                @else
                                <span class="badge rounded-pill alert-danger">Inactive</span>
                                @endif
                            </td>
                            <td>

                                <form class="deleteForm" action="{{ route('category.destroy', $category->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a href="#"  class="btn btn-sm font-sm rounded btn-brand edit-category"
                                    data-bs-toggle="modal" data-bs-target="#categoryModalEdit" data-category-id="{{ $category->id}}">
                                        <i class="material-icons md-edit"></i> Edit
                                    </a>
                                    <a href="#" class="btn btn-sm font-sm btn-light rounded delete_category">
                                        <i class="material-icons md-delete_forever"></i> Delete
                                    </a>
                                </form>
                            </td>

                        </tr>
                        @endforeach


                    </tbody>

                </table>
            </div> <!-- card-body end// -->
        </div> <!-- card end// -->
    </div>
</div>


@include('admin.category.edit')
@include('admin.category.create')

@endsection

@push('category')
<script>

    // Edit Category
    $(document).on('click', '.edit-category', function (e) {
        e.preventDefault();
        var categoryId = $(this).data('category-id');
        // console.log(categoryId);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/dashboard/category/edit',
            method: 'GET',
            data: {
                id: categoryId,
            },
            success: function (response) {
                $('#category_id').val(response.id);
                $('#category_name').val(response.category_name);
                $('#parent_category_id').val(response.parent_category);
                $('#status').prop('checked', response.status == 1);

                const outputImage = document.getElementById('output-image2');
                outputImage.src = "{{asset('storage/category_image')}}"+'/'+response.category_image

                const outputImage2 = document.getElementById('icon-image2');
                outputImage2.src = "{{asset('storage')}}"+'/'+response.category_icon
                // $('#output-image2').val(response.brand_image);
                // $("#edit_modal_form").modal('show');
                // console.log(response)
            }
        });
    });

    //Update Category
    $("#categoryEditForm").submit(function (e) {
        e.preventDefault();
        const data = new FormData(this);
        console.log(data);
        $.ajax({
            url: '/dashboard/category/update',
            method: 'post',
            data: data,
            cache: false,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.status == 200) {
                    $("#categoryModalEdit").modal('hide');
                    location.reload();
                    $.Notification.autoHideNotify('success', 'top right', 'Success', res.message);
                }
                else{
                    $.Notification.autoHideNotify('danger', 'top right', 'Danger', res.message);

                }
            }
        })
    });

    document.querySelectorAll('.delete_category').forEach(function (element) {
        element.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default link behavior
            console.log('click');
            // Find the closest form element related to the clicked link
            var form = this.closest('form');
            // console.log(form)
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
