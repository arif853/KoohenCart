@extends('layouts.admin')
@section('title','Manage About Us')
@section('content')

<div class="content-header">
    <div>
        <h2 class="content-title card-title">Manage About Us</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{'/dashborad'}}">Dashborad</a></li>
              <li class="breadcrumb-item active" aria-current="page">About Us</li>
            </ol>
        </nav>
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

                <table id="" class="table table-bordered table-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th width="65%">Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($aboutus as $key => $about)
                        <tr >
                            <td >{{$key+1}}</td>
                            <td>{{$about->title}}</td>
                            <td>{!!$about->description!!}</td>
                            <td>
                                <a href="#"  class="btn btn-sm font-sm rounded btn-warning edit"
                                        data-bs-toggle="modal" data-bs-target="#aboutus" data-aboutus-id="{{ $about->id}}">
                                        <i class="material-icons md-edit"></i> Edit
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


<!-- Modal -->
<div class="modal fade" id="aboutus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update About Us</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        {{-- <div class="category_form" id="category_form"></div> --}}
        <form id="aboutusEditForm">

            <div class="modal-body">
                <input type="hidden" id="aboutId" name="aboutId">
                <div class="row g-3">
                    <div class="col-md-12 mb-2">
                        <label for="aboutusTitle" class="form-label">Title<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="aboutusTitle" name="aboutusTitle" placeholder="Type a Title" required>
                    </div>
                    <div class="col-md-12 mb-2">
                        <label for="summernote" class="form-label">Description<span class="text-danger">*</span></label>
                        <textarea placeholder="Type here" class="form-control" id="summernote" rows="15" name="description"></textarea>
                        {{-- <input type="text" class="form-control" id="ads_title" name="ads_title" placeholder="Ads Title" required> --}}
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Save</button>
                      {{-- <button class="btn btn-primary" type="submit">Submit form</button> --}}
                    </div>
                </div>
            </div>
        </form>
      </div>
    </div>
</div>

@endsection

@push('product')
<script>

    // Edit ads
    $(document).on('click', '.edit', function (e) {
        e.preventDefault();
        var aboutusId = $(this).data('aboutus-id');
        console.log(aboutusId);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{url('/dashboard/aboutus/edit')}}',
            method: 'GET',
            data: {
                id: aboutusId,
            },
            success: function (response) {
                console.log(response);
                $('#aboutId').val(response.id);
                $('#aboutusTitle').val(response.title);
                $('#summernote').val(response.description);
            }
        });
    });

    //Update ads
    $("#aboutusEditForm").submit(function (e) {

        e.preventDefault();
        const data = new FormData(this);

        console.log(data);

        $.ajax({
            url: '{{url('/dashboard/aboutus/update')}}',
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
</script>
@endpush
