<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    @php
        $tags = DB::table('product_tags')->distinct()->pluck('tag')->implode(', ');
        $description = DB::table('settings')->pluck('company_short_details')->first();
        // echo $description;
    @endphp
    <meta name="description" content="{{$description}}">
    <meta name="keywords" content="{{$tags}}">
    <meta name=”robots” content="index, follow">
    <meta name="author" content="{{ config('app.name') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google / Search Engine Tags -->
    <meta itemprop="name" content="{{ config('app.name') }}">
    <meta itemprop="description" content="{{$description}}">
    <meta itemprop="image" content="{{asset('frontend/assets/imgs/favicon_128x128.ico')}}">

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ config('app.name') }}">
    <meta property="og:description" content="{{$description}}">
    <meta property="og:image" content="{{asset('frontend/assets/imgs/favicon_128x128.ico')}}">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="">
    <meta name="twitter:title" content="{{ config('app.name') }}">
    <meta name="twitter:description" content="{{$description}}">
    <meta name="twitter:image" content="{{asset('frontend/assets/imgs/favicon_128x128.ico')}}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - Koohen | YOUR ULTIMATE LIFESTYLE</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/assets/imgs/favicon_128x128.ico')}}">
    <!--Font-->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">

    <link href="{{asset('frontend/assets/notifications/notification.css')}}" rel="stylesheet" />

	<link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/vendors/animate.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/vendor/slick/slick.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/vendor/jquery.countdown/css/jquery.countdown.css')}}">

    {{-- sweet alert --}}
    <link rel="stylesheet" href="{{asset('admin/assets/css/vendors/sweetalert2.min.css')}}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('/')}}frontend/assets/css/main.css?v=3.4">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/helper.css')}}">

    <!--Font-->
    @livewireStyles
</head>

