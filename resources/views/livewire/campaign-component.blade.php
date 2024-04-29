<div>
    <div class="text-center">
       <style>
            .sales_timer{
                width: 250px;
                /* height: 60px; */
                float:right;
                margin-right: 10px;

            }
            .sales_timer #camp_counter {
                width: 100%;
                height: 100%;
                /* padding: 6px; */
                background: transparent;
                border: none;
                display: inline-block;
                font-size: 16px;
            }
        </style>
        <h3 class="section-title section-title-1 mb-20"><span>{{$campaign->camp_name}}</span>
            <p class="sales_timer"> <span id="camp_counter"></span></p> </h3>

    </div>
    <div class="new-arrival">
        <div class="row product-grid-4">
            <div class="col-lg-6 col-md-4 col-12 col-sm-6">
                <div class="banner-img banner-1 wow fadeIn animated">
                    <img src="{{asset('storage/'.$campaign->image)}}" alt="{{$campaign->camp_name}}">
                </div>
            </div>
            @foreach ($campaign->camp_product as $item)
            {{-- {{$item->product->product_thumbnail}} --}}
            <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                <div class="product-cart-wrap mb-25">
                    <div class="product-img-action-wrap">
                        <div class="product-img product-img-zoom">
                            <a href="{{route('product.detail',['slug'=>$item->product->slug])}}">
                                @foreach ($item->product->product_thumbnail as $index => $image)
                                @if($index == 0)
                                <img class="default-img"
                                src="{{asset('storage/product_images/thumbnail/'.$item->product->product_thumbnail[0]->product_thumbnail)}}" alt="{{$item->slug}}">
                                @endif

                                @if($index == 1)
                                <img class="hover-img"
                                src="{{asset('storage/product_images/thumbnail/'.$item->product->product_thumbnail[1]->product_thumbnail)}}" alt="{{$item->slug}}">
                                @endif
                                @endforeach
                                {{-- <img class="default-img" src="{{asset('frontend/assets/imgs/shop/panjabi-2.jpg')}}" alt=""> --}}
                            </a>
                        </div>
                        <div class="product-action-1">
                            <a aria-label="Quick view" class="action-btn hover-up quickview" data-bs-toggle="modal" data-bs-target="#quickViewModal" data-product-slug="{{$item->slug}}">
                                <i class="fi-rs-eye"></i></a>
                            <a aria-label="Add To Wishlist" wire:click.prevent="AddToWishlist({{$item->product->id}})" onclick="wishNotify()" class="action-btn hover-up" href="#"><i class="fi-rs-heart"></i></a>

                        </div>
                        <div class="product-badges product-badges-position product-badges-mrg">
                            <span class="sale">On Sale</span>
                        </div>
                    </div>
                    <div class="product-content-wrap text-center">
                        <h2><a href="{{route('product.detail',['slug'=>$item->product->slug])}}">{{$item->product->product_name}}</a></h2>

                        <div class="product-price">
                            <span>৳{{$item->camp_price}} </span>
                            <span class="old-price">৳{{$item->regular_price}}</span>
                        </div>
                        <div>
                            <div class="text-center">
                            <a href="#" wire:click.prevent="store({{$item->product->id}})" onclick="cartNotify()"><button type="button" class="adto-cart-btn">Add To Cart</button></a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach


        </div>
        <!--End product-grid-4-->
    </div>
<!--End tab-content-->
    <div class="row mt-30">s
        <div class="col-12 text-center">
            <p class="wow fadeIn animated">
                <a class="btn btn-brand text-white btn-shadow-brand hover-up btn-lg">Load More</a>
            </p>
        </div>
    </div>


{{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/vendor/jquery.countdown/css/jquery.countdown.css')}}">

<script src="{{asset('frontend/assets/vendor/jquery.countdown/js/jquery.plugin.min.js')}}"></script>
<script src="{{asset('frontend/assets/vendor/jquery.countdown/js/jquery.countdown.js')}}"></script> --}}

</div>

@push('camp')
<script>

    function cartNotify(){
        $.Notification.autoHideNotify('success', 'top right', 'Success', 'Product added to cart successfully');
    }

    function wishNotify(){
        $.Notification.autoHideNotify('success', 'bottom right', 'Success', 'Product added to wishlist successfully');
    }

</script>
<script>
    $(document).ready(function() {
        var liftoffTime = {!! json_encode($campaign->end_date) !!};
        // var newYear = new Date();
       var newYear = new Date(liftoffTime);
        console.log(newYear);
        $('#camp_counter').countdown({until: newYear, padZeroes: true});
            })

 </script>
@endpush


