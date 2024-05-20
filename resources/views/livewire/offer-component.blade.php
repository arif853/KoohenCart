@section('title',$offer->offer_name)
<div>
    {{-- <style>
       .filterbadge {
            color: #FF8B13;
            /* width: 100%; */
            /* height: 30px; */
            border: 1px solid #FF8B13;
            font-size: 12px;
            border-radius: 28px;
            padding: 2px 14px;
            display: inline-block;
            font-weight: 400;
            margin-top: 10px;
            margin-left: 6px;
        }
           .filterbadge .filterclosebtn{
               margin-left: 10px;
               color: #FF8B13;
               font-weight: 500;
           }
   </style> --}}
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route('home')}}" rel="nofollow">Home</a>
                <span></span>  Offer
                <span></span> {{$offer->offer_name}}
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50">
        <div class="container">
            <div class="row">

                <div class="col-lg-12">
                    <div class="shop-product-fillter">
                        <div class="totall-product">
                            {{-- <p> We found <strong class="text-brand">{{$offer->products->total()}}</strong> items for you!</p> --}}

                        </div>

                        <div class="sort-by-product-area">
                            <!-- Add this form at the top of your view -->
                        <form action="#" method="get">
                            <div class="sort-by-cover mr-10">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps"></i>Show:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span> 12 <i class="fi-rs-angle-small-down"></i></span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown">
                                    <ul>
                                        {{-- <li><a href="#" wire:click.prevent= "changePerPage(8)">8</a></li> --}}
                                        <li><a class="active" href="#" wire:click.prevent= "changePerPage(12)">12</a></li>
                                        <li><a href="#" wire:click.prevent= "changePerPage(24)">24</a></li>
                                        <li><a href="#" wire:click.prevent= "changePerPage(48)">48</a></li>
                                        <li><a href="#" wire:click.prevent= "changePerPage(60)">60</a></li>
                                        {{-- <li><a href="#">All</a></li> --}}
                                    </ul>
                                </div>
                            </div>
                        </form>
                            <div class="sort-by-cover">
                                <div class="sort-by-product-wrap">
                                    <div class="sort-by">
                                        <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                    </div>
                                    <div class="sort-by-dropdown-wrap">
                                        <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                                    </div>
                                </div>
                                <div class="sort-by-dropdown">
                                    <ul>
                                        <li><a class="active" href="#">New Arrival</a></li>
                                        <li><a href="#">Price: Low to High</a></li>
                                        <li><a href="#">Price: High to Low</a></li>
                                        <li><a href="#">Popular</a></li>
                                        <li><a href="#">Top Selling</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($offer)
                    <div class="row product-grid-4">
                        @foreach ($offer->products as $product)
                        @if($product->status == 'active')
                        <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                            <div class="product-cart-wrap mb-25">
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="{{route('product.detail',['slug'=>$product->slug])}}">
                                            @foreach ($product->product_images as $index => $image)
                                                @if($index == 0)
                                                <img class="default-img"
                                                src="{{asset('storage/product_images/'.$product->product_images[0]->product_image)}}" alt="{{$product->slug}}">
                                                @endif

                                                @if($index == 1)
                                                <img class="hover-img"
                                                src="{{asset('storage/product_images/'.$product->product_images[1]->product_image)}}" alt="{{$product->slug}}">
                                                @endif
                                                @endforeach

                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a aria-label="Quick view" class="action-btn hover-up quickview" data-bs-toggle="modal" data-bs-target="#quickViewModal" data-product-slug="{{$product->slug}}">
                                            <i class="fi-rs-eye"></i></a>
                                        <a aria-label="Add To Wishlist" class="action-btn hover-up" href="#" wire:click.prevent="AddToWishlist({{$product->id}})" onclick="wishNotify()"><i class="fi-rs-heart"></i></a>
                                    </div>
                                    @php
                                    $flag = 0;
                                    $thisProduct = $product->id;
                                    if ($offer) {
                                        $offer_percentage = $offer->offer_percent;

                                            if ($offer_percentage > 0) {

                                                $offer_price = $product->regular_price - ($product->regular_price * ($offer_percentage/100));
                                                $flag = 1;
                                            }
                                    }

                                    @endphp
                                    <div class="product-badges product-badges-position product-badges-mrg">
                                        @if($flag == 1)
                                        <span class="hot">{{$offer_percentage}}% discount</span>

                                        @else
                                        {{-- <span class="hot">Hot</span> --}}

                                        @endif
                                    </div>
                                </div>
                                <div class="product-content-wrap text-center">
                                    <h2><a href="{{route('product.detail',['slug'=>$product->slug])}}">{{$product->product_name}}</a></h2>

                                    <div class="product-price">
                                        @if($flag == 1)
                                        <span>৳{{$offer_price}} </span>
                                        <span class="old-price">৳{{$product->regular_price}}</span>

                                        @elseif ($product->product_price->offer_price > 0 && $flag == 0)
                                            <span>৳{{$product->product_price->offer_price}} </span>
                                            <span class="old-price">৳{{$product->regular_price}}</span>
                                        @else
                                        <span >৳{{$product->regular_price}}</span>
                                        @endif
                                    </div>
                                    <div>
                                        @if($product->product_stocks)
                                            @php
                                                $balance = $product->product_stocks->sum('inStock') - $product->product_stocks->sum('outStock')
                                            @endphp
                                        @endif
                                        {{-- {{$balance}} --}}
                                        <div class="text-center">
                                            @if($balance>0)
                                            <a href="#" wire:click.prevent="store({{$product->id}})" onclick="cartNotify()"><button type="button" class="adto-cart-btn">Add To Cart</button></a>
                                            @else
                                            <p class="text-danger">Out of stock</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    @else
                    <div class="row product-grid-3">
                        <div class="col-12">
                            <h3>No Product found.</h3>
                        </div>
                    </div>
                    @endif
                    {{$products->links()}}
                    <!--pagination-->
                    {{-- <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-start">
                                <li class="page-item active"><a class="page-link" href="#">01</a></li>
                                <li class="page-item"><a class="page-link" href="#">02</a></li>
                                <li class="page-item"><a class="page-link" href="#">03</a></li>
                                <li class="page-item"><a class="page-link dot" href="#">...</a></li>
                                <li class="page-item"><a class="page-link" href="#">16</a></li>
                                <li class="page-item"><a class="page-link" href="#"><i class="fi-rs-angle-double-small-right"></i></a></li>
                            </ul>
                        </nav>
                    </div> --}}
                </div>
            </div>
        </div>
        <div>


            <ul>

            </ul>
        </div>
    </section>
    <script>

        function cartNotify(){
            $.Notification.autoHideNotify('success', 'top right', 'Success', 'Product added to cart successfully');
        }

        function wishNotify(){
            $.Notification.autoHideNotify('success', 'bottom right', 'Success', 'Product added to wishlist successfully');
        }

 </script>
</div>

@push('shop')
<script>
$(document).ready(function () {
    // // Hide all submenus initially
    // $('.has_sub ul').hide();

    // // Toggle submenu on clicking the plus icon
    // $('.toggle-submenu').click(function(){
    //     $(this).find('i').toggleClass('fa-plus fa-minus');
    //     $(this).next('ul').slideToggle();
    // });
    // $('.category_check').click(function () {
    //     if ($(this).is(':checked')) {

    //         console.log('Checkbox is checked');
    //     } else {

    //         console.log('Checkbox is not checked');
    //     }
    // });
});

    var sliderrange = $('#slider-range');
        var amountprice = $('#amount');
        $(function() {
            sliderrange.slider({
                range: true,
                min: 0,
                max: 10000,
                values: [0, 5000],
                slide: function(event, ui) {
                    // amountprice.val("$" + ui.values[0] + " - $" + ui.values[1]);
                    @this.set('min_value',ui.values[0])
                    @this.set('max_value',ui.values[1])
                }
            });
        // amountprice.val("$" + sliderrange.slider("values", 0) +
        //         " - $" + sliderrange.slider("values", 1));
    });

</script>
@endpush
