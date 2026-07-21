@extends('layouts.admin')
@section('title',$product->slug)
@section('content')
<link rel="stylesheet" href="{{asset('')}}frontend/assets/css/main.css?v=3.4">

<main class="main">
    <div class="page-header breadcrumb-wrap">
       <div class="container">
          <div class="breadcrumb">
             <a href="index.html" rel="nofollow">Home</a>
             <span></span> Fashion
             <span></span> Abstract Print Patchwork Dress
          </div>
       </div>
    </div>
    <section class="mt-50 mb-50 pb-50">
       <div class="container">
          <div class="row flex-row-reverse">
             <div class="col-lg-12">
                <div class="product-detail accordion-detail">
                   <div class="row mb-50">
                      <!--Product View-->
                      <div class="col-md-5 col-sm-12 col-xs-12">
                         <div class="detail-gallery">
                            <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                            <!-- MAIN SLIDES -->
                            <div class="product-image-slider">
                                @foreach ($product->product_images as $image)
                                <figure class="border-radius-10">
                                    <img src="{{asset('storage/product_images/'.$image->product_image)}}" alt="product image">
                                 </figure>
                                @endforeach
                            </div>
                            <!-- THUMBNAILS -->
                            <div class="slider-nav-thumbnails pl-15 pr-15">
                                @foreach ($product->product_images as $image)
                                    {{-- <img src="" alt="product image"> --}}
                                    <div><img src="{{asset('storage/product_images/'.$image->product_image)}}" alt="product image"></div>
                                @endforeach

                            </div>
                         </div>
                         <!-- End Gallery -->
                      </div>
                      <!--Product View-->
                      <!--Product Details Button-->
                      <div class="col-md-7 col-sm-12 col-xs-12">
                         <div class="detail-info">
                            <h2 class="title-detail">{{$product->product_name}}</h2>
                            <div class="product-detail-rating">
                               <div class="pro-details-brand">
                                  <span> Brands: <a href="shop-grid-right.html">{{$product->brand->brand_name}}</a></span>
                               </div>
                               <div class="product-rate-cover text-end">
                                  <div class="product-rate d-inline-block">
                                     <div class="product-rating" style="width:90%">
                                     </div>
                                  </div>
                                  <span class="font-small ml-5 text-muted"> (25 reviews)</span>
                               </div>
                            </div>
                            <div class="clearfix product-price-cover">
                               <div class="product-price primary-color float-left">
                                @if ($product->product_price?->offer_price > 0)
                                <ins><span class="text-brand">৳{{$product->product_price->offer_price}}</span></ins>
                                <ins><span class="old-price font-md ml-15">৳{{$product->regular_price}}</span></ins>
                                    <span class="save-price  font-md color3 ml-15">{{$product->product_price->percentage}}% Off</span>
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
                                <li><span>{{$overview->overview_name}}</span> {{$overview->overview_value}}</li>
                                @endforeach

                               </ul>
                            </div>

                            <div class="attr-detail attr-color mt-20 mb-15">
                               <strong class="color-size mr-10">Color</strong>
                               <ul class="list-filter color-filter">

                                @foreach ($product->colors as $color)
                                <li>
                                    <a href="#" data-color="{{$color->color_name}}" >
                                        <span class="product-color-red" style="background: {{$color->color_code}};"></span>
                                    </a>
                                </li>
                                @endforeach

                               </ul>
                            </div>
                            <div class="attr-detail attr-size">
                               <strong class="color-size mr-10">Size</strong>
                               <ul class="list-filter size-filter font-small">

                                @foreach ($product->sizes as $size)
                                <li><a href="#" class="{{ $size->size ? 'active' : '' }}" >{{$size->size}}</a></li>
                                @endforeach

                                  {{-- <li class="active"><a href="#">M</a></li>
                                  <li><a href="#">L</a></li>
                                  <li><a href="#">XL</a></li>
                                  <li><a href="#">XXL</a></li> --}}
                                  <li><a class="btn size-button ml-15" href="#">Size Chart</a></li>
                               </ul>
                            </div>
                            <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                            {{-- <div class="detail-extralink">
                               <div class="detail-qty border radius">
                                  <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                  <span class="qty-val">1</span>
                                  <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                               </div>
                               <div class="product-extra-link2">
                                  <button type="submit" class="button button-add-to-cart">Buy Now</button>
                                  <button type="submit" class="button button-add-to-cart">Add to cart</button>
                               </div>
                            </div> --}}
                            <div class="row product-tag-info">
                                <div class="col-lg-6">
                                    <div class="product_sort_info font-xs">
                               <ul class="product-meta font-xs color-grey">
                               <li class=""><strong>SKU:</strong> <a href="#">{{$product->sku}}</a></li>
                               @php
                                   // product_extras is a hasMany but every product has at most
                                   // one row. This used to be an empty @foreach whose only job
                                   // was to leak $extrainfo into scope for the line below - a
                                   // product with zero extras rows left $extrainfo undefined
                                   // and fataled the page.
                                   $extrainfo = $product->product_extras->first();
                               @endphp
                               <li class=""><strong>EMI:</strong> <span class="in-stock ml-5">{{$extrainfo->emi ?? 'Not Available'}}</span></li>
                               <li><strong>Availability:</strong><span class="in-stock ml-5">{{$product->stock}} Items In Stock</span></li>
                            </ul>
                            </div>
                                </div>
                                <div class="col-lg-6">
                                    <ul class="product-meta">
                                  <li class=""><i class="fi-rs-crown mr-5"></i> 1 Year AL Jazeera Brand Warranty</li>
                                  <li class=""><i class="fi-rs-refresh mr-5"></i> 30 Day Return Policy</li>
                                  <li><i class="fi-rs-credit-card mr-5"></i> Cash on Delivery available</li>
                               </ul>
                                </div>
                            </div>
                               <div class="social-icons single-share">
                            <ul class="text-grey-5 d-inline-block mt-20">
                               <li><strong class="mr-10">Share this:</strong></li>
                               <li class="social-facebook"><a href="#"><img src="{{asset('')}}frontend/assets/imgs/theme/icons/icon-facebook.svg" alt=""></a></li>
                               <li class="social-twitter"> <a href="#"><img src="{{asset('')}}frontend/assets/imgs/theme/icons/icon-twitter.svg" alt=""></a></li>
                               <li class="social-instagram"><a href="#"><img src="{{asset('')}}frontend/assets/imgs/theme/icons/icon-instagram.svg" alt=""></a></li>
                               <li class="social-linkedin"><a href="#"><img src="{{asset('')}}frontend/assets/imgs/theme/icons/icon-pinterest.svg" alt=""></a></li>
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
                            <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Description</a>
                         </li>
                         <li class="nav-item">
                            <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab" href="#Additional-info">Additional info</a>
                         </li>
                         <li class="nav-item">
                            <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Reviews (3)</a>
                         </li>
                      </ul>
                      <div class="tab-content shop_info_tab entry-main-content">
                         <div class="tab-pane fade show active" id="Description">
                            <div class="">
                               <p class="peragraph">
                                {!!$product->description!!}
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
                                        <div class="single-comment justify-content-between d-flex">
                                           <div class="user justify-content-between d-flex">
                                              <div class="thumb text-center">
                                                 <img src="{{asset('')}}frontend/assets/imgs/page/avatar-6.jpg" alt="">
                                                 <h6><a href="#">Jacky Chan</a></h6>
                                                 <p class="font-xxs">Since 2012</p>
                                              </div>
                                              <div class="desc">
                                                 <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width:90%">
                                                    </div>
                                                 </div>
                                                 <p>Thank you very fast shipping from Poland only 3days.</p>
                                                 <div class="d-flex justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                       <p class="font-xs mr-30">December 4, 2020 at 3:12 pm </p>
                                                       <a href="#" class="text-brand btn-reply">Reply <i class="fi-rs-arrow-right"></i> </a>
                                                    </div>
                                                 </div>
                                              </div>
                                           </div>
                                        </div>
                                        <!--single-comment -->
                                        <div class="single-comment justify-content-between d-flex">
                                           <div class="user justify-content-between d-flex">
                                              <div class="thumb text-center">
                                                 <img src="{{asset('')}}frontend/assets/imgs/page/avatar-7.jpg" alt="">
                                                 <h6><a href="#">Ana Rosie</a></h6>
                                                 <p class="font-xxs">Since 2008</p>
                                              </div>
                                              <div class="desc">
                                                 <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width:90%">
                                                    </div>
                                                 </div>
                                                 <p>Great low price and works well.</p>
                                                 <div class="d-flex justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                       <p class="font-xs mr-30">December 4, 2020 at 3:12 pm </p>
                                                       <a href="#" class="text-brand btn-reply">Reply <i class="fi-rs-arrow-right"></i> </a>
                                                    </div>
                                                 </div>
                                              </div>
                                           </div>
                                        </div>
                                        <!--single-comment -->
                                        <div class="single-comment justify-content-between d-flex">
                                           <div class="user justify-content-between d-flex">
                                              <div class="thumb text-center">
                                                 <img src="{{asset('')}}frontend/assets/imgs/page/avatar-8.jpg" alt="">
                                                 <h6><a href="#">Steven Keny</a></h6>
                                                 <p class="font-xxs">Since 2010</p>
                                              </div>
                                              <div class="desc">
                                                 <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width:90%">
                                                    </div>
                                                 </div>
                                                 <p>Authentic and Beautiful, Love these way more than ever expected They are Great earphones</p>
                                                 <div class="d-flex justify-content-between">
                                                    <div class="d-flex align-items-center">
                                                       <p class="font-xs mr-30">December 4, 2020 at 3:12 pm </p>
                                                       <a href="#" class="text-brand btn-reply">Reply <i class="fi-rs-arrow-right"></i> </a>
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
                                        <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">50%</div>
                                     </div>
                                     <div class="progress">
                                        <span>4 star</span>
                                        <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                     </div>
                                     <div class="progress">
                                        <span>3 star</span>
                                        <div class="progress-bar" role="progressbar" style="width: 45%;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">45%</div>
                                     </div>
                                     <div class="progress">
                                        <span>2 star</span>
                                        <div class="progress-bar" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100">65%</div>
                                     </div>
                                     <div class="progress mb-30">
                                        <span>1 star</span>
                                        <div class="progress-bar" role="progressbar" style="width: 85%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%</div>
                                     </div>
                                     <a href="#" class="font-xs text-muted">How are ratings calculated?</a>
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
                                     <form class="form-contact comment_form" action="#" id="commentForm">
                                        <div class="row">
                                           <div class="col-12">
                                              <div class="form-group">
                                                 <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                                              </div>
                                           </div>
                                           <div class="col-sm-6">
                                              <div class="form-group">
                                                 <input class="form-control" name="name" id="name" type="text" placeholder="Name">
                                              </div>
                                           </div>
                                           <div class="col-sm-6">
                                              <div class="form-group">
                                                 <input class="form-control" name="email" id="email" type="email" placeholder="Email">
                                              </div>
                                           </div>
                                           <div class="col-12">
                                              <div class="form-group">
                                                 <input class="form-control" name="website" id="website" type="text" placeholder="Website">
                                              </div>
                                           </div>
                                        </div>
                                        <div class="form-group">
                                           <button type="submit" class="button button-contactForm">Submit
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
             </div>
          </div>
       </div>
    </section>
 </main>
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
  <!-- Template  JS -->
  <script src="{{asset('')}}frontend/assets/js/main.js?v=3.4"></script>
  <script src="{{asset('')}}frontend/assets/js/shop.js?v=3.4"></script>
@endsection

