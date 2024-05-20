<div class="row product-grid-4">
    
    @foreach ($Newproducts as $newproduct)
    <div class="col-lg-3 col-md-4 col-12 col-sm-6">
        <div class="product-cart-wrap mb-25">
            <div class="product-img-action-wrap">
                <div class="product-img product-img-zoom">
                    <a href="{{route('product.detail',['slug'=>$newproduct->slug])}}">
                        @foreach ($newproduct->product_thumbnail as $index => $image)
                            @if($index == 0)
                            <img class="default-img"
                            src="{{asset('storage/product_images/thumbnail/'.$newproduct->product_thumbnail[0]->product_thumbnail)}}" alt="{{$newproduct->slug}}">
                            @endif

                            @if($index == 1)
                            <img class="hover-img"
                            src="{{asset('storage/product_images/thumbnail/'.$newproduct->product_thumbnail[1]->product_thumbnail)}}" alt="{{$newproduct->slug}}">
                            @endif
                            @endforeach

                    </a>
                </div>
                <div class="product-action-1">
                    <a aria-label="Quick view" class="action-btn hover-up quickview" data-bs-toggle="modal" data-bs-target="#quickViewModal" data-product-slug="{{$newproduct->slug}}">
                                <i class="fi-rs-eye"></i></a>
                    <a aria-label="Add To Wishlist" class="action-btn hover-up" href="#" wire:click.prevent="AddToWishlist({{$newproduct->id}})" onclick="wishNotify()"><i class="fi-rs-heart"></i></a>
                </div>
                
                  @php
                    $thisProduct = $newproduct->id;
                    $flag = 0;
                    if ($campaign) {
                        $camp_products = $campaign->camp_product;
                        foreach ($camp_products as $key => $camp_product) {
                            if ($thisProduct == $camp_product->product_id) {
                                $camp_price = $camp_product->camp_price;
                                $flag = 1;

                            }
                        }
                    }
                @endphp

                <div class="product-badges product-badges-position product-badges-mrg">
                    @if($flag == 1)
                    <span class="sale">On Sale</span>

                    @else
                    <span class="new">New</span>

                    @endif
                </div>
            </div>
            <div class="product-content-wrap text-center">
                <h2><a href="{{route('product.detail',['slug'=>$newproduct->slug])}}">{{$newproduct->product_name}}</a></h2>

                <div class="product-price">
                    @if($flag == 1)
                    <span>৳{{$camp_price}} </span>
                    <span class="old-price">৳{{$newproduct->regular_price}}</span>
                    <!--{{$flag}}-->

                    @elseif ($newproduct->product_price->offer_price > 0)
                    <span>৳{{$newproduct->product_price->offer_price}} </span>
                    <span class="old-price">৳{{$newproduct->regular_price}}</span>
                    <!--{{$flag}}-->

                    @else
                    <span>৳{{$newproduct->regular_price}} </span>

                    @endif
                </div>
                <div>
                     @if($newproduct->product_stocks)
                        @php
                            $balance = $newproduct->product_stocks->sum('inStock') - $newproduct->product_stocks->sum('outStock')
                        @endphp
                    @endif
                    <div class="text-center">
                        @if($balance>0)
                        <a href="#" wire:click.prevent="store({{$newproduct->id}})" onclick="cartNotify()"><button type="button" class="adto-cart-btn">Add To Cart</button></a>
                        @else
                        <p class="text-danger">Out of stock</p>
                        @endif
                        {{-- <a href="#"><button type="button" class="adto-cart-btn">Add To Cart</button></a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
 <script>

        function cartNotify(){
            $.Notification.autoHideNotify('success', 'top right', 'Success', 'Product added to cart successfully');
        }
        
         function wishNotify(){
            $.Notification.autoHideNotify('success', 'bottom right', 'Success', 'Product added to wishlist successfully');
        }

    </script>

</div>
