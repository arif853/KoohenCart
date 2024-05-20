
@extends('layouts.home')
@section('title', 'About us')
@section('main')
    <main class="main single-page">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{url('/')}}" rel="nofollow">Home</a>
                    <span></span> About us
                </div>
            </div>
        </div>
        <section class="section-padding">
            <div class="container pt-25">
                <div class="row">
                    <div class="col-lg-12 align-self-center mb-lg-0 mb-4">
                        <h6 class="mt-0 mb-15 text-uppercase font-sm text-brand wow fadeIn animated">Our Company</h6>
                        <h1 class="font-heading mb-40">
                            {{$aboutus->title}}
                        </h1>
                        <p>
                            {!! $aboutus->about_desc !!}
                        </p>
                    </div>
                    {{-- <div class="col-lg-6">
                        <img src="{{asset('frontend/assets/imgs/page/about-1.png')}}" alt="">
                    </div> --}}
                </div>
            </div>
        </section>
    </main>
@endsection