<body>

    <header class="header-area header-style-4 header-height-2">
        <!--Top Header-->
        <div class="header-top header-top-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info">
                            @php
                                $settings = DB::table('settings')->first();
                            @endphp
                            <ul>
                                <li><i class="far fa-phone-alt"></i> <a href="tel:{{$settings->secondary_mobile_no}}">{{$settings->secondary_mobile_no}}</a></li>
                                <li><i class="fal fa-envelope"></i><a  href="mailto:{{$settings->email}}">{{$settings->email}}</a></li>
                            </ul>
                        </div>
                    </div>
                    <!--Top Offer Notice-->
                    <div class="col-xl-6 col-lg-4">
                        <div class="text-center">
                            <div id="news-flash" class="d-inline-block">
                                @php
                                    $offers = DB::table('offers')->get();
                                @endphp
                                <ul>
                                    @foreach ($offers as $offer)
                                    <li>{{$offer->offer_name}}<a href="{{route('offer',['id'=>$offer->id])}}" class="ml-5">View details</a></li>
                                    @endforeach
                                    {{-- <li>Supper Value Deals - Save more with coupons</li>
                                    <li>Trendy 25silver jewelry, save up 35% off today <a href="shop-grid-right.html">Shop now</a></li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                    <style>
                        .dropdown:hover>.dropdown-menu {
                            display: block;
                        }

                        .dropdown>.dropdown-toggle:active {
                        /*Without this, clicking will make it sticky*/
                            pointer-events: none;
                        }
                    </style>
                    <!--Top Offer Notice-->
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info header-info-right">
                            <ul>
                                <li>
                                    <a class="language-dropdown-active" href="{{route('trackorder')}}"> <i class="fi-rs-world"></i> Track My Order</a>
                                </li>
                                <li>
                                    <i class="fi-rs-user"></i>
                                    @auth('customer')
                                        @php
                                        $user = Auth::guard('customer')->user();
                                        $fullName = $user->customer->firstName . ' ' . $user->customer->lastName;
                                        @endphp
                                    <a class="customer_info " href="{{route('customer.dashboard')}}" >{{ $fullName }}</a>
                                    @else
                                        {{-- Show login/register links --}}
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#login">Log In / </a>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#signup"> Sign Up</a>
                                    @endauth
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Top Header-->
        {{-- <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="header-wrap">
                    <div class="logo logo-width-1">
                        <a href="index.html"><img src="{{asset('')}}frontend/assets/imgs/Kohen_Logo_Main.png" alt="logo"></a>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="header-bottom header-bottom-bg-color sticky-bar" style="padding-top: 10px; padding-bottom: 4px;">
            <div class="container">
                <div class="header-wrap header-space-between position-relative">
                    <div class="logo logo-width-1 d-block d-lg-none">
                        <a href="{{route('home')}}"><img src="{{asset('')}}frontend/assets/imgs/Kohen_Logo_Main.png" alt="logo"></a>
                    </div>
                    <div class="logo logo-width-1 d-block d-sm-none">
                        <a href="{{route('home')}}"><img src="{{asset('')}}frontend/assets/imgs/Kohen_Logo_Main.png" alt="logo"></a>
                    </div>

                    <div class="header-nav d-none d-lg-flex" id="header-nav">

                        <!--Main Menu Bar-->
                        <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block">
                            <nav>
                                <ul>
                                    <li>
                                        <a class="{{ request()->is('/') ? 'active' : '' }}" href="{{('/')}}">Home</a>
                                    </li>
                                    <li>
                                        <a class="{{ request()->is('shop') ? 'active' : '' }}" href="{{route('shop')}}">Shop</a>
                                    </li>
                                    <li>
                                        <a class="{{ request()->is('aboutus') ? 'active' : '' }}" href="{{route('aboutus')}}">About Us</a>
                                    </li>
                                    <li>
                                        <a class="{{ request()->is('contactus') ? 'active' : '' }}" href="{{route('contactus')}}">Contact Us</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <!--Main Menu Bar-->
                    </div>
                    <style>

                    </style>
                    <div class="hotline d-none d-lg-block">
                        <div class="header-action-2 header">
                            {{-- <span id="form-open" class="search-toggle">
                                <i class="fal fa-search"></i>
                            </span> --}}
                            <div class="searchbar">
                                <i class="fa fa-search" aria-hidden="true"></i>
                                 <div class="togglesearch">
                                    <span class="input-search-icon" id=""><i class="fa fa-search" aria-hidden="true"></i></span>
                                    <input type="text" id="search-input" name="product_search" placeholder=" Search product by name or sku."/>
                                    {{-- <input type="button" value="Search"/> --}}
                                    <div id="loading-indicator" style="display: none; ">
                                        Loading...
                                    </div>
                                    <div class="show-product" id="show-product" style="display: none">
                                        <ul>
                                            <li>
                                                <a href="#">
                                                    <div class="item_img">
                                                        <img src="{{asset('frontend/assets/imgs/shop/w-product-3.webp')}}" alt="Product Image" width="60px" >
                                                    </div>
                                                    <div class="item_tile">
                                                        <h4 class="product_title">Product 1</h4>
                                                        <p class="text-sm">Price: 1250.00</p>
                                                    </div>
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>

                            </div>

                            @livewire('wishlist-icon-component')

                            @livewire('cart-icon-component')

                        </div>
                    </div>
                    {{-- <p class="mobile-promotion">Happy <span class="text-brand">Mother's Day</span>. Big Sale Up to 40%</p> --}}
                    <div class="header-action-right d-block d-lg-none">
                        <div class="header-action-2">
                            <div class="searchbar">
                                <i class="fa fa-search" aria-hidden="true"></i>
                                 <div class="togglesearch">
                                    <span class="input-search-icon" id=""><i class="fa fa-search" aria-hidden="true"></i></span>
                                    <input type="text" id="search-input2" name="product_search" placeholder=" Search product by name or sku."/>
                                    {{-- <input type="button" value="Search"/> --}}
                                    <div id="loading-indicator" style="display: none; ">
                                        Loading...
                                    </div>
                                    <div class="show-product" id="show-product2" style="display: none">
                                        <ul>
                                            <li>
                                                <a href="#">
                                                    <div class="item_img">
                                                        <img src="{{asset('frontend/assets/imgs/shop/w-product-3.webp')}}" alt="Product Image" width="60px" >
                                                    </div>
                                                    <div class="item_tile">
                                                        <h4 class="product_title">Product 1</h4>
                                                        <p class="text-sm">Price: 1250.00</p>
                                                    </div>
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>

                            </div>
                            @livewire('wishlist-icon-component')
                            @livewire('cart-icon-component')

                            <div class="header-action-icon-2 d-block d-lg-none">
                                <div class="burger-icon burger-icon-white">
                                    <span class="burger-icon-top"></span>
                                    <span class="burger-icon-mid"></span>
                                    <span class="burger-icon-bottom"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="mobile-header-active mobile-header-wrapper-style">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top">
                <div class="mobile-header-logo">
                    <a href="{{route('home')}}"><img src="{{asset('')}}frontend/assets/imgs/Kohen_Logo_Main.png" alt="logo"></a>
                </div>
                <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                    <button class="close-style search-close">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>
            <div class="mobile-header-content-area">
                {{-- <div class="mobile-search search-style-3 mobile-header-border">
                    <form action="#">
                        <input type="text" placeholder="Search for items…">
                        <button type="submit"><i class="fi-rs-search"></i></button>
                    </form>
                </div> --}}
                <div class="mobile-menu-wrap mobile-header-border">

                    <!-- mobile menu start -->
                    <nav>
                        <ul class="mobile-menu">
                            <li class="menu-item-has-children">
                                <span class="menu-expand"></span>
                                <a class="{{ request()->is('/') ? 'active' : '' }}" href="{{route('home')}}">Home</a>
                            </li>
                            <li class="menu-item-has-children">
                                <span class="menu-expand"></span>
                                <a class="{{ request()->is('shop') ? 'active' : '' }}" href="{{route('shop')}}">Shop</a>
                            </li>
                            <li class="menu-item-has-children">
                                <span class="menu-expand"></span>
                                <a class="{{ request()->is('aboutus') ? 'active' : '' }}" href="{{route('aboutus')}}">About Us</a>
                            </li>
                            <li class="menu-item-has-children">
                                <span class="menu-expand"></span>
                                <a class="{{ request()->is('contactus') ? 'active' : '' }}" href="{{route('contactus')}}">Contact Us</a>
                            </li>
                        </ul>
                    </nav>
                    <!-- mobile menu end -->
                </div>
                <div class="mobile-header-info-wrap mobile-header-border">

                    <div class="single-mobile-header-info">
                        @auth('customer')
                        <i class="fi-rs-user"></i>
                            @php
                            $user = Auth::guard('customer')->user();
                            $fullName = $user->customer->firstName . ' ' . $user->customer->lastName;
                            @endphp

                            <a class="customer_info " href="{{route('customer.dashboard')}}" >{{ $fullName }}</a>

                            {{-- <div class="dropdown">
                                <a class="customer_info dropdown-toggle" href="#"  id="dropdownMenuButton"
                                data-mdb-toggle="dropdown"
                                aria-expanded="false">{{ $fullName }}</a>

                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="{{route('customer.dashboard')}}">Profile</a></li>
                                    <li>
                                        <a class="dropdown-item" href="#" onclick="document.getElementById('logout_form').submit();">Logout</a>
                                        <form method="post" id="logout_form" action="{{ route('customer.logout') }}">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                              </div> --}}

                        @else
                            {{-- Show login/register links --}}
                            <a href="#" data-bs-toggle="modal" data-bs-target="#login" style="display: inline">Log In / </a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#signup" style="display: inline"> Sign Up</a>
                        @endauth
                    </div>
                    <div class="single-mobile-header-info">
                        <a href="tel:{{ $settings->secondary_mobile_no }}">{{ $settings->secondary_mobile_no }}</a>
                    </div>
                    <div class="single-mobile-header-info mt-30">
                        <a  href="{{route('contactus')}}"> Our location: <p>{{ $settings->company_address }}</p></a>
                    </div>
                </div>
                <div class="mobile-social-icon">
                    <h5 class="mb-15 text-grey-4">Follow Us</h5>
                    <a href="#"><img src="{{asset('')}}frontend/assets/imgs/theme/icons/icon-facebook.svg" alt=""></a>
                    <a href="#"><img src="{{asset('')}}frontend/assets/imgs/theme/icons/icon-twitter.svg" alt=""></a>
                    <a href="#"><img src="{{asset('')}}frontend/assets/imgs/theme/icons/icon-instagram.svg" alt=""></a>
                    <a href="#"><img src="{{asset('')}}frontend/assets/imgs/theme/icons/icon-pinterest.svg" alt=""></a>
                    <a href="#"><img src="{{asset('')}}frontend/assets/imgs/theme/icons/icon-youtube.svg" alt=""></a>
                </div>
            </div>
        </div>
    </div>
        {{-- @if($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}
        @if(View::hasSection('main'))
            @yield('main')
        @else
            {{ $slot }}
        @endif

    <footer class="main">
        <section class="newsletter p-30 text-white wow fadeIn animated">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-8 mb-md-3 mb-lg-0">
                        <div class="row align-items-center">
                            <div class="col flex-horizontal-center">
                                <h5 class="subscribe-text">Get Offers, Discounts and More.</h5>
                            </div>
                            <div class="col my-4 my-md-0 des">
                                <h4 class="newsletter-text mb-0 ml-3">SIGN UP FOR OUR NEWSLETTER</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <!-- Subscribe Form -->
                        <form class="form-subcriber d-flex wow fadeIn animated">
                            <input type="email" class="form-control bg-white font-small" placeholder="Enter your email">
                            <button class="btn text-white" type="submit">Subscribe</button>
                        </form>
                        <!-- End Subscribe Form -->
                    </div>
                </div>
            </div>
        </section>
        <style>
            .footer-list li a span{
                font-size: 17px;
                margin-right: 8px
            }
        </style>
        <section class="section-padding footer-mid">
            <div class="container pt-15 pb-20">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <div class="widget-about font-md mb-md-5 mb-lg-0">
                            <div class="logo logo-width-1 wow fadeIn animated">
                                <a href="index.html"><img src="{{asset('frontend/assets/imgs/Kohen_Logo_Main.png')}}" alt="logo"></a>
                            </div>
                            <p class="footer-desc">{{$settings->company_short_details}}</p>

                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <h5 class="widget-title wow fadeIn animated">Contact</h5>
                        <ul class="footer-list wow fadeIn animated mb-sm-5 mb-md-0">
                            <li>
                                <a href="https://wa.link/3qi05h"><span><i class="fab fa-whatsapp"></i></span> {{ $settings->primary_mobile_no }}</a>

                            </li>
                            <li><a href="tel:{{ $settings->secondary_mobile_no }}"><span><i class="fal fa-phone-alt"></i></span> {{ $settings->secondary_mobile_no }}</a></li>
                            <li><a href="mailto:{{ $settings->email }}"><span><i class="fal fa-envelope"></i></span> {{ $settings->email }}</a></li>
                            <li><a href="#"><span><i class="fal fa-map-marker-alt"></i></span> {{ $settings->company_address }}</a></li>

                        </ul>
                        <h5 class="mb-10 mt-30 fw-600 text-grey-4 wow fadeIn animated">Follow Us</h5>
                            <div class="mobile-social-icon wow fadeIn animated mb-sm-5 mb-md-0">
                                <a href="#"><img src="{{asset('frontend/assets/imgs/theme/icons/icon-facebook.svg')}}" alt=""></a>
                                <a href="#"><img src="{{asset('frontend/assets/imgs/theme/icons/icon-twitter.svg')}}" alt=""></a>
                                <a href="#"><img src="{{asset('frontend/assets/imgs/theme/icons/icon-instagram.svg')}}" alt=""></a>
                                <a href="#"><img src="{{asset('frontend/assets/imgs/theme/icons/icon-pinterest.svg')}}" alt=""></a>
                                <a href="#"><img src="{{asset('frontend/assets/imgs/theme/icons/icon-youtube.svg')}}" alt=""></a>
                            </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <h5 class="widget-title wow fadeIn animated">Usefull Links</h5>
                        <ul class="footer-list wow fadeIn animated">
                            <li><a href="{{url('/delivery_information')}}">Delivery Information</a></li>
                            {{-- <li><a href="{{url('/terms-and-condition')}}">Terms & Conditions</a></li> --}}
                            <li><a href="{{url('/privacy_and_policy')}}">Privacy Policy</a></li>
                            <li><a href="{{url('/cancellation_and_return')}}">Cancellation & Return</a></li>
                            {{-- <li><a href="#">FAQS</a></li> --}}
                            <li><a href="{{route('trackorder')}}">Track My Order</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <h5 class="widget-title wow fadeIn animated">Trusted member of - </h5>
                        <a href="https://e-cab.net"><img src="{{asset('frontend/assets/imgs/ecab.png')}}" alt="ecab" width="80px"></a>
                        <div class="row">
                            <div class="col-md-4 col-lg-12 mt-md-3 mt-lg-3">
                                <p class="mb-20 wow fadeIn animated">Secured Payment Gateways</p>
                                <img class="wow fadeIn animated" src="{{asset('frontend/assets/imgs/pay_image.png')}}" alt="pay_image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container pb-20 wow fadeIn animated">
            <div class="row">
                <div class="col-12 mb-20">
                    <div class="footer-bottom"></div>
                </div>
                <div class="col-lg-6">
                    <p class="float-md-left font-sm text-muted mb-0 d-flex">&copy;
                    <script>document.write(new Date().getFullYear())</script> ,
                    <strong class="text-brand mr-10 ml-10">
                        <img width="40" src="{{asset('frontend/assets/imgs/Kohen_Logo_Main.png')}}" alt="logo">
                    </strong><span style="text-transform:uppercase"> - Your ultimate Lifestyle.</span> </p>
                </div>
                <div class="col-lg-6">
                    <p class="text-lg-end text-start font-sm text-muted mb-0">
                        Developed by <a href="https://qbit-tech.com/" target="_blank">QBitTech </a>. All rights reserved
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <livewire:quick-view-component />


    <!-- Preloader Start -->
    <!--<div id="preloader-active">-->
    <!--    <div class="preloader d-flex align-items-center justify-content-center">-->
    <!--        <div class="preloader-inner position-relative">-->
    <!--            <div class="text-center">-->
    <!--                <h5 class="mb-10">Now Loading</h5>-->
    <!--                <div class="loader">-->
    <!--                    <div class="bar bar1"></div>-->
    <!--                    <div class="bar bar2"></div>-->
    <!--                    <div class="bar bar3"></div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->


    @include('auth.registermodal')

    @include('auth.loginmodal')


    <!-- Vendor JS-->
    <script src="{{asset('')}}frontend/assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="{{asset('')}}frontend/assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="{{asset('')}}frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="{{asset('')}}frontend/assets/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="{{asset('')}}frontend/assets/js/plugins/slick.js"></script>
    <script src="{{asset('')}}frontend/assets/js/plugins/jquery.syotimer.min.js"></script>
    <script src="{{asset('')}}frontend/assets/js/plugins/wow.js"></script>
    <script src="{{asset('')}}frontend/assets/js/plugins/jquery-ui.js"></script>
    <script src="{{asset('')}}frontend/assets/js/plugins/perfect-scrollbar.js"></script>
    <script src="{{asset('')}}frontend/assets/js/plugins/magnific-popup.js"></script>
    <script src="{{asset('')}}frontend/assets/js/plugins/select2.min.js"></script>
    <script src="{{asset('')}}frontend/assets/js/plugins/waypoints.js"></script>
    <script src="{{asset('')}}frontend/assets/js/plugins/counterup.js"></script>
    <script src="{{asset('')}}frontend/assets/js/plugins/jquery.countdown.min.js"></script>
    <script src="{{asset('')}}frontend/assets/js/plugins/images-loaded.js"></script>
    <script src="{{asset('')}}frontend/assets/js/plugins/isotope.js"></script>
    <script src="{{asset('')}}frontend/assets/js/plugins/scrollup.js"></script>
    <script src="{{asset('')}}frontend/assets/js/plugins/jquery.vticker-min.js"></script>
    <script src="{{asset('')}}frontend/assets/js/plugins/jquery.theia.sticky.js"></script>
    <script src="{{asset('')}}frontend/assets/js/plugins/jquery.elevatezoom.js"></script>
    <script src="{{asset('frontend/assets/notifications/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('frontend/assets/notifications/notifications.js')}}"></script>
	{{-- <script src="{{asset('frontend/assets/vendor/slick/slick.min.js')}}"></script> --}}
    <script src="{{asset('frontend/assets/js/vendor/slick-custom.js')}}"></script>
    <script src="{{asset('frontend/assets/js/vendor/moment.js')}}"></script>
    <script src="{{asset('frontend/assets/js/vendor/moment-with-locales.js')}}"></script>

    <script src="{{asset('frontend/assets/vendor/jquery.countdown/js/jquery.plugin.min.js')}}"></script>
    <script src="{{asset('frontend/assets/vendor/jquery.countdown/js/jquery.countdown.js')}}"></script>
    {{-- sweet alert --}}
    <script src="{{asset('admin/assets/js/vendors/sweetalert2.all.min.js')}}"></script>
    <!-- Template  JS -->
    <script src="{{asset('')}}frontend/assets/js/main.js?v=3.4"></script>
    <script src="{{asset('')}}frontend/assets/js/shop.js?v=3.4"></script>


    @stack('dashboard')
    @stack('checkout')
    @stack('shop')
    @stack('camp')
    @stack('order')
    @livewireScripts

<script>


    $(document).on('click', '.quickview', function (e) {

        e.preventDefault();
        var Slug = $(this).data('product-slug');
        console.log(Slug);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '{{url('/home/quickview')}}',
            method: 'GET',
            data: {
                slug: Slug,
            },
            success: function (response) {
                console.log(response);
                $('#p_name').text(response.product_name);
                $('#brand_name').text(response.brand.brand_name);

                $('#product_price').empty();
                if(response.product_price.offer_price > 0){
                    var row = '<ins><span class="text-brand">৳'+response.product_price.offer_price +'</span></ins>'+
                    '<ins><span class="old-price font-md ml-15">৳'+response.regular_price+'</span></ins>'+
                    '<span class="save-price  font-md color3 ml-15">'+ response.product_price.percentage +'% Off</span>';
                    $('#product_price').append(row);
                }
                else{
                    var row = '<ins><span class="text-brand">৳'+ response.regular_price +'</span></ins>';
                    $('#product_price').append(row);
                }

                $("#overview").empty();

                $.each(response.overviews, function (index, overview) {
                    var li = '<li><span>' + overview.overview_name + '</span>' + overview.overview_value + '</li>';
                    $("#overview").append(li);
                });

                $("#color").empty();

                $.each(response.colors, function(index, color){
                    var li = $('<li><a href="#" data-color="'+color.color_name+'"><span class="'+color.color_code+'" style="background-color:'+color.color_code+'"></span></a></li>');

                    li.find('a').click(function() {
                        // Remove "active" class from all list items
                        $("#color li").removeClass("active");

                        // Add "active" class to the parent list item
                        $(this).parent().addClass("active");
                    });

                    $("#color").append(li);
                })

                $("#size").empty();

                $.each(response.sizes, function(index, size) {
                    var li = $('<li><a href="#">' + size.size + '</a></li>');

                    // Add a click event handler to the anchor tag inside the list item
                    li.find('a').click(function() {
                        // Remove "active" class from all list items
                        $("#size li").removeClass("active");

                        // Add "active" class to the parent list item
                        $(this).parent().addClass("active");
                    });

                    // Append the list item to the #size element
                    $("#size").append(li);
                });

                $("#product_sku").text(response.sku);
                $("#stock").text(response.stock + ' Items In Stock');

                $("#tags").empty();
                $("#tags").html('Tags: ');
                $.each(response.tags, function(index, tag){
                    var a = '<a href="#" rel="tag">'+ tag.tag+'</a>,';
                    $("#tags").append(a);
                });

                Livewire.dispatch('buyNow', response.product_id);

                // $(".slider-nav-thumbnails").empty();

                // $.each(response.product_images, function(index, image){
                //     var baseUrl = "{{ asset('storage/product_images/') }}";
                //     var imageUrl = baseUrl + '/' + image.product_image;
                //     var image_Div = '<div><img src="' + imageUrl + '" alt="'+response.slug+'"></div>';
                //     $(".slider-nav-thumbnails").append(image_Div);


                // });
                //     $(".product-image-slider").slick();

                //     // $('.slider-nav-thumbnails').slick();
                //     $(".slider-nav-thumbnails").slick({
                //         slidesToShow: 4,
                //         slidesToScroll: 1,
                //         asNavFor: '.product-image-slider',
                //         dots: false,
                //         centerMode: false,
                //         focusOnSelect: true
                //     });

                $(".product-image-slider").empty();
                if (response.product_thumbnail && response.product_thumbnail.length > 0) {
                    var baseUrl = "{{ asset('storage/product_images/thumbnail/') }}";
                    var imageUrl = baseUrl + '/' + response.product_thumbnail[0].product_thumbnail;

                    var imageDiv = '<figure class="border-radius-10" >' +
                                        '<img src="' + imageUrl + '" alt="' + response.slug + '">' +
                                    '</figure>';

                    $(".product-image-slider").append(imageDiv);
                }


                // const outputImage = document.getElementById('output-image2');
                // outputImage.src = "{{asset('storage')}}"+'/'+response.image
            }
        });
    });

    $(document).ready(function() {

        $(".fa-search").click(function() {
            $(".togglesearch").toggle();
            $("input[type='text']").focus();
        });

        // var searchInput = $('#search-input');


        function searchHandel(searchInput, showProductDiv) {

            var loadingIndicator = $('#loading-indicator');
            var searchTerm = searchInput.val().trim();
            console.log(searchTerm);

            // Check if the search term is not empty
            if (searchTerm !== '') {
                // Show loading indicator
                loadingIndicator.show();

                $.ajax({
                    url: "{{ route('search') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        search: searchTerm
                    },
                    success: function(data) {
                        console.log(data);
                        var ul = showProductDiv.find('ul');
                        ul.empty();

                        if (data.products.length === 0) {
                            ul.append('<li>No products found</li>');
                        } else {
                            data.products.forEach(function(product) {
                                var imageUrl = '{{asset('storage/product_images/thumbnail/')}}'+'/'+product.product_thumbnail[0].product_thumbnail;
                                var slug = product.slug;
                                var productUrl = '{{ url('products') }}'+ '/'+ slug;
                                // console.log(slug);
                                // console.log(productUrl);
                                var li = $('<li>'+
                                    '<a href="'+productUrl+'">'+
                                    '<div class="item_img">'+
                                    '<img src="'+imageUrl+'" alt="'+product.slug+'" width="60px" >'+
                                    '</div>'+
                                    '<div class="item_tile">'+
                                    '<h4 class="product_title">'+product.product_name+'</h4>'+
                                    '<p class="text-sm">Price: ৳'+product.regular_price+'</p>'+
                                    '<p class="text-sm">'+product.sku+'</p>'+
                                    '</div>'+
                                    '</a>'+
                                    '</li>');

                                ul.append(li);
                            });
                            console.log(ul);
                        }

                        // Hide loading indicator after displaying results
                        loadingIndicator.hide();
                        // Show the product div
                        showProductDiv.show();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching product suggestions:', error);
                        // Hide loading indicator on error
                        loadingIndicator.hide();
                    }
                });
            } else {
                // Hide the product div if the search term is empty
                showProductDiv.hide();
            }
        };

        // Call the function for each search input
        $('#search-input').keyup(function(event) {
            searchHandel($('#search-input'), $('#show-product'));
        });

        $('#search-input2').keyup(function(event) {
            searchHandel($('#search-input2'), $('#show-product2'));
        });
    });

</script>
    @if(Session::has('success'))
    <script>
        $.Notification.autoHideNotify('success', 'top right', 'Success', '{{ Session::get('success') }}');
    </script>
    @endif
    @if(Session::has('danger'))
        <script>
            $.Notification.autoHideNotify('danger', 'top right', 'Danger', '{{ Session::get('danger') }}');
        </script>
    @endif
    @if(Session::has('warning'))
    <script>
        $.Notification.autoHideNotify('warning', 'top right', 'Warning', '{{ Session::get('warning') }}');
    </script>
    @endif


</body>

</html>
