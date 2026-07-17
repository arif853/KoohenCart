@extends('layouts.admin')
@section('title','Manage Subcategories')
@section('content')

<div class="content-header">
    <div>
        <h2 class="content-title card-title">SubCategory List</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{'/dashborad'}}">Dashborad</a></li>
              <li class="breadcrumb-item active" aria-current="page">Subcategory</li>
            </ol>
        </nav>
    </div>
    <div>
        {{-- <a href="#" class="btn btn-primary btn-sm rounded">Add New category</a> --}}
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-sm rounded" data-bs-toggle="modal" data-bs-target="#subsubcategoryModal">
            Add New
        </button>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card mb-4">
            <header class="card-header">
                <div class="row gx-3">
                    <div class="col-lg-4 mb-lg-0 mb-15 me-auto">
                        <input type="text" placeholder="Search..." class="form-control">
                    </div>
                    <div class="col-lg-2 col-6">
                        <div class="custom_select">
                            <select class="form-select select-nice">
                                <option selected>Categories</option>
                                <option>Technology</option>
                                <option>Fashion</option>
                                <option>Home Decor</option>
                                <option>Healthy</option>
                                <option>Travel</option>
                                <option>Auto-car</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2 col-6">
                        <input type="date" class="form-control" name="">
                    </div>
                </div>
            </header> <!-- card-header end// -->
            <div class="card-body">
                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#SN</th>
                            <th>Subcategory</th>
                            <th>Parent Category</th>
                            <th>Subcategory Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subcategories as $key => $subcategory)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$subcategory->subcategory_name}}</td>
                            <td>{{$subcategory->category->category_name}}</td>
                            <td>
                                <img src="{{asset('storage/subcategory_image/'.$subcategory->subcategory_image)}}" alt="{{$subcategory->slug}}" width="60">
                            </td>
                            <td>
                                @if ($subcategory->status == 1)
                                <span class="badge rounded-pill alert-success">Published</span>
                                @else
                                <span class="badge rounded-pill alert-danger">Not Published</span>
                                @endif
                            </td>
                            <td>

                                <form class="deleteForm" action="{{ route('subcategory.destroy', $subcategory->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a href="#"  class="btn btn-sm font-sm rounded btn-brand edit-subcategory" data-bs-toggle="modal" data-bs-target="#subcategoryModalEdit" data-subcategory-id="{{ $subcategory->id}}">
                                        <i class="material-icons md-edit"></i> Edit
                                    </a>
                                    <a href="#" class="btn btn-sm font-sm btn-light rounded delete_subcategory">
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


@include('admin.Old_style_category.subcategory.edit')
@include('admin.Old_style_category.subcategory.create')

@endsection

@push('subcategory')
<script>
    // Edit Brand
    $(document).on('click', '.edit-subcategory', function (e) {
        e.preventDefault();
        var subcategoryId = $(this).data('subcategory-id');
        console.log(subcategoryId);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/dashboard/subcategory/edit',
            method: 'GET',
            data: {
                id: subcategoryId,
            },
            success: function (response) {
                $('#subcategory_id').val(response.id);
                $('#category_id').val(response.category_id);
                $('#subcategory_name').val(response.subcategory_name);
                $('#status').prop('checked', response.status == 1);

                const outputImage = document.getElementById('output-image2');
                outputImage.src = "{{asset('storage/subcategory_image')}}"+'/'+response.subcategory_image
                // $('#output-image2').val(response.brand_image);
                // $("#edit_modal_form").modal('show');
                // console.log(response)
            }
        });
    });

    //Update Brand
    $("#subcategoryEditForm").submit(function (e) {
        e.preventDefault();
        const data = new FormData(this);
        console.log(data);
        $.ajax({
            url: '/dashboard/subcategory/update',
            method: 'post',
            data: data,
            cache: false,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.status == 200) {
                    $("#subcategoryModalEdit").modal('hide');
                    location.reload();
                    // $.Notification.autoHideNotify('success', 'top right', 'Success', res.message);
                }
                else{
                    $.Notification.autoHideNotify('danger', 'top right', 'Danger', res.message);

                }
            }
        })
    });

    document.querySelectorAll('.delete_subcategory').forEach(function (element) {
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
