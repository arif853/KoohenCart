@extends('layouts.home')
@section('title','Delivery Information')
@section('main')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="{{route('home')}}" rel="nofollow">Home</a>
                    <span></span> Pages
                    <span></span> Delivery Information
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="single-page pr-30">
                            <div class="single-header style-2">
                                <h2>{{ $delivery_info->title }}</h2>
                            </div>
                            <div class="single-content">
                                {!! $delivery_info->description !!}
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
    </main>

@endsection

