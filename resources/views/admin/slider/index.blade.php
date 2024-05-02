
@extends('layouts.admin')
@section('title','Manage Slider')
@section('content')

<div class="content-header">
    <div>
        <h2 class="content-title card-title">Manage Sliders</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{'/dashborad'}}">Dashborad</a></li>
              <li class="breadcrumb-item active" aria-current="page">Slider</li>
            </ol>
        </nav>
    </div>
    <div>
        {{-- <a href="#" class="btn btn-primary btn-sm rounded">Add New category</a> --}}
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-sm rounded" data-bs-toggle="modal" data-bs-target="#sliderModel">
            New Slider
        </button>
    </div>
</div>
<style>
    .table tr td{
        vertical-align: middle;
    }
</style>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                <table id="" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#SN</th>
                            <th>Title</th>
                            <th>Subtitle </th>
                            <th width=20% >Image</th>
                            <th>Shop Link</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sliders as $key => $slider)
                        <tr >
                            <td >{{$key+1}}</td>
                            <td >{{$slider->title}}</td>
                            <td>{{$slider->subtitle}}</td>
                            <td>
                                <img src="{{asset('storage/'.$slider->image)}}" alt="{{$slider->title}}" width="100%">
                            </td>

                            <td>
                                {{$slider->slider_url}}
                            </td>
                            <td>

                                <form class="deleteForm" action="{{ route('slider.destroy', $slider->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a href="#"  class="btn btn-sm font-sm rounded btn-brand edit"
                                    data-bs-toggle="modal" data-bs-target="#sliderEditModal" data-slider-id="{{ $slider->id}}">
                                        <i class="material-icons md-edit"></i> Edit
                                    </a>
                                    <a href="#" class="btn btn-sm font-sm btn-light rounded delete">
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

@include('admin.slider.edit')
@include('admin.slider.create')

@endsection
@push('product')
<script>

    // Edit Category
    $(document).on('click', '.edit', function (e) {
        e.preventDefault();
        var sliderId = $(this).data('slider-id');
        // console.log(categoryId);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/dashboard/slider/edit',
            method: 'GET',
            data: {
                id: sliderId,
            },
            success: function (response) {
                $('#slider_id').val(response.id);
                $('#slider_title').val(response.title);
                $('#slider_sub_title').val(response.subtitle);
                $('#slider_url').val(response.slider_url);

                const outputImage = document.getElementById('output-image2');
                outputImage.src = "{{asset('storage')}}"+'/'+response.image
            }
        });
    });

    //Update Category
    $("#sliderUpdateForm").submit(function (e) {
        e.preventDefault();
        const data = new FormData(this);
        console.log(data);
        $.ajax({
            url: '/dashboard/slider/update',
            method: 'post',
            data: data,
            cache: false,
            processData: false,
            contentType: false,
            success: function (res) {
                if (res.status == 200) {

                    // $("#sliderEditModal").modal('hide');

                    location.reload();

                    // $.Notification.autoHideNotify('success', 'top right', 'Success', res.message);
                }
                else{
                    $.Notification.autoHideNotify('danger', 'top right', 'Danger', res);

                }
            }
        })
    });

    document.querySelectorAll('.delete').forEach(function (element) {
        element.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default link behavior

            var form = this.closest('form');

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
