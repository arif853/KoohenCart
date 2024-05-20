@extends('layouts.admin')
@section('title','Profile Setting')

@section('content')

    <div class="content-header">
        <h3 class="content-title">Profile setting </h3>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row gx-5">
                <aside class="col-lg-2 border-end">

                    <ul class="nav nav-tabs flex-lg-column mb-4" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="general-tab"
                          data-bs-toggle="tab" data-bs-target="#general"
                          role="tab" aria-controls="general"
                          aria-selected="true">General</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="admin-tab"
                          data-bs-toggle="tab" data-bs-target="#admin"
                           role="tab" aria-controls="admin"
                          aria-selected="false">Account Setting</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="social-tab"
                            data-bs-toggle="tab" data-bs-target="#social"
                             role="tab" aria-controls="social"
                            aria-selected="false">Social settings</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="SEO-tab"
                          data-bs-toggle="tab" data-bs-target="#SEO"
                          role="tab" aria-controls="SEO"
                          aria-selected="false">SEO settings</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="mail-tab"
                          data-bs-toggle="tab" data-bs-target="#mail"
                          role="tab" aria-controls="mail"
                          aria-selected="false">Mail settings</a>
                        </li>
                      </ul>
                </aside>
                @php
                    $userData = DB::table('user_profiles')->first();
                @endphp
                <div class="col-lg-10">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane" id="SEO" role="tabpanel" aria-labelledby="SEO-tab">
                            <section class="content-body p-xl-4">
                                @php
                                    $seo = DB::table('seo_settings')->first();
                                @endphp
                                <form action="{{route('user.SEOUpdate')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')
                                    <input type="hidden" name="seo_id" id="seo_id" value="{{$seo->id}}">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="row gx-3">
                                                <div class="col-6 col-lg-6 col-md-4  mb-3">
                                                    <label class="form-label">Title<span class="text-danger">*</span></label>
                                                    <input class="form-control" type="text" value="{{$seo->seoTitle}}" name="seoTitle" placeholder="Type here">
                                                </div> <!-- col .// -->
                                                <div class="col-4 col-lg-4 col-md-4  mb-3 text-lg-center">
                                                    <div id="app" class="photo-upload">
                                                        <div class="file-upload-form">
                                                            <input type="file" name="seoLogo"  id="seologo" accept="image/*" class="input-file">
                                                            <label for="seologo">SEO Logo</label>
                                                        </div>
                                                        <div class="image-preview" id="seo-preview" >
                                                            <img id="seo-img" src="{{asset('storage/Seologos/'.$seo->seoLogo)}}" class="image-preview__img">
                                                        </div>
                                                    </div>
                                                    <label for="" class="form-label">SEO Logo</label>
                                                </div> <!-- col .// -->
                                                <div class="col-6 col-lg-6 col-md-6  mb-3">
                                                    <label class="form-label">SEO Description </label>
                                                    <textarea class="form-control" name="seoDescription"
                                                    placeholder="SEO Description" cols="30" rows="15">
                                                    {{$seo->seoDescription}}
                                                </textarea>
                                                </div> <!-- col .// -->
                                            </div> <!-- row.// -->
                                        </div> <!-- col.// -->

                                    </div> <!-- row.// -->
                                    <br>
                                    <button class="btn btn-primary" type="submit">Save </button>
                                </form>
                                <hr class="my-5">

                            </section> <!-- content-body .// -->
                        </div>
                        <div class="tab-pane" id="mail" role="tabpanel" aria-labelledby="mail-tab">
                            <h4>Mail Setup link goes here!!</h4>
                            ...
                        </div>
                    </div>

                </div> <!-- col.// -->
            </div> <!-- row.// -->
        </div> <!-- card body end// -->
    </div> <!-- card end// -->
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
