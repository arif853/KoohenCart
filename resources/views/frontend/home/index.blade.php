@extends('layouts.home')
@section('title', 'Home')
@section('main')

<main class="main">
    <!--Main Slider-->
	<section class="section-slide">
		<div class="wrap-slick1">
			<div class="slick1">
			 @foreach ($sliders as $slider)
                <div class="item-slick1" style="background-image: url({{asset('storage/'.$slider->image)}});">
					<div class="container h-full">
						<div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
								<span class="ltext-101 cl2 respon2">
									{{$slider->subtitle}}
								</span>
							</div>

							<div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
								<h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
									{{$slider->title}}
								</h2>
							</div>

							<div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
								<a href="{{$slider->slider_url}}" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
									{{$slider->btntext}}
								</a>
							</div>
						</div>
					</div>
				</div>
                @endforeach

			</div>
		</div>
	</section>

    <!--Main Slider-->

    <!--New Arrival (OK)-->
    <section class="product-tabs section-padding position-relative wow fadeIn animated">
        <div class="container">
            <div class="text-center">
                <h3 class="section-title section-title-1 mb-20"><span>New</span> Arrivals</h3>
            </div>
                <div class="new-arrival">
                   @livewire('new-products-component')
                    <!--End product-grid-4-->
                </div>
            <!--End tab-content-->
            <div class="row mt-30">
                <div class="col-12 text-center">
                    <p class="wow fadeIn animated">
                        <a class="btn btn-brand text-white btn-shadow-brand hover-up btn-lg" href="{{route('shop')}}">Load More</a>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!--New Arrival (OK)-->

    <!--Advertise-->
    <section class="banner-2">
        <div class="container">
           @foreach ($adsbanner as $ads)
            @if($ads->is_featured == 1 && $ads->is_feature_no == 1)
            <div class="banner-img banner-big wow fadeIn animated f-none">
                <img src="{{asset('storage/'.$ads->image)}}" alt="$ads->title">
                <div class="banner-text d-md-block d-none">
                    <h4 class="mb-15 text-brand">{{$ads->header}}</h4>
                    <h1 class="fw-600 mb-20" style="width: 450px; color:#fff">{{$ads->title}}</h1>

                    @if($ads->shop_url != null)
                    <a href="{{$ads->shop_url}}" class="btn">Shop Now <i class="fi-rs-arrow-right"></i></a>
                    @endif
                </div>
            </div>
            @endif
            {{-- @break --}}
            @endforeach
        </div>
    </section>
    <!--Advertise-->

    <!--Category products (OK)-->
    @if($cat_feature)

    <section class="section-padding">
        <div class="container pt-25 pb-25">
            <div class="heading-tab d-flex">
                <div class="heading-tab-left wow fadeIn animated">
                    <?php
                    // Split the title into parts based on a delimiter (for example, a space)
                    $titleParts = explode(' ', $cat_feature->title);
                    ?>

                    <h3 class="section-title">
                        <span>{{ $titleParts[0] }}</span> {{ isset($titleParts[1]) ? $titleParts[1] : '' }}
                    </h3>

                </div>
                <a href="{{route('shop')}}" class="view-more d-none d-md-flex">View More<i class="fi-rs-angle-double-small-right"></i></a>
            </div>
            <div class="row">
                <div class="col-lg-3 d-none d-lg-flex">
                    <div class="banner-img style-2 wow fadeIn animated">
                        <img src="{{asset('storage/'.$cat_feature->image)}}" alt="{{$cat_feature->title}}">

                    </div>
                </div>
                <div class="col-lg-9 col-md-12">
                    <div class="category-view">
                        @livewire('feature-category-component')

                    </div>
                </div>
                <!--End Col-lg-9-->
            </div>
        </div>
    </section>
    <!--Best Sale (OK)-->

    @endif

     @if($campaign)

    <!--Campaign (OK)-->
    <section class="product-tabs section-padding position-relative wow fadeIn animated">
        <div class="container">

            @livewire('campaign-component')
        </div>
    </section>
    <!--Campaign (OK)-->

    @endif

    <!--Advertise-->
    <section class="banner-2">
        <div class="container">
             @foreach ($adsbanner as $ads)
                @if($ads->is_featured == 1 && $ads->is_feature_no == 2)
                <div class="banner-img banner-big wow fadeIn animated f-none">
                    <img src="{{asset('storage/'.$ads->image)}}" alt="$ads->title">
                    <div class="banner-text d-md-block d-none">
                        <h4 class="mb-15 text-brand">{{$ads->header}}</h4>
                        <h1 class="fw-600 mb-20" style="width: 450px; color:#fff">{{$ads->title}}</h1>

                        @if($ads->shop_url != null)
                        <a href="{{$ads->shop_url}}" class="btn">Shop Now <i class="fi-rs-arrow-right"></i></a>
                        @endif
                    </div>
                </div>

                @endif

            @endforeach
        </div>
    </section>
    <!--Advertise-->

    <!--All Products (OK)-->
    <section class="product-tabs section-padding position-relative wow fadeIn animated">
        <div class="container">
            @livewire('home-component')

            {{-- <button wire:click="loadMore">Clickme</button> --}}
        </div>
    </section>
    <!--All Products (OK)-->

     <!--Advertise-->
    <section class="banner-2">
        <div class="container">
           @foreach ($adsbanner as $ads)
            @if($ads->is_featured == 1 && $ads->is_feature_no == 3)
            <div class="banner-img banner-big wow fadeIn animated f-none">
                <img src="{{asset('storage/'.$ads->image)}}" alt="$ads->title">
                <div class="banner-text d-md-block d-none">
                    <h4 class="mb-15 text-brand">{{$ads->header}}</h4>
                    <h1 class="fw-600 mb-20" style="width: 450px; color:#fff">{{$ads->title}}</h1>

                    @if($ads->shop_url != null)
                    <a href="{{$ads->shop_url}}" class="btn">Shop Now <i class="fi-rs-arrow-right"></i></a>
                    @endif
                </div>
            </div>
            @endif
            {{-- @break --}}
            @endforeach
        </div>
    </section>
    <!--Advertise-->
</main>

@endsection
