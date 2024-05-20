@extends('layouts.admin')
@section('title','Contact Info')
@section('content')
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Contact Infos</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{'/dashborad'}}">Dashborad</a></li>
              <li class="breadcrumb-item " aria-current="page"> Settings </li>
              <li class="breadcrumb-item active" aria-current="page">Contact Infos</li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card mb-4">
            <div class="card-header">

            </div>
            <div class="card-body">
                <table id="" class="table table-striped table-bordered table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Phone Number</th>
                            <th>WhatsApp </th>
                            <th>Email</th>
                            <th>Office Addess</th>
                            <th>Office Hour</th>
                            <th width=15%>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $cdata)
                        <tr>
                            <td>{{$key +1 }}</td>
                            <td>{{$cdata->phone}}</td>
                            <td>
                                {{$cdata->whatsapp}}
                                <br>
                                <span>(whatsapp Link will auto generate.)</span>
                            </td>
                            <td>{{$cdata->email}}</td>
                            <td>{{$cdata->address}}</td>
                            <td>{{$cdata->officehour}}</td>
                            <td>
                                <a href="#"  class="btn btn-sm font-sm rounded btn-brand edit"
                                    data-bs-toggle="modal" data-bs-target="#contactInfoEditModal" data-cdata-id="{{ $cdata->id}}">
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
<div class="modal fade" id="contactInfoEditModal" tabindex="-1" aria-labelledby="contactInfoEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="contactInfoEditModalLabel">Contact Info</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        {{-- <div class="category_form" id="category_form"></div> --}}
        <form id="contactinfoUpdateFrom">
            @csrf
            <input type="hidden" name="id" id="cid">
            <div class="modal-body">
                <div class="row gx-3">

                    <div class="col-lg-12 col-md-12 mb-2">
                        <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                        <input required type="text" class="form-control" placeholder="Phone Number" name="phone" id="phone">
                    </div>

                    <div class="col-lg-12 col-md-12 mb-2">
                        <label for="whatsapp" class="form-label">WhatsApp Number <span class="text-danger">*</span></label>
                        <input required type="text" class="form-control" placeholder="WhatsApp Number" name="whatsapp" id="whatsapp">
                        <small style="font-size: 12px; color:yellowgreen">(Do not add any link here, Only number.)</small>
                    </div>

                    <div class="col-lg-12 col-md-12 mb-2">
                        <label for="email" class="form-label">Email Address <span class="text-danger">*</span></label>
                        <input required type="text" class="form-control" placeholder="Email Address" name="email" id="email">
                    </div>

                    <div class="col-lg-12 col-md-12 mb-2">
                        <label for="address" class="form-label">Office Address <span class="text-danger">*</span></label>
                        <input required type="text" class="form-control" placeholder="Office Address" name="address" id="address">
                    </div>

                    <div class="col-lg-12 col-md-12 mb-2">
                        <label for="address" class="form-label">Office Hour <span class="text-danger">*</span></label>
                        <input required type="text" class="form-control" placeholder="Opening Hour/ Office Hour" name="officehour" id="officehour">
                    </div>

                    <div class="col-lg-12 mb-4 mt-4 d-flex justify-content-end">
                        <button class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </form>
      </div>
    </div>
</div>



@endsection
@push('brand')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
        // Edit Category
    $(document).on('click', '.edit', function (e) {
        e.preventDefault();
        var infoId = $(this).data('cdata-id');
        console.log(infoId);


        $.ajax({
            url: '{{route('contactinfo.edit')}}',
            method: 'GET',
            data: {
                id: infoId,
            },
            success: function (response) {
                console.log(response.data.phone);
                $('#cid').val(response.data.id);
                $('#phone').val(response.data.phone);
                $('#whatsapp').val(response.data.whatsapp);
                $('#email').val(response.data.email);
                $('#address').val(response.data.address);
                $('#officehour').val(response.data.officehour);
            }
        });
    });

    //Update Category
    $("#contactinfoUpdateFrom").submit(function (e) {
        e.preventDefault();
        const data = new FormData(this);
        console.log(data);
        $.ajax({
            url: '{{route('contactinfo.update')}}',
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
