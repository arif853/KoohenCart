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
                $socials = DB::table('socialinfos')->get();
            @endphp
            <form action="{{route('socialinfo.update')}}" method="post" >
                @csrf
                @method('POST')
                {{-- <input type="hidden" name="socialInfo_id" id="socialInfo_id" value="{{$social->id}}"> --}}
                @foreach ($socials as $key => $social)
                <div class="row gx-3 ">
                    <div class="col-2 col-lg-2 col-md-2 mb-3 align-self-center">
                        <label class="form-label">{{$social->social_title}}<span class="text-danger">*</span></label>
                    </div> <!-- col .// -->
                    <div class="col-4 col-lg-4 col-md-4 mb-3 align-self-center">
                        <input type="hidden" name="social_title[{{$key+1}}]" id="socialTitle_1" value="{{$social->social_title}}">
                        <input class="form-control" type="text" value="{{$social->title_value}}" name="title_value[{{$key+1}}]" placeholder="Type here">
                    </div> <!-- col .// -->
                    <div class="col-2 col-lg-2 col-md-2 mb-3 align-self-center">
                        {{-- <input type="checkbox" name="phone_status" id="phoneStatus" checked class="form-check "> --}}
                        <button type="button" onclick="UpdateStatus({{$social->id}})" class="btn btn-toggle {{$social->status == 1 ? 'active':'' }}"
                            data-bs-toggle="button" aria-pressed="{{$social->status == 1 ? 'true':'false' }}" >
                            <div class="handle"></div>
                        </button>
                    </div> <!-- col .// -->
                </div>
                @endforeach

                <br>
                <button class="btn btn-primary" type="submit">Save </button>
            </form>
            <hr class="my-5">
            </div> <!-- card-body end// -->
        </div> <!-- card end// -->
    </div>
</div>



@endsection
@push('transaction')
<script>

    function UpdateStatus(id){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '{{route('socialstatus.update')}}',
            method: 'post',
            data: {
                id: id,
            },
            success: function (response) {
                console.log(response);
                location.reload();
            }
        });
    }
</script>
@endpush
