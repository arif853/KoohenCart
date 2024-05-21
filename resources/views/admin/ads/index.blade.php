@extends('layouts.admin')
@section('title','Manage Ads')
@section('content')

<div class="content-header">
    <div>
        <h2 class="content-title card-title">Manage Ads Banner</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{'/dashborad'}}">Dashborad</a></li>
              <li class="breadcrumb-item active" aria-current="page">Ads Banner</li>
            </ol>
        </nav>
    </div>
    <div>
        {{-- <a href="#" class="btn btn-primary btn-sm rounded">Add New category</a> --}}
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary btn-sm rounded" data-bs-toggle="modal" data-bs-target="#adsModal">
            New Banner
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
                            <th>Header Title</th>
                            <th>Main Title</th>
                            <th width=20% >Image</th>
                            <th>Button Link</th>
                            <th>Position No.</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($allads as $key => $ads)
                        <tr >
                            <td >{{$key+1}}</td>
                            <td >{{$ads->header}}</td>
                            <td>{{$ads->title}}</td>
                            <td>
                                <img src="{{asset('storage/'.$ads->image)}}" alt="{{$ads->title}}" width="100%">
                            </td>
                            <td>
                                <a href="{{$ads->shop_url}}" target="__blank">{{$ads->btntext}}</a>
                            </td>
                            <td>
                                @if ($ads->is_featured == 1)
                                    @if ($ads->is_feature_no == 1)
                                     <span class="badge bg-success">1. After New Arrival</span>
                                    @elseif ($ads->is_feature_no == 2)
                                     <span class="badge bg-success">2. After Campaign</span>
                                    @else
                                     <span class="badge bg-success">3. After Popular Products</span>
                                    @endif
                                @else
                                <span class="badge bg-danger">Not Featured</span>
                                @endif
                            </td>
                            <td>
                                @if ($ads->status == 1)
                                <a href="{{route('update.status',['id' => $ads->id])}}">
                                    <span class="badge bg-success">Active</span>
                                </a>
                                @else
                                <a href="{{route('update.status',['id' => $ads->id])}}">
                                    <span class="badge bg-danger">Inactive</span>
                                </a>
                                @endif
                            </td>
                            <td>
                                <form class="deleteForm" action="{{ route('ads.destroy', $ads->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a href="#"  class="btn btn-sm font-sm rounded btn-brand edit"
                                        data-bs-toggle="modal" data-bs-target="#adsEditModal" data-ads-id="{{ $ads->id}}">
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

@include('admin.ads.edit')
@include('admin.ads.create')

@endsection
@push('product')
<script>

    // Edit Category
    $(document).on('click', '.edit', function (e) {
        e.preventDefault();
        var adsId = $(this).data('ads-id');
        // console.log(categoryId);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/dashboard/setting/ads/edit',
            method: 'GET',
            data: {
                id: adsId,
            },
            success: function (response) {
                $('#ads_id').val(response.id);
                $('#ads_header').val(response.header);
                $('#ads_title').val(response.title);
                $('#shop_url').val(response.shop_url);
                $('#is_featured2').prop('checked', response.is_featured == 1);

                var adsNoField = document.getElementById('adsNoField2');
                var checkbox = document.getElementById('is_featured2');

                if (response.is_featured == 1) {
                    adsNoField.style.display = 'block';
                } else {
                    adsNoField.style.display = 'none';
                }
                $('#is_feature_no').val(response.is_feature_no);


                const outputImage = document.getElementById('output-image2');
                outputImage.src = "{{asset('storage')}}"+'/'+response.image
            }
        });
    });

    //Update Category
    $("#adsUpdateForm").submit(function (e) {
        e.preventDefault();
        const data = new FormData(this);
        console.log(data);
        $.ajax({
            url: '/dashboard/setting/ads/update',
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
