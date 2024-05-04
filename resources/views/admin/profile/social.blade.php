@extends('layouts.admin')
@section('title','Social Info Update')
@section('content')
<link rel="stylesheet" href="{{asset('admin/assets/css/vendors/bs-toggle-btn.css')}}">
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Social Info</h2>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{'/dashborad'}}">Dashborad</a></li>
              <li class="breadcrumb-item active" aria-current="page">Social Info</li>
            </ol>
        </nav>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card mb-4">
            <div class="card-body">
                @php
                $social = DB::table('socialinfos')->first();
            @endphp
            <form action="{{route('socialinfo-update')}}" method="post" >
                @csrf
                @method('POST')
                <input type="hidden" name="socialInfo_id" id="socialInfo_id" value="{{$social->id}}">

                <div class="row gx-3 ">
                    <div class="col-2 col-lg-2 col-md-2 mb-3 align-self-center">
                        <label class="form-label">App Phone <span class="text-danger">*</span></label>
                    </div> <!-- col .// -->
                    <div class="col-4 col-lg-4 col-md-4 mb-3 align-self-center">
                        <input class="form-control" type="text" value="{{$social->appPhone}}" name="appPhone" placeholder="Type here">
                    </div> <!-- col .// -->
                    <div class="col-2 col-lg-2 col-md-2 mb-3 align-self-center">
                        {{-- <input type="checkbox" name="phone_status" id="phoneStatus" checked class="form-check "> --}}
                        <button type="button" class="btn btn-toggle active" data-bs-toggle="button" aria-pressed="true" autocomplete="off">
                            <div class="handle"></div>
                        </button>
                    </div> <!-- col .// -->
                </div>

                <div class="row gx-3 ">
                    <div class="col-2 col-lg-2 col-md-2  mb-3 align-self-center">
                        <label class="form-label">App Email<span class="text-danger ">*</span></label>
                    </div> <!-- col .// -->
                    <div class="col-4 col-lg-4 col-md-4  mb-3 align-self-center">
                        <input class="form-control" type="email" value="{{$social->appEmail}}" name="appEmail" placeholder="example@mail.com">
                    </div> <!-- col .// -->
                    <div class="col-2 col-lg-2 col-md-2  mb-3 align-self-center">
                        <button type="button" class="btn btn-toggle active" data-bs-toggle="button" aria-pressed="true" autocomplete="off">
                            <div class="handle"></div>
                        </button>
                    </div> <!-- col .// -->
                </div>

                <div class="row gx-3 ">
                    <div class="col-2 col-lg-2 col-md-2 mb-3 align-self-center">
                        <label class="form-label">WhatsApp <small>(Number Only, No link.)</small>
                            <span class="text-danger">*</span>
                        </label>
                    </div> <!-- col .// -->
                    <div class="col-4 col-lg-4 col-md-4 mb-3 align-self-center">
                        <input class="form-control" type="text" value="{{$social->whatsapp}}" name="whatsapp" placeholder="+880 1...">
                    </div> <!-- col .// -->
                    <div class="col-2 col-lg-2 col-md-2 mb-3 align-self-center">
                        <button type="button" class="btn btn-toggle active" data-bs-toggle="button" aria-pressed="true" autocomplete="off">
                            <div class="handle"></div>
                        </button>
                    </div> <!-- col .// -->
                </div>

                <div class="row gx-3 ">
                    <div class="col-2 col-lg-2 col-md-2 mb-3 align-self-center">
                        <label class="form-label">Facebook <small>(Link only)</small></label>
                    </div> <!-- col .// -->
                    <div class="col-4 col-lg-4 col-md-4 mb-3 align-self-center">
                            <input class="form-control" type="url" value="{{$social->facebook}}" name="facebook" placeholder="www.facebook.com/yourpage">
                    </div> <!-- col .// -->
                    <div class="col-2 col-lg-2 col-md-2 mb-3 align-self-center">
                        <button type="button" class="btn btn-toggle active" data-bs-toggle="button" aria-pressed="true" autocomplete="off">
                            <div class="handle"></div>
                        </button>
                    </div> <!-- col .// -->
                </div>

                <div class="row gx-3 ">
                    <div class="col-2 col-lg-2 col-md-2 mb-3 align-self-center">
                        <label class="form-label">Instagram <small>(Link only)</small></label>
                    </div> <!-- col .// -->
                    <div class="col-4 col-lg-4 col-md-4 mb-3 align-self-center">
                        <input class="form-control" type="url" value="{{$social->instragram}}" name="instragram"  placeholder="Type here">
                    </div> <!-- col .// -->
                    <div class="col-2 col-lg-2 col-md-2 mb-3 align-self-center">
                        <button type="button" class="btn btn-toggle active" data-bs-toggle="button" aria-pressed="true" autocomplete="off">
                            <div class="handle"></div>
                        </button>
                    </div> <!-- col .// -->
                </div>

                <div class="row gx-3 ">
                    <div class="col-2 col-lg-2 col-md-2 mb-3 align-self-center">
                        <label class="form-label">LinkedIn <small>(Link Only.)</small></label>
                    </div> <!-- col .// -->
                    <div class="col-4 col-lg-4 col-md-4 mb-3 align-self-center">
                        <input class="form-control" type="text" value="" name="linkedIn" placeholder="LinkednIn link here.">
                    </div> <!-- col .// -->
                    <div class="col-2 col-lg-2 col-md-2 mb-3 align-self-center">
                        <button type="button" class="btn btn-toggle active" data-bs-toggle="button" aria-pressed="true" autocomplete="off">
                            <div class="handle"></div>
                        </button>
                    </div> <!-- col .// -->
                </div>

                <div class="row gx-3 ">
                    <div class="col-2 col-lg-2 col-md-2 mb-3 align-self-center">
                        <label class="form-label">YouTube <small>(Link only)</small></label>
                    </div> <!-- col .// -->
                    <div class="col-4 col-lg-4 col-md-4 mb-3 align-self-center">
                            <input class="form-control" type="url" value="{{$social->youtube}}" name="youtube" placeholder="YouTube">
                    </div> <!-- col .// -->
                    <div class="col-2 col-lg-2 col-md-2 mb-3 align-self-center">
                        <button type="button" class="btn btn-toggle active" data-bs-toggle="button" aria-pressed="true" autocomplete="off">
                            <div class="handle"></div>
                        </button>
                    </div> <!-- col .// -->
                </div>

                <div class="row gx-3 ">
                    <div class="col-2 col-lg-2 col-md-2 mb-3 align-self-center">
                        <label class="form-label">Twitter <small>(Link only)</small></label>
                    </div> <!-- col .// -->
                    <div class="col-4 col-lg-4 col-md-4 mb-3 align-self-center">
                            <input class="form-control" type="url" value="" name="twitter" placeholder="Twitter/X link here.">
                    </div> <!-- col .// -->
                    <div class="col-2 col-lg-2 col-md-2 mb-3 align-self-center">
                        <button type="button" class="btn btn-toggle active" data-bs-toggle="button" aria-pressed="true" autocomplete="off">
                            <div class="handle"></div>
                        </button>
                    </div> <!-- col .// -->
                </div>
                <br>
                <button class="btn btn-primary" type="submit">Save </button>
            </form>
            <hr class="my-5">
            </div> <!-- card-body end// -->
        </div> <!-- card end// -->
    </div>
</div>

@endsection
