
@extends('layouts.admin')
@section('title','Category Feature')

@section('content')
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Feature Items</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{'/dashborad'}}">Dashborad</a></li>
              <li class="breadcrumb-item active" aria-current="page"> Feature Items</li>
            </ol>
        </nav>
    </div>
    <div>
        <a type="button" class="btn btn-primary btn-sm rounded" data-bs-toggle="modal" data-bs-target="#FcategoryModal">
            Add Featur Item
        </a>
    </div>
</div>
<div class="card mb-4">

    <div class="card-body">
<style>
    .table tr td{
        vertical-align: middle !important;
    }
</style>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" />
                            </div>
                        </th>
                        <th>#ID</th>
                        <th>Title</th>
                        <th>Feature Image</th>
                        {{-- <th>Feature text</th> --}}
                        <th>Category </th>
                        <th>Status</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($feature_items as $key => $item)
                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" />
                            </div>
                        </td>
                        <td>{{$key+1}}</td>
                        <td>{{$item->title}} </td>
                        <td>
                            <img src="{{asset('storage/'.$item->image)}}" alt="{{$item->title}}" width="150" >
                        </td>
                        {{-- <td>{{$item->text}}</td> --}}
                        <td>{{$item->category->category_name}}</td>
                        <td>
                            @if($item->status == 'Active')
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

                            <form class="deleteForm" action="{{route('category_feature.destroy', ['id' => $item->id])}}" method="post">
                                @csrf
                                @method('DELETE')
                                <a href="#"  class="btn btn-sm font-sm rounded btn-brand edit-item"
                                    data-bs-toggle="modal" data-bs-target="#FcategoryModalEdit" data-item-id="{{ $item->id}}">
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
<div class="modal fade" id="FcategoryModalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Feature Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form enctype="multipart/form-data" id="fetureForm">
            @csrf
            @method('POST')
            <div class="modal-body">
                <input type="hidden" name="feature_id" id="feature_id" >
                <div class="row g-3">
                    <div class="col-md-12 mb-2">
                        <label for="title" class="form-label">Feature title<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="cat_title" name="title" placeholder="Feature title" required>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="parent_category_id" class="form-label"> Category<span class="text-danger">*</span></label>
                        <select id="cat_parent_category_id" class="form-control select-nice" name="parent_category">
                            <option value="">--Select category--</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="col-md-12 mb-2">
                        <label for="text" class="form-label">Feature Text<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="text" name="text" cols="30" rows="10" placeholder="Feature Text....."></textarea>
                    </div> --}}

                    <div class="col-md-12 mb-2">
                      <label for="cat_feature_image" class="form-label">Feature Image<span class="text-danger">*</span></label>
                      <input type="file" class="form-control" id="cat_feature_image" name="cat_feature_image" >
                    </div>
                    <div class="col-12 mb-2">
                      <div class="form-check ml-20">
                        <input class="form-check-input" type="checkbox" name="status" id="status" >
                        <label class="form-check-label" for="status">
                          Active
                        </label>
                      </div>
                    </div>

                    <div class="col-12 mb-4">
                        <div id="image-preview2">
                            <img id="output-image2" src="" alt=""  width="250px">
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
<div class="modal fade" id="FcategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Feature Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{route('category_feature.store')}}" method="POST" enctype="multipart/form-data" >
            @csrf
            @method('POST')
            <div class="modal-body">
                <input type="hidden" name="categories_id" id="categories_id" >
                <div class="row g-3">
                    <div class="col-md-12 mb-2">
                        <label for="title" class="form-label">Feature title<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Feature title" required>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="parent_category_id" class="form-label"> Category<span class="text-danger">*</span></label>
                        <select id="parent_category_id" class="form-control select-nice" name="parent_category">
                            <option value="">--Select category--</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="col-md-12 mb-2">
                        <label for="text" class="form-label">Feature Text<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="text" name="text" cols="30" rows="10" placeholder="Feature Text....."></textarea>
                    </div> --}}

                    <div class="col-md-12 mb-2">
                      <label for="feature_image" class="form-label">Feature Image<span class="text-danger">*</span></label>
                      <input type="file" class="form-control" id="feature_image" name="feature_image" required >
                    </div>
                    <div class="col-12 mb-2">
                      <div class="form-check ml-20">
                        <input class="form-check-input" type="checkbox" checked name="status" id="status" @checked(true)>
                        <label class="form-check-label" for="status">
                          Active
                        </label>
                      </div>
                    </div>

                    <div class="col-12 mb-4">
                        <div id="image-preview">
                            <img id="output-image" src="" alt=""  width="250px">
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

@push('zone')
<script>
    document.getElementById('feature_image').addEventListener('change', function (event) {
        const input = event.target;
        const preview = document.getElementById('image-preview');
        const outputImage = document.getElementById('output-image');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                outputImage.src = e.target.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        }
    });

    document.getElementById('cat_feature_image').addEventListener('change', function (event) {
        const input = event.target;
        const preview = document.getElementById('image-preview2');
        const outputImage = document.getElementById('output-image2');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                outputImage.src = e.target.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        }
    });

    // Edit Brand
    $(document).on('click', '.edit-item', function (e) {
        e.preventDefault();
        var itemId = $(this).data('item-id');
        // console.log(brandId);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/dashboard/category_feature/edit',
            method: 'GET',
            data: {
                id: itemId,
            },
            success: function (response) {
                $('#feature_id').val(response.id);
                $('#cat_title').val(response.title);
                // $('#cat_image').val(response.image);
                $('#cat_parent_category_id').val(response.category_id);
                $('#status').prop('checked', response.status == 'Active');

                const outputImage = document.getElementById('output-image2');
                outputImage.src = "{{asset('storage')}}"+'/'+response.image
            }
        });
    });

    //Update Brand
    $("#fetureForm").submit(function (e) {
        e.preventDefault();
        const data = new FormData(this);
        console.log(data);
        $.ajax({
            url: '/dashboard/category_feature/update',
            method: 'post',
            data: data,
            cache: false,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.status == 200) {
                    $("#brandEditForm").modal('hide');
                    location.reload();
                    // $.Notification.autoHideNotify('success', 'top right', 'Success', res.message);
                }
                else{
                    $.Notification.autoHideNotify('danger', 'top right', 'Danger', res.message);

                }
            }
        })
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
