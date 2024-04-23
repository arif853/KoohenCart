@extends('layouts.admin')
@section('title','Varient')
@section('content')

<div class="content-header">
    <div>
        <h2 class="content-title card-title">Varient List</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{'/dashborad'}}">Dashborad</a></li>
              <li class="breadcrumb-item active" aria-current="page">Varient</li>
            </ol>
        </nav>
    </div>
    <div>
        {{-- <a href="#" class="btn btn-primary btn-sm rounded">Add New Brand</a> --}}
        <!-- Button trigger modal -->

    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-6">

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between">
                <h4>Color Varient Table</h4>
                <button type="button" class="btn btn-primary btn-sm rounded" data-bs-toggle="modal" data-bs-target="#colorModal">
                    Add color
                </button>
            </div>
            <div class="card-body">
                <table class="table table-border" id="colorTable" style="width:100%">
                    <thead>
                        <tr>
                            <th>#SN</th>
                            <th>Color Name</th>
                            <th>Color code</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($colors as $key=> $color)
                            <style>
                                .color_thumb_{{ $key }} {
                                    background-color: {{ $color->color_code }};
                                    height: 20px;
                                    width: 20px;
                                    border: 1px solid #000;
                                    display: inline-block;
                                    margin-right: 6px
                                }
                                /* .modal-backdrop.show {
                                    opacity: 0.5;
                                    z-index: -1;
                                    } */
                            </style>
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$color->color_name}}</td>
                            <td> <span class="color_thumb_{{ $key }}"></span><span style="color: {{ $color->color_code }};">{{$color->color_code}}</span></td>
                            <td>
                                @if ($color->status == 1)
                                    <span class="badge rounded-pill alert-success">Published</span>
                                @else
                                    <span class="badge rounded-pill alert-danger">Not Published</span>
                                @endif
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm font-sm rounded btn-brand mb-2 edit-color" data-bs-toggle="modal" data-bs-target="#colorEditModal" data-color-id="{{ $color->id }}">
                                    <i class="material-icons md-edit"></i> Edit
                                </a>

                                <a href="{{ route('color.destroy', $color->id) }}" class="btn btn-sm font-sm btn-light rounded mb-2" onclick="confirmDelete(event)">
                                    <i class="material-icons md-delete_forever"></i> Delete
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- {{ $colors->links() }} --}}
            </div> <!-- card-body end// -->
        </div> <!-- card end// -->
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between">
                <h4>Size Varient Table</h4>
                <div>

                    <button type="button" class="btn btn-primary btn-sm rounded" data-bs-toggle="modal" data-bs-target="#sizeModal">
                        Add Size
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-border" id="sizeTable" style="width:100%">
                    <thead>
                        <tr>
                            <th>#SN</th>
                            <th>Size Name</th>
                            <th>Size code</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sizes as $key => $size)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$size->size_name}}</td>
                            <td>{{$size->size}}</td>
                            <td>
                                @if ($size->status == 1)
                                <span class="badge rounded-pill alert-success">Published</span>
                                @else
                                <span class="badge rounded-pill alert-danger">Not Published</span>
                                @endif
                            </td>
                            <td>
                                <a href="#" class="btn btn-sm font-sm rounded btn-brand mb-2 size-edit" data-bs-toggle="modal" data-bs-target="#sizeModalEdit" data-size-id="{{ $size->id }}">
                                    <i class="material-icons md-edit"></i> Edit
                                </a>
                                <a href="{{route('size.destroy',$size->id)}}" class="btn btn-sm font-sm btn-light rounded mb-2" onclick="confirmDelete(event)">
                                    <i class="material-icons md-delete_forever"></i> Delete
                                </a>
                            </td>

                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div> <!-- card-body end// -->
        </div> <!-- card end// -->
    </div>

</div>
@include('admin.products.varient.colors_edit')
@include('admin.products.varient.size_edit')

@include('admin.products.varient.colors')
@include('admin.products.varient.size')


@endsection
@push('varient')

<script>
    $(document).ready(function () {

        $('#colorTable').DataTable( {
            pageLength : 5,
            lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']]
        } )

        $('#sizeTable').DataTable( {
            pageLength : 5,
            lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'All']]
        } )
        // Edit Color
        $(document).on('click', '.edit-color', function (e) {
            e.preventDefault();
            var colorId = $(this).data('color-id');
            // console.log(colorId);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{route('color.edit')}}',
                method: 'GET',
                data: {
                    id: colorId,
                },
                success: function (response) {
                    $('#id').val(response.id);
                    $('#color_code').val(response.color_code);
                    $('#color_name').val(response.color_name);
                    $('#invalidCheck2').prop('checked', response.status == 1);
                    // $("#edit_modal_form").modal('show');
                    // console.log(response)
                }
            });
        });

        //Update Color
        $("#colorEditForm").submit(function (e) {
            e.preventDefault();
            const data = new FormData(this);
            // console.log(data);
            $.ajax({
                url: '{{route('color.update')}}',
                method: 'post',
                data: data,
                cache: false,
                processData: false,
                contentType: false,
                success: function (res) {
                    if (res.status == 200) {
                        $("#colorEditModal").modal('hide');
                        location.reload();
                        // $.Notification.autoHideNotify('success', 'top right', 'Success', res.message);
                    }
                    else{
                        $.Notification.autoHideNotify('danger', 'top right', 'Danger', res.message);

                    }
                }
            })
        });

        //Size Edit
        $(document).on('click', '.size-edit', function (e) {
            e.preventDefault();
            var sizeId = $(this).data('size-id');
            console.log(sizeId);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{route('size.edit')}}',
                method: 'GET',
                data: {
                    id: sizeId,
                },
                success: function (response) {
                    $('#size_id').val(response.id);
                    $('#size_name').val(response.size_name);
                    $('#size_value').val(response.size);
                    $('#status').prop('checked', response.status == 1);
                    // $("#edit_modal_form").modal('show');
                    // console.log(response)
                }
            });
        });

        //Update size
        $("#sizeEditForm").submit(function (e) {

            e.preventDefault();
            const data = new FormData(this);
            console.log(data);
            $.ajax({
                url: '{{route('size.update')}}',
                method: 'post',
                data: data,
                cache: false,
                processData: false,
                contentType: false,
                success: function (res) {
                    if (res.status == 200) {
                        // alert('ok');
                        $("#sizeModalEdit").modal('hide');
                        location.reload();
                        // $.Notification.autoHideNotify('success', 'top right', 'Success', res.message);
                    }
                    else{
                        $.Notification.autoHideNotify('danger', 'top right', 'Danger', res.message);

                    }
                }
            })
        });

        //Update sizeChart
        $("#sizeChartForm").submit(function (e) {
            e.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            const formData = $(this).serializeArray();

            $.ajax({
                url: '{{ route('sizechart.update') }}',
                method: 'post',
                data: formData,
                success: function (res) {
                    if (res.status == 200) {
                        $("#sizeChartModal").modal('hide');
                        $.Notification.autoHideNotify('success', 'top right', 'Success', 'Size chart updated successfully!');
                        // Optionally update specific parts of the page instead of reloading
                        // For example, update a table listing the size charts
                        location.reload('#sizeChartTable');
                    } else {
                        $.Notification.autoHideNotify('danger', 'top right', 'Danger', 'Failed to update size chart. Please try again'+res.message+'.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(status);
                    console.error(error);
                    $.Notification.autoHideNotify('danger', 'top right', 'Error', 'An error occurred while processing your request. Please try again later.');
                }
            });
        });

    });
</script>

@endpush
