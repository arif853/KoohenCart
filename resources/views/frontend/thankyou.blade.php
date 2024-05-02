@extends('layouts.home')
@section('title','Thank You')
@section('main')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap');
    .checkmark{
        color: #19b34f;
        /* color: #fff; */
        font-size: 70px;
    }
    .th-text{
        position: relative;
        /* font-family: "Dancing Script", cursive; */
        /* font-optical-sizing: auto;
        font-style: normal; */
    }
    .th-text::after{
        content: '';
        position: absolute;
        left: 0;
        bottom: -10px;
        width: 100%;
        height: 2px;
        background-color: #FF8B13
    }
    .hero-content h1 {
        font-family: "Dancing Script", cursive;
        font-size: 75px;
        font-optical-sizing: auto;
        font-style: normal;
        letter-spacing: 10px;
    }
</style>
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route('home')}}" rel="nofollow">Home</a>
                <span></span> Thank you
            </div>
        </div>
    </div>
    <section class="hero-2 bg-green">
        <div class="hero-content">
            <div class="container">
                <div class="text-center">
                    <h2 class=" mb-20 checkmark">
                        <i class="fas fa-check-circle"></i>
                    </h2>
                    <h1 class="mb-20 wow fadeIn animated font-xxl fw-900">
                        Thank <span class="text-style-1">You</span>
                    </h1>
                    <p class="w-50 m-auto mb-50 wow fadeIn animated th-text">
                        Please check your email for further update.
                    </p>
                    <p class="wow fadeIn animated">
                        <a class="btn btn-brand btn-lg font-weight-bold text-white border-radius-5 btn-shadow-brand hover-up" href="{{route('home')}}">Back to home</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Add the dataLayer script with dynamic values -->
<script>
    dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
    dataLayer.push({
        event: "purchase",
        ecommerce: @json(session('purchaseEventData')) // Serialize the PHP array to JSON
    });
</script>
@endsection
