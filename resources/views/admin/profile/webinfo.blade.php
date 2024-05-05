@extends('layouts.admin')
@section('title','Web Info Update')
@section('content')
<link rel="stylesheet" href="{{asset('admin/assets/css/vendors/bs-toggle-btn.css')}}">
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Web Info</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{'/dashborad'}}">Dashborad</a></li>
              <li class="breadcrumb-item active" aria-current="page">Web Info</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                @php
                    $webinfo = DB::table('web_infos')->first();
                @endphp
                <form action="{{route('webinfo.update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="user_id" id="user_id" value="{{$webinfo->id}}">

                    <div class="row gx-3">
                        <div class="col-6 col-lg-6 mb-3">
                            <label class="form-label">Application Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" value="{{ $webinfo->appName }}" name="appName" placeholder="Type here">
                        </div> <!-- col .// -->
                        <div class="col-6 col-lg-6 mb-3">
                            <label class="form-label">Owner Name</label>
                            <input class="form-control" type="text" value="{{$webinfo->ownerName}}" name="ownerName" placeholder="Type here">
                        </div> <!-- col .// -->
                    </div>

                    <div class="row">
                        <div class="col-lg-6  mb-3">
                            <label class="form-label">Address</label>
                            <input class="form-control" type="text" name="address" value="{{$webinfo->address}}" placeholder="Type here">
                        </div> <!-- col .// -->
                        <div class="col-lg-6  mb-3">
                            <label class="form-label">Short Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="description" id="description" placeholder="Type here" cols="30" rows="15">
                                {{$webinfo->description}}
                            </textarea>
                        </div> <!-- col .// -->
                    </div> <!-- row.// -->

                    <div class="row gx-3 mb-4">
                        <div class="col-lg-6 col-md-6">
                            <label for="" class="form-label">Upload Main Logo<span class="text-danger">*</span> :</label>
                            <input type="file" name="weblogo" id="logo" accept="image/*" class="form-control">
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <label for="" class="form-label">Upload Favicon Logo<span class="text-danger">*</span> :</label>
                            <input type="file" name="webfavicon" id="favicon" accept="image/*" class="form-control">
                        </div>
                    </div>

                    <div class="row gx-3">
                        <div class="col-lg-6 col-md-6">
                            <figure class="text-lg-center">
                                <div id="app" class="photo-upload">
                                    <div class="image-preview" id="image-preview" >
                                        <img id="preview-img" src="{{asset('storage/logos/'.$webinfo->weblogo)}}" class="image-preview__img">
                                    </div>
                                </div>
                            </figure>
                        </div> <!-- col.// -->

                        <div class="col-lg-6 col-md-6">
                            <div id="app" class="photo-upload">
                                <div class="image-preview2" id="image-preview2" >
                                    <img id="preview-img2" src="{{asset('storage/favicons/'.$webinfo->webfavicon)}}" class="image-preview__img">
                                </div>
                            </div>
                        </div> <!-- col.// -->
                    </div>
                    <div class="row gx-3 mt-50">
                        <div class="col-lg-6">
                            <label for="" class="form-label">Marquee Text/ Notice Text</label>
                            <input type="text" name="marquee" id="marquee" class="form-control" placeholder="Add Notice here" value="{{$webinfo->marquee}}">
                        </div>
                        <div class="col-lg-6">
                            <label for="" class="form-label">Footer Copyright Text</label>
                            <input type="text" name="copyright" id="copyright" value="{{$webinfo->copyright}}" class="form-control" placeholder="Add copyright text with year and sign.">
                        </div>
                    </div>
                    <div class="row gx-3 mt-50">
                        <div class="col-lg-12">
                            <button class="btn btn-primary" type="submit">Save </button>
                        </div>
                    </div>
                </form>
            </div> <!-- card-body end// -->
        </div> <!-- card end// -->
    </div>
</div>

@endsection
@push('brand')
<script>
    $(document).ready(function() {
        $('#logo').on('change', function(event) {
            var input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#image-preview').show();
                    $('#preview-img').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        });

        $('#favicon').on('change', function(event) {
            var input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#image-preview2').show();
                    $('#preview-img2').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        });

        $('#seologo').on('change', function(event) {
            var input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#seo-preview').show();
                    $('#seo-img').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        });
    });
</script>
@endpush
