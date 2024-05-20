<div>
    <div class="row mb-50">
        <!--Product View-->
        <div class="col-md-2 col-sm-4 col-xs-4">
            <!-- THUMBNAILS -->
                <div class="slider-nav-thumbnails pl-15 pr-15 d-sm-none">
                    @if ($product->product_thumbnail->isNotEmpty())
                        @foreach ($product->product_thumbnail as $image)
                        <div>
                            <img src="{{asset('storage/product_images/thumbnail/'.$image->product_thumbnail)}}"
                                        alt="product image" style="height: 180px;margin: 5px auto;">
                        </div>

                        @endforeach

                    @endif
                    @if ($product->product_images->isNotEmpty())
                         @foreach ($product->product_images as $image)
                            <div>
                            <img src="{{asset('storage/product_images/'.$image->product_image)}}"
                                alt="product image" style="height: 180px;margin: 5px auto;">
                            </div>
                        @endforeach
                    @endif

                </div>
        </div>
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
                                href="#">{{$product->brand->brand_name}}</a></span>
                    </div>
                    <!--<div class="product-rate-cover text-end">-->
                    <!--    <div class="product-rate d-inline-block">-->
                    <!--        <div class="product-rating" style="width:90%">-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--    <span class="font-small ml-5 text-muted"> (25 reviews)</span>-->
                    <!--</div>-->
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
                            $camp_product = DB::select('select * from camp_products where product_id = ?', [$product->id]);
                            foreach ($camp_product as $key => $value) {

                                $camp_offer = DB::select('select * from campaigns where id = ?', [$value->campaign_id]);

                                foreach ($camp_offer as $offer) {
                                    // echo $offer->camp_offer;
                                }
                            }
                        @endphp

                        @if(count($camp_product) > 0)
                        <ins><span class="text-brand">৳{{$value->camp_price}}</span></ins>
                        <ins><span class="old-price font-md ml-15">৳{{$product->regular_price}}</span></ins>
                            <!--<span class="save-price  font-md color3 ml-15">{{$offer->camp_offer}}% Off</span>-->
                            {{-- {{$value->camp_price}} --}}
                        @else
                            @if ($product->product_price->offer_price > 0)
                            <ins><span
                                    class="text-brand">৳{{$product->product_price->offer_price}}</span></ins>
                            <ins><span
                                    class="old-price font-md ml-15">৳{{$product->regular_price}}</span></ins>
                            <!--<span-->
                            <!--    class="save-price  font-md color3 ml-15">{{$product->product_price->percentage}}%-->
                            <!--    Off</span>-->
                            @else

                            <ins><span class="text-brand">৳{{$product->regular_price}}</span></ins>

                            @endif
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
                  @foreach ($product->product_extras as $extrainfo)

                                @endforeach
                <div class="row product-tag-info">
                    <div class="col-lg-6">
                        <div class="product_sort_info font-xs">
                            <ul class="product-meta font-xs color-grey">
                                
                               <li><strong>Availability:</strong>
                                    <span class="in-stock ml-5">
                                        @if($balance > 0)
                                        {{$balance}} items In Stock
                                        @else
                                       <span style="color:red;"> Out of Stock </span>
                                        @endif
                                    </span>
                                </li>
                                <li class=""><strong>EMI:</strong> <span
                                        class="in-stock ml-5">{{$extrainfo->emi}}</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="product_sort_info font-xs">
                            <ul class="product-meta font-xs color-grey">
                                <li class=""><strong>SKU:</strong> <a
                                        href="#">{{$product->sku}}</a></li>
                              
                               
                               <li class="">
                                <strong>Tags:</strong>
                                @foreach ($product->tags as $tag)
                                <a  href="#">{{$tag->tag}}</a>,
                                @endforeach
                            </li>
                            </ul>
                        </div>
                    </div>
                </div>
                 @php
                    $productUrl = url('product/'.$product->slug)
                @endphp
                <div class="social-icons single-share">
                    <ul class="text-grey-5 d-inline-block mt-20">
                        <li><strong class="mr-10">Share this:</strong></li>
                        <li class="social-facebook">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $productUrl }}" target="_blank">
                                <img src="{{asset('')}}frontend/assets/imgs/theme/icons/icon-facebook.svg" alt="">
                            </a>
                        </li>
                        <li class="social-twitter"> <a href="https://twitter.com/intent/tweet?url={{ $productUrl}}" target="_blank"><img
                                    src="{{asset('')}}frontend/assets/imgs/theme/icons/icon-twitter.svg"
                                    alt=""></a></li>
                        <li class="social-instagram"><a href="https://www.instagram.com/share?url={{ urlencode($productUrl) }}" target="_blank"><img
                                    src="{{asset('')}}frontend/assets/imgs/theme/icons/icon-instagram.svg"
                                    alt=""></a></li>
                        <li class="social-linkedin"><a href="#"><img
                                    src="{{asset('')}}frontend/assets/imgs/theme/icons/icon-pinterest.svg"
                                    alt=""></a></li>
                    </ul>
                </div>
                @if (strpos($product->product_name, 'Pajama') === false)
               <!--size Chart-->
                <!--<div>-->
                <!--    <h4>Size Chart</h4>-->
                <!--    <br>-->
                <!--    <div class="table-responsive">-->
                <!--        <table class="table bordered">-->
                <!--            <thead>-->
                <!--                <tr>-->
                <!--                    <th class="fw-bold">SIZE</th>-->
                <!--                    <th class="fw-bold">CHEST</th>-->
                <!--                    <th class="fw-bold">LENGTH</th>-->
                <!--                    <th class="fw-bold">SHOULDER</th>-->
                <!--                    <th class="fw-bold">SLEEVE</th>-->
                <!--                </tr>-->
                <!--            </thead>-->
                <!--            <tbody>-->
                <!--                <tr>-->
                <!--                    <td>38</td>-->
                <!--                    <td>40</td>-->
                <!--                    <td>38</td>-->
                <!--                    <td>17</td>-->
                <!--                    <td>22</td>-->
                <!--                </tr>-->
                <!--                <tr>-->
                <!--                    <td>40</td>-->
                <!--                    <td>41</td>-->
                <!--                    <td>40</td>-->
                <!--                    <td>17</td>-->
                <!--                    <td>23.5</td>-->
                <!--                </tr>-->
                <!--                <tr>-->
                <!--                    <td>42</td>-->
                <!--                    <td>43</td>-->
                <!--                    <td>42</td>-->
                <!--                    <td>18</td>-->
                <!--                    <td>23.5</td>-->
                <!--                </tr>-->
                <!--                <tr>-->
                <!--                    <td>44</td>-->
                <!--                    <td>44</td>-->
                <!--                    <td>44</td>-->
                <!--                    <td>18.5</td>-->
                <!--                    <td>24</td>-->
                <!--                </tr>-->
                <!--            </tbody>-->
                <!--        </table>-->
                <!--    </div>-->

                <!--</div>-->
                <!--end size chart-->
                @endif
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
                    <!--<li class="nav-item">-->
                    <!--    <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab"-->
                    <!--        href="#Reviews">Reviews (3)</a>-->
                    <!--</li>-->
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
                                {{-- <tr class="folded-wo-wheels">
                    <th>Folded (w/o wheels)</th>
                    <td>
                    <p class="peragraph">32.5″L x 18.5″W x 16.5″H</p>
                    </td>
                </tr>
                <tr class="folded-w-wheels">
                    <th>Folded (w/ wheels)</th>
                    <td>
                    <p class="peragraph">32.5″L x 24″W x 18.5″H</p>
                    </td>
                </tr>
                <tr class="door-pass-through">
                    <th>Door Pass Through</th>
                    <td>
                    <p class="peragraph">24</p>
                    </td>
                </tr>
                <tr class="frame">
                    <th>Frame</th>
                    <td>
                    <p class="peragraph">Aluminum</p>
                    </td>
                </tr>
                <tr class="weight-wo-wheels">
                    <th>Weight (w/o wheels)</th>
                    <td>
                    <p class="peragraph">20 LBS</p>
                    </td>
                </tr>
                <tr class="weight-capacity">
                    <th>Weight Capacity</th>
                    <td>
                    <p class="peragraph">60 LBS</p>
                    </td>
                </tr>
                <tr class="width">
                    <th>Width</th>
                    <td>
                    <p class="peragraph">24″</p>
                    </td>
                </tr>
                <tr class="handle-height-ground-to-handle">
                    <th>Handle height (ground to handle)</th>
                    <td>
                    <p class="peragraph">37-45″</p>
                    </td>
                </tr>
                <tr class="wheels">
                    <th>Wheels</th>
                    <td>
                    <p class="peragraph">12″ air / wide track slick tread</p>
                    </td>
                </tr>
                <tr class="seat-back-height">
                    <th>Seat back height</th>
                    <td>
                    <p class="peragraph">21.5″</p>
                    </td>
                </tr>
                <tr class="head-room-inside-canopy">
                    <th>Head room (inside canopy)</th>
                    <td>
                    <p class="peragraph">25″</p>
                    </td>
                </tr>
                <tr class="pa_color">
                    <th>Color</th>
                    <td>
                    <p class="peragraph">Black, Blue, Red, White</p>
                    </td>
                </tr>
                <tr class="pa_size">
                    <th>Size</th>
                    <td>
                    <p class="peragraph">M, S</p>
                    </td>
                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                    <!--<div class="tab-pane fade" id="Reviews">-->
                        <!--Comments-->
                    <!--    <div class="comments-area">-->
                    <!--        <div class="row">-->
                    <!--            <div class="col-lg-8">-->
                    <!--                <h4 class="mb-30">Customer questions & answers</h4>-->
                    <!--                <div class="comment-list">-->
                    <!--                    <div-->
                    <!--                        class="single-comment justify-content-between d-flex">-->
                    <!--                        <div class="user justify-content-between d-flex">-->
                    <!--                            <div class="thumb text-center">-->
                    <!--                                <img src="{{asset('')}}frontend/assets/imgs/page/avatar-6.jpg"-->
                    <!--                                    alt="">-->
                    <!--                                <h6><a href="#">Jacky Chan</a></h6>-->
                    <!--                                <p class="font-xxs">Since 2012</p>-->
                    <!--                            </div>-->
                    <!--                            <div class="desc">-->
                    <!--                                <div class="product-rate d-inline-block">-->
                    <!--                                    <div class="product-rating"-->
                    <!--                                        style="width:90%">-->
                    <!--                                    </div>-->
                    <!--                                </div>-->
                    <!--                                <p>Thank you very fast shipping from Poland-->
                    <!--                                    only 3days.</p>-->
                    <!--                                <div class="d-flex justify-content-between">-->
                    <!--                                    <div class="d-flex align-items-center">-->
                    <!--                                        <p class="font-xs mr-30">December 4,-->
                    <!--                                            2020 at 3:12 pm </p>-->
                    <!--                                        <a href="#"-->
                    <!--                                            class="text-brand btn-reply">Reply-->
                    <!--                                            <i-->
                    <!--                                                class="fi-rs-arrow-right"></i>-->
                    <!--                                        </a>-->
                    <!--                                    </div>-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                    </div>-->
                                        <!--single-comment -->
                    <!--                    <div-->
                    <!--                        class="single-comment justify-content-between d-flex">-->
                    <!--                        <div class="user justify-content-between d-flex">-->
                    <!--                            <div class="thumb text-center">-->
                    <!--                                <img src="{{asset('')}}frontend/assets/imgs/page/avatar-7.jpg"-->
                    <!--                                    alt="">-->
                    <!--                                <h6><a href="#">Ana Rosie</a></h6>-->
                    <!--                                <p class="font-xxs">Since 2008</p>-->
                    <!--                            </div>-->
                    <!--                            <div class="desc">-->
                    <!--                                <div class="product-rate d-inline-block">-->
                    <!--                                    <div class="product-rating"-->
                    <!--                                        style="width:90%">-->
                    <!--                                    </div>-->
                    <!--                                </div>-->
                    <!--                                <p>Great low price and works well.</p>-->
                    <!--                                <div class="d-flex justify-content-between">-->
                    <!--                                    <div class="d-flex align-items-center">-->
                    <!--                                        <p class="font-xs mr-30">December 4,-->
                    <!--                                            2020 at 3:12 pm </p>-->
                    <!--                                        <a href="#"-->
                    <!--                                            class="text-brand btn-reply">Reply-->
                    <!--                                            <i-->
                    <!--                                                class="fi-rs-arrow-right"></i>-->
                    <!--                                        </a>-->
                    <!--                                    </div>-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                    </div>-->
                                        <!--single-comment -->
                    <!--                    <div-->
                    <!--                        class="single-comment justify-content-between d-flex">-->
                    <!--                        <div class="user justify-content-between d-flex">-->
                    <!--                            <div class="thumb text-center">-->
                    <!--                                <img src="{{asset('')}}frontend/assets/imgs/page/avatar-8.jpg"-->
                    <!--                                    alt="">-->
                    <!--                                <h6><a href="#">Steven Keny</a></h6>-->
                    <!--                                <p class="font-xxs">Since 2010</p>-->
                    <!--                            </div>-->
                    <!--                            <div class="desc">-->
                    <!--                                <div class="product-rate d-inline-block">-->
                    <!--                                    <div class="product-rating"-->
                    <!--                                        style="width:90%">-->
                    <!--                                    </div>-->
                    <!--                                </div>-->
                    <!--                                <p>Authentic and Beautiful, Love these way-->
                    <!--                                    more than ever expected They are Great-->
                    <!--                                    earphones</p>-->
                    <!--                                <div class="d-flex justify-content-between">-->
                    <!--                                    <div class="d-flex align-items-center">-->
                    <!--                                        <p class="font-xs mr-30">December 4,-->
                    <!--                                            2020 at 3:12 pm </p>-->
                    <!--                                        <a href="#"-->
                    <!--                                            class="text-brand btn-reply">Reply-->
                    <!--                                            <i-->
                    <!--                                                class="fi-rs-arrow-right"></i>-->
                    <!--                                        </a>-->
                    <!--                                    </div>-->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                    </div>-->
                                        <!--single-comment -->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--            <div class="col-lg-4">-->
                    <!--                <h4 class="mb-30">Customer reviews</h4>-->
                    <!--                <div class="d-flex mb-30">-->
                    <!--                    <div class="product-rate d-inline-block mr-15">-->
                    <!--                        <div class="product-rating" style="width:90%">-->
                    <!--                        </div>-->
                    <!--                    </div>-->
                    <!--                    <h6>4.8 out of 5</h6>-->
                    <!--                </div>-->
                    <!--                <div class="progress">-->
                    <!--                    <span>5 star</span>-->
                    <!--                    <div class="progress-bar" role="progressbar"-->
                    <!--                        style="width: 50%;" aria-valuenow="50"-->
                    <!--                        aria-valuemin="0" aria-valuemax="100">50%</div>-->
                    <!--                </div>-->
                    <!--                <div class="progress">-->
                    <!--                    <span>4 star</span>-->
                    <!--                    <div class="progress-bar" role="progressbar"-->
                    <!--                        style="width: 25%;" aria-valuenow="25"-->
                    <!--                        aria-valuemin="0" aria-valuemax="100">25%</div>-->
                    <!--                </div>-->
                    <!--                <div class="progress">-->
                    <!--                    <span>3 star</span>-->
                    <!--                    <div class="progress-bar" role="progressbar"-->
                    <!--                        style="width: 45%;" aria-valuenow="45"-->
                    <!--                        aria-valuemin="0" aria-valuemax="100">45%</div>-->
                    <!--                </div>-->
                    <!--                <div class="progress">-->
                    <!--                    <span>2 star</span>-->
                    <!--                    <div class="progress-bar" role="progressbar"-->
                    <!--                        style="width: 65%;" aria-valuenow="65"-->
                    <!--                        aria-valuemin="0" aria-valuemax="100">65%</div>-->
                    <!--                </div>-->
                    <!--                <div class="progress mb-30">-->
                    <!--                    <span>1 star</span>-->
                    <!--                    <div class="progress-bar" role="progressbar"-->
                    <!--                        style="width: 85%;" aria-valuenow="85"-->
                    <!--                        aria-valuemin="0" aria-valuemax="100">85%</div>-->
                    <!--                </div>-->
                    <!--                <a href="#" class="font-xs text-muted">How are ratings-->
                    <!--                    calculated?</a>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                        <!--comment form-->
                    <!--    <div class="comment-form">-->
                    <!--        <h4 class="mb-15">Add a review</h4>-->
                    <!--        <div class="product-rate d-inline-block mb-30">-->
                    <!--        </div>-->
                    <!--        <div class="row">-->
                    <!--            <div class="col-lg-8 col-md-12">-->
                    <!--                <form class="form-contact comment_form" action="#"-->
                    <!--                    id="commentForm">-->
                    <!--                    <div class="row">-->
                    <!--                        <div class="col-12">-->
                    <!--                            <div class="form-group">-->
                    <!--                                <textarea class="form-control w-100"-->
                    <!--                                    name="comment" id="comment" cols="30"-->
                    <!--                                    rows="9"-->
                    <!--                                    placeholder="Write Comment"></textarea>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                        <div class="col-sm-6">-->
                    <!--                            <div class="form-group">-->
                    <!--                                <input class="form-control" name="name"-->
                    <!--                                    id="name" type="text"-->
                    <!--                                    placeholder="Name">-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                        <div class="col-sm-6">-->
                    <!--                            <div class="form-group">-->
                    <!--                                <input class="form-control" name="email"-->
                    <!--                                    id="email" type="email"-->
                    <!--                                    placeholder="Email">-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                        <div class="col-12">-->
                    <!--                            <div class="form-group">-->
                    <!--                                <input class="form-control" name="website"-->
                    <!--                                    id="website" type="text"-->
                    <!--                                    placeholder="Website">-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                    </div>-->
                    <!--                    <div class="form-group">-->
                    <!--                        <button type="submit"-->
                    <!--                            class="button button-contactForm">Submit-->
                    <!--                            Review</button>-->
                    <!--                    </div>-->
                    <!--                </form>-->
                    <!--            </div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                </div>
            </div>
        </div>
    </div>
    <!--Description-->

</div>
