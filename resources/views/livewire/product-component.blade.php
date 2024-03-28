<div>
    <div class="row mb-50">
        <div class="col-md-2 col-sm-4 col-xs-4">
            <!-- THUMBNAILS -->
            <div class="slider-nav-thumbnails pl-15 pr-15 d-sm-none">
                {{-- <img src="" alt="product image"> --}}
                @if ($product->product_thumbnail->isNotEmpty())
                    @foreach ($product->product_thumbnail as $image)
                    <div>
                        <img src="{{asset('storage/product_images/thumbnail/'.$image->product_thumbnail)}}"
                                    alt="product image">
                    </div>
                    @endforeach

                @endif
                @if ($product->product_images->isNotEmpty())
                     @foreach ($product->product_images as $image)
                        <div>
                        <img src="{{asset('storage/product_images/'.$image->product_image)}}"
                            alt="product image">
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
        <!--Product View-->
        <div class="col-md-4 col-sm-8 col-xs-8">
            <div class="detail-gallery">
                <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                <!-- MAIN SLIDES -->
                <div class="product-image-slider">

                    @if ($product->product_thumbnail->isNotEmpty())
                        @foreach ($product->product_thumbnail as $image)
                        <figure class="border-radius-10">
                        <img src="{{asset('storage/product_images/thumbnail/'.$image->product_thumbnail)}}"
                            alt="product image">
                        </figure>

                        @endforeach
                    @endif

                    @if ($product->product_images->isNotEmpty())
                        @foreach ($product->product_images as $image)
                        <figure class="border-radius-10">
                        <img src="{{asset('storage/product_images/'.$image->product_image)}}"
                            alt="product image">
                        </figure>
                        @endforeach
                    @endif
                </div>

                 <!-- THUMBNAILS -->
                <div class="slider-nav-thumbnails-sm pl-15 pr-15 d-lg-none">
                    {{-- <img src="" alt="product image"> --}}
                    @if ($product->product_thumbnail->isNotEmpty())
                        @foreach ($product->product_thumbnail as $image)
                        <div>
                            <img src="{{asset('storage/product_images/thumbnail/'.$image->product_thumbnail)}}"
                                        alt="product image">
                        </div>
                        @endforeach

                    @endif
                    @if ($product->product_images->isNotEmpty())
                        @foreach ($product->product_images as $image)
                            <div>
                            <img src="{{asset('storage/product_images/'.$image->product_image)}}"
                                alt="product image">
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
            <!-- End Gallery -->
        </div>
        <!--Product View-->

        <!--Product Details Button-->
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="detail-info">
                <h2 class="title-detail">{{$product->product_name}}</h2>
                <div class="product-detail-rating">
                    <div class="pro-details-brand">
                        <span> Brands: <a
                                href="shop-grid-right.html">{{$product->brand->brand_name}}</a></span>
                    </div>
                    {{-- <div class="product-rate-cover text-end">
                        <div class="product-rate d-inline-block">
                            <div class="product-rating" style="width:90%">
                            </div>
                        </div>
                        <span class="font-small ml-5 text-muted"> (25 reviews)</span>
                    </div> --}}
                </div>
                @php
                    // $inStock = $product->product_stocks->inStock;
                    $inStock = $product->product_stocks->sum('inStock');
                    $outStock = $product->product_stocks->sum('outStock');
                    $balance = $inStock - $outStock;
                @endphp
                <div class="clearfix product-price-cover">
                    <div class="product-price primary-color float-left">
                        @php
                            $flag = 0;
                            $thisProduct = $product->id;
                            if ($campaign) {
                                $camp_products = $campaign->camp_product;

                                foreach ($camp_products as $key => $camp_product) {
                                    if ($thisProduct == $camp_product->product_id) {
                                        $camp_offer = DB::select('select * from campaigns where id = ?', [$camp_product->campaign_id]);
                                        // echo $camp_offer->camp_offer;
                                        $camp_price = $camp_product->camp_price;
                                        $flag = 1;

                                        if (!empty($camp_offer)) {
                                            $firstOffer = $camp_offer[0]; // Access the first element of the array
                                        }
                                    }
                                }
                            }
                        @endphp

                        @if($flag == 1)
                        <ins><span class="text-brand">৳{{$camp_price}}</span></ins>
                        <ins><span class="old-price font-md ml-15">৳{{$product->regular_price}}</span></ins>
                            <span class="save-price  font-md color3 ml-15">{{$firstOffer->camp_offer}}% Off</span>

                        @elseif($product->product_price->offer_price > 0)
                        <ins><span class="text-brand">৳{{$product->product_price->offer_price}}</span></ins>
                        <ins><span class="old-price font-md ml-15">৳{{$product->regular_price}}</span></ins>
                        <span class="save-price  font-md color3 ml-15">{{$product->product_price->percentage}}%
                            Off</span>
                        @else
                        <ins><span class="text-brand">৳{{$product->regular_price}}</span></ins>

                        @endif



                    </div>
                </div>
                <!--<div class="bt-1 border-color-1 mt-15 mb-15"></div>-->
                <div class="short-desc">
                    <h4 class="mb-10">Quick Overview</h4>
                    <ul class="product-more-infor mt-10">

                        @foreach ($product->overviews as $overview)
                        <li><span>{{$overview->overview_name}}</span>
                            {{$overview->overview_value}}</li>
                        @endforeach

                    </ul>
                </div>
                @if($balance > 0)
                <div class="attr-detail attr-color mt-20 mb-15">
                    <strong class="color-size mr-10">Color</strong>
                    @livewire('select-color-component', ['colors' => $product->colors])

                </div>
                <div class="attr-detail attr-size">
                    <strong class="color-size mr-10">Size</strong>

                    @livewire('select-size-component', ['sizes' => $product->sizes, 'productId' => $product->id])

                </div>
                @endif
                <div class="bt-1 border-color-1 mt-30 mb-30"></div>


                @if($balance > 0)
                <div class="detail-extralink">

                    {{-- Quantity field --}}
                    @livewire('update-quantity-component')

                    <div class="product-extra-link2">
                        {{-- <button type="submit" class="button button-add-to-cart">Buy Now</button> --}}
                        <button wire:click.prevent="buyNow({{$product->id}})"
                            class="button buy-button">Buy Now</button>
                        <button  wire:click.prevent="store({{$product->id}})"
                            class="button add-cart-button">Add to cart</button>
                    </div>
                </div>
                @endif

                <div class="row product-tag-info">
                    <div class="col-lg-6">
                        <div class="product_sort_info font-xs">
                            <ul class="product-meta font-xs color-grey">
                                <li class=""><strong>SKU:</strong> <a
                                        href="#">{{$product->sku}}</a></li>
                                @foreach ($product->product_extras as $extrainfo)

                                @endforeach
                                <li class=""><strong>EMI:</strong> <span
                                        class="in-stock ml-5">{{$extrainfo->emi}}</span></li>
                                <li><strong>Availability:</strong>
                                    <span class="in-stock ml-5">{{$balance > 0 ? $balance: 'Out of Stock'}} </span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ul class="product-meta">
                            <li class="">
                                <strong>Tags:</strong>
                                @foreach ($product->tags as $tag)
                                <a  href="#">{{$tag->tag}}</a>,
                                @endforeach
                            </li>
                            @if ($product->product_extra)
                            <li class=""><i class="fi-rs-crown mr-5"></i> {{$product->product_extra->warranty_type}}</li>
                            <li class=""><i class="fi-rs-refresh mr-5"></i> {{$product->product_tags->tag}} </li>
                            <li><i class="fi-rs-credit-card mr-5"></i> {{$product->product_extra->delivery_type}}</li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="social-icons single-share">
                    <ul class="text-grey-5 d-inline-block mt-20">
                        @php
                            $productUrl = url('product/'.$product->slug)
                        @endphp
                        <li><strong class="mr-10">Share this:</strong></li>
                        <li class="social-facebook">

                            <a href="https://www.facebook.com/sharer/sharer.php?u={!!$productUrl!!}" target="_blank">
                                <img src="{{asset('')}}frontend/assets/imgs/theme/icons/icon-facebook.svg" alt="">
                            </a>
                        </li>
                        <li class="social-twitter"> <a href="#"><img
                                    src="{{asset('')}}frontend/assets/imgs/theme/icons/icon-twitter.svg"
                                    alt=""></a></li>
                        <li class="social-instagram"><a href="#"><img
                                    src="{{asset('')}}frontend/assets/imgs/theme/icons/icon-instagram.svg"
                                    alt=""></a></li>
                        <li class="social-linkedin"><a href="#"><img
                                    src="{{asset('')}}frontend/assets/imgs/theme/icons/icon-pinterest.svg"
                                    alt=""></a></li>
                    </ul>
                </div>
            </div>
            <!-- Detail Info -->
        </div>
        <!--Product Details Button-->

    </div>
    <!--Description-->
    <div class="row">
        <div class="col-lg-10 m-auto">
            <div class="tab-style3">
                <ul class="nav nav-tabs text-uppercase">
                    <li class="nav-item">
                        <a class="nav-link active" id="Description-tab" data-bs-toggle="tab"
                            href="#Description">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab"
                            href="#Additional-info">Additional info</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab"
                            href="#Reviews">Reviews (3)</a>
                    </li>
                </ul>
                <div class="tab-content shop_info_tab entry-main-content">
                    <div class="tab-pane fade show active" id="Description">
                        <div class="">
                            <p class="peragraph">
                                {!! $product->description !!}
                            </p>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="Additional-info">
                        <table class="font-md">
                            <tbody>
                                @foreach ($product->product_infos as $info)

                                <tr class="stand-up">
                                    <th>{{$info->additional_name}}</th>
                                    <td>
                                        <p class="peragraph">{{$info->additional_value}}</p>
                                    </td>
                                </tr>

                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="Reviews">
                        <!--Comments-->
                        <div class="comments-area">
                            <div class="row">
                                <div class="col-lg-8">
                                    <h4 class="mb-30">Customer questions & answers</h4>
                                    <div class="comment-list">
                                        <div
                                            class="single-comment justify-content-between d-flex">
                                            <div class="user justify-content-between d-flex">
                                                <div class="thumb text-center">
                                                    <img src="{{asset('')}}frontend/assets/imgs/page/avatar-6.jpg"
                                                        alt="">
                                                    <h6><a href="#">Jacky Chan</a></h6>
                                                    <p class="font-xxs">Since 2012</p>
                                                </div>
                                                <div class="desc">
                                                    <div class="product-rate d-inline-block">
                                                        <div class="product-rating"
                                                            style="width:90%">
                                                        </div>
                                                    </div>
                                                    <p>Thank you very fast shipping from Poland
                                                        only 3days.</p>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="d-flex align-items-center">
                                                            <p class="font-xs mr-30">December 4,
                                                                2020 at 3:12 pm </p>
                                                            <a href="#"
                                                                class="text-brand btn-reply">Reply
                                                                <i
                                                                    class="fi-rs-arrow-right"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--single-comment -->
                                        <div
                                            class="single-comment justify-content-between d-flex">
                                            <div class="user justify-content-between d-flex">
                                                <div class="thumb text-center">
                                                    <img src="{{asset('')}}frontend/assets/imgs/page/avatar-7.jpg"
                                                        alt="">
                                                    <h6><a href="#">Ana Rosie</a></h6>
                                                    <p class="font-xxs">Since 2008</p>
                                                </div>
                                                <div class="desc">
                                                    <div class="product-rate d-inline-block">
                                                        <div class="product-rating"
                                                            style="width:90%">
                                                        </div>
                                                    </div>
                                                    <p>Great low price and works well.</p>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="d-flex align-items-center">
                                                            <p class="font-xs mr-30">December 4,
                                                                2020 at 3:12 pm </p>
                                                            <a href="#"
                                                                class="text-brand btn-reply">Reply
                                                                <i
                                                                    class="fi-rs-arrow-right"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--single-comment -->
                                        <div
                                            class="single-comment justify-content-between d-flex">
                                            <div class="user justify-content-between d-flex">
                                                <div class="thumb text-center">
                                                    <img src="{{asset('')}}frontend/assets/imgs/page/avatar-8.jpg"
                                                        alt="">
                                                    <h6><a href="#">Steven Keny</a></h6>
                                                    <p class="font-xxs">Since 2010</p>
                                                </div>
                                                <div class="desc">
                                                    <div class="product-rate d-inline-block">
                                                        <div class="product-rating"
                                                            style="width:90%">
                                                        </div>
                                                    </div>
                                                    <p>Authentic and Beautiful, Love these way
                                                        more than ever expected They are Great
                                                        earphones</p>
                                                    <div class="d-flex justify-content-between">
                                                        <div class="d-flex align-items-center">
                                                            <p class="font-xs mr-30">December 4,
                                                                2020 at 3:12 pm </p>
                                                            <a href="#"
                                                                class="text-brand btn-reply">Reply
                                                                <i
                                                                    class="fi-rs-arrow-right"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--single-comment -->
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <h4 class="mb-30">Customer reviews</h4>
                                    <div class="d-flex mb-30">
                                        <div class="product-rate d-inline-block mr-15">
                                            <div class="product-rating" style="width:90%">
                                            </div>
                                        </div>
                                        <h6>4.8 out of 5</h6>
                                    </div>
                                    <div class="progress">
                                        <span>5 star</span>
                                        <div class="progress-bar" role="progressbar"
                                            style="width: 50%;" aria-valuenow="50"
                                            aria-valuemin="0" aria-valuemax="100">50%</div>
                                    </div>
                                    <div class="progress">
                                        <span>4 star</span>
                                        <div class="progress-bar" role="progressbar"
                                            style="width: 25%;" aria-valuenow="25"
                                            aria-valuemin="0" aria-valuemax="100">25%</div>
                                    </div>
                                    <div class="progress">
                                        <span>3 star</span>
                                        <div class="progress-bar" role="progressbar"
                                            style="width: 45%;" aria-valuenow="45"
                                            aria-valuemin="0" aria-valuemax="100">45%</div>
                                    </div>
                                    <div class="progress">
                                        <span>2 star</span>
                                        <div class="progress-bar" role="progressbar"
                                            style="width: 65%;" aria-valuenow="65"
                                            aria-valuemin="0" aria-valuemax="100">65%</div>
                                    </div>
                                    <div class="progress mb-30">
                                        <span>1 star</span>
                                        <div class="progress-bar" role="progressbar"
                                            style="width: 85%;" aria-valuenow="85"
                                            aria-valuemin="0" aria-valuemax="100">85%</div>
                                    </div>
                                    <a href="#" class="font-xs text-muted">How are ratings
                                        calculated?</a>
                                </div>
                            </div>
                        </div>
                        <!--comment form-->
                        <div class="comment-form">
                            <h4 class="mb-15">Add a review</h4>
                            <div class="product-rate d-inline-block mb-30">
                            </div>
                            <div class="row">
                                <div class="col-lg-8 col-md-12">
                                    <form class="form-contact comment_form" action="#"
                                        id="commentForm">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <textarea class="form-control w-100"
                                                        name="comment" id="comment" cols="30"
                                                        rows="9"
                                                        placeholder="Write Comment"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input class="form-control" name="name"
                                                        id="name" type="text"
                                                        placeholder="Name">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <input class="form-control" name="email"
                                                        id="email" type="email"
                                                        placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <input class="form-control" name="website"
                                                        id="website" type="text"
                                                        placeholder="Website">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit"
                                                class="button button-contactForm">Submit
                                                Review</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Description-->

</div>
