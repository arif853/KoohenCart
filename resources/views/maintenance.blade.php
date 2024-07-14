<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    @php
    $tags = DB::table('product_tags')->distinct()->pluck('tag')->implode(', ');
    // $description = DB::table('user-profile')->pluck('company_short_details')->first();
    $userData = DB::table('web_infos')->first();
    $seoData = DB::table('seo_settings')->first();
    $socialinfos = DB::table('socialinfos')->get();
    $contactinfo = DB::table('contactinfos')->first();
    // echo $description;
    @endphp
    <title>{{ config('app.name') }} | YOUR ULTIMATE LIFESTYLE</title>

    <meta name="description" content="{{$userData->description}}">
    <meta name="keywords" content="{{$tags}}">
    <meta name="robots" content="index, follow">
    <meta name="author" content="{{ config('app.name') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google / Search Engine Tags -->
    <meta itemprop="name" content="{{ config('app.name') }}">
    <meta itemprop="description" content="{{$userData->description}}">
    <meta itemprop="image" content="{{asset('storage/Seologos/'.$seoData->seoLogo)}}">

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ config('app.name') }}">
    <meta property="og:description" content="{{$userData->description}}">
    <meta property="og:image" content="{{asset('storage/Seologos/'.$seoData->seoLogo)}}">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="">
    <meta name="twitter:title" content="{{ config('app.name') }}">
    <meta name="twitter:description" content="{{$userData->description}}">
    <meta name="twitter:image" content="{{asset('storage/Seologos/'.$seoData->seoLogo)}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('storage/favicons/'.$userData->webfavicon)}}">
    <link rel="manifest" href="{{asset('sitemap.xml')}}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/main.css?v=3.4')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/helper.css')}}">

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #000;
        }

        * {
            box-sizing: border-box;
        }

        .maintenance {
            background-image: url({{asset('frontend/assets/main-1.jpg')}});
            background-repeat: no-repeat;
            background-position: center center;
            background-attachment: scroll;
            background-size: cover;
        }

        .maintenance {
            width: 100%;
            height: 100%;
            min-height: 100vh;
        }

        .maintenance {
            display: flex;
            flex-flow: column nowrap;
            justify-content: center;
            align-items: center;
        }

        .maintenance_contain {
            display: flex;
            flex-direction: column;
            flex-wrap: nowrap;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 15px;
        }

        .maintenance_contain .image1 {
            width: auto;
            max-width: 100%;
        }

        .pp-infobox-title-prefix {
            font-weight: 500;
            font-size: 20px;
            color: #000000;
            margin-top: 30px;
            text-align: center;
        }

        .pp-infobox-title-prefix {
            font-family: sans-serif;
        }

        .pp-infobox-title {
            color: #000000;
            font-family: sans-serif;
            font-weight: 700;
            font-size: 40px;
            margin-top: 10px;
            margin-bottom: 10px;
            text-align: center;
            display: block;
            word-break: break-word;
        }

        .pp-infobox-description {
            color: #000000;
            font-family: "Poppins", sans-serif;
            font-weight: 400;
            font-size: 18px;
            margin-top: 0px;
            margin-bottom: 0px;
            text-align: center;
        }

        .pp-infobox-description p {
            margin: 0;
        }

        .title-text.pp-primary-title {
            color: #000000;
            padding-top: 0px;
            padding-bottom: 0px;
            padding-left: 0px;
            padding-right: 0px;
            font-family: sans-serif;
            font-weight: 500;
            font-size: 18px;
            line-height: 1.4;
            margin-top: 50px;
            margin-bottom: 0px;
        }

        .pp-social-icon {
            margin-left: 10px;
            margin-right: 10px;
            display: inline-block;
            line-height: 0;
            margin-bottom: 10px;
            margin-top: 10px;
            text-align: center;
        }

        .pp-social-icon a {
            display: inline-block;
            height: 40px;
            width: 40px;
        }

        .pp-social-icon a i {
            border-radius: 100px;
            font-size: 20px;
            height: 40px;
            width: 40px;
            line-height: 40px;
            text-align: center;
        }

        .pp-social-icon:nth-child(1) a i {
            color: #4b76bd;
        }

        .pp-social-icon:nth-child(1) a i {
            border: 2px solid #4b76bd;
        }

        .pp-social-icon:nth-child(2) a i {
            color: #00c6ff;
        }

        .pp-social-icon:nth-child(2) a i {
            border: 2px solid #00c6ff;
        }

        .pp-social-icon:nth-child(3) a i {
            color: #fb5245;
        }

        .pp-social-icon:nth-child(3) a i {
            border: 2px solid #fb5245;
        }

        .pp-social-icon:nth-child(4) a i {
            color: #158acb;
        }

        .pp-social-icon:nth-child(4) a i {
            border: 2px solid #158acb;
        }

        .pp-social-icons {
            display: flex;
            flex-flow: row wrap;
            align-items: center;
            justify-content: center;
        }

    </style>
</head>

<body>

    <div class="maintenance">
        <div class="maintenance_contain">
            <img class="image1" src="{{asset('frontend/assets/main-vector.png')}}" alt="maintenance">
            <span class="pp-infobox-title-prefix">WE ARE COMING SOON</span>
            <div class="pp-infobox-title-wrapper">
                <h3 class="pp-infobox-title">The website under maintenance!</h3>
            </div>
            <img src="{{asset('frontend/assets/49e9d662d2f99e8d945c8b21bd2cde85.gif')}}" alt="" width="100px">
            <div class="pp-infobox-description">
                <p>Our Technical team are working relentlessly and <br>will resolve this issue in a short time. <br> Thank you for visting us. </p>
            </div>
            <span class="title-text pp-primary-title">We are social</span>
            <div class="pp-social-icons pp-social-icons-center pp-responsive-center">
                <span class="pp-social-icon">
                    <link itemprop="url" href="#">
                    <a itemprop="sameAs" href="#" target="_blank" title="Facebook" aria-label="Facebook"
                        role="button">
                        <i class="fab fa-facebook"></i>
                    </a>
                </span>
                <span class="pp-social-icon">
                    <link itemprop="url" href="#">
                    <a itemprop="sameAs" href="#" target="_blank" title="Twitter" aria-label="Twitter"
                        role="button">
                        <i class="fab fa-twitter"></i>
                    </a>
                </span>
                <span class="pp-social-icon">
                    <link itemprop="url" href="#">
                    <a itemprop="sameAs" href="#" target="_blank" title="Google Plus" aria-label="Google Plus"
                        role="button">
                        <i class="fab fa-google-plus"></i>
                    </a>
                </span>
                <span class="pp-social-icon">
                    <a itemprop="sameAs" href="#" target="_blank" title="LinkedIn" aria-label="LinkedIn"
                        role="button">
                        <i class="fab fa-linkedin"></i>
                    </a>
                </span>
            </div>
        </div>
    </div>

    <!-- Vendor JS-->
    <script src="{{asset('')}}frontend/assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="{{asset('')}}frontend/assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="{{asset('')}}frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="{{asset('')}}frontend/assets/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="{{asset('')}}frontend/assets/js/plugins/waypoints.js"></script>

    <!-- Template  JS -->
    <script src="{{asset('')}}frontend/assets/js/main.js?v=3.4"></script>
    <script src="{{asset('')}}frontend/assets/js/shop.js?v=3.4"></script>

</body>

</html>
