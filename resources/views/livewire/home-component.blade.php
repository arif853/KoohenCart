
<div>

    <div class="text-center">
        <h3 class="section-title section-title-1 mb-20"><span>All Products</span> </h3>
    </div>
    <div class="new-arrival">
        <div class="row product-grid-4">
            @foreach ($products as $product)
            <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                <div class="product-cart-wrap mb-25">
                    <div class="product-img-action-wrap">
                        <div class="product-img product-img-zoom">
                            @php
                                $fallbackProductImage = asset('frontend/assets/imgs/shop/product-1-1.jpg');
                                $defaultThumb = $product->product_thumbnail->get(0)->product_thumbnail ?? null;
                                $hoverThumb = $product->product_thumbnail->get(1)->product_thumbnail ?? $defaultThumb;
                                $defaultImageUrl = $defaultThumb ? asset('storage/product_images/thumbnail/'.$defaultThumb) : $fallbackProductImage;
                                $hoverImageUrl = $hoverThumb ? asset('storage/product_images/thumbnail/'.$hoverThumb) : $defaultImageUrl;
                            @endphp
                            <a href="{{route('product.detail',['slug'=>$product->slug])}}">
                                <img class="default-img"
                                src="{{$defaultImageUrl}}" alt="{{$product->slug}}">
                                <img class="hover-img"
                                src="{{$hoverImageUrl}}" alt="{{$product->slug}}">

                            </a>
                        </div>

                        <div class="product-action-1">
                            <a aria-label="Quick view" class="action-btn hover-up quickview" data-bs-toggle="modal" data-bs-target="#quickViewModal" data-product-slug="{{$product->slug}}">
                                <i class="fi-rs-eye"></i></a>
                            <a aria-label="Add To Wishlist" class="action-btn hover-up" href="#" wire:click.prevent="AddToWishlist({{$product->id}})" onclick="wishNotify()"><i class="fi-rs-heart"></i></a>
                        </div>
                        @php
                            // effectivePrice() is the single source of truth for what
                            // this product actually costs (campaign > offer > regular),
                            // so listing pages can't drift from what checkout charges.
                            $effectivePrice = $product->effectivePrice();
                            $onSale = $effectivePrice < (float) ($product->regular_price ?? 0);
                        @endphp
                        <div class="product-badges product-badges-position product-badges-mrg">
                            @if($onSale)
                            <span class="sale">On Sale</span>

                            @else
                            {{-- <span class="hot">Hot</span> --}}

                            @endif
                        </div>
                    </div>

                    <div class="product-content-wrap text-center">
                        {{-- <h2><a href="product-details.php">Colorful Pattern Shirts</a></h2> --}}
                        <h2><a href="{{route('product.detail',['slug'=>$product->slug])}}">{{$product->product_name}}</a></h2>
                          <div class="product-price">
                            @if($onSale)
                            <span>৳{{$effectivePrice}} </span>
                            <span class="old-price">৳{{$product->regular_price}}</span>

                            @else
                            <span >৳{{$product->regular_price}}</span>

                            @endif
                        </div>

                        <div>
                            @php
                                $balance = $product->product_stocks->sum('inStock') - $product->product_stocks->sum('outStock');
                            @endphp
                            <div class="text-center">
                                {{-- <a href="#"><button type="button" class="adto-cart-btn">Add To Cart</button></a> --}}
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
            @endforeach
        </div>

        <!--End product-grid-4-->
    </div>
    <!--End tab-content-->
    
    <div class="row mt-30">
        <div class="col-12 text-center mb-4">
            <span wire:loading.delay>
                <button class="btn" type="button" disabled>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Loading...
                  </button>
            </span>
        </div>
        <div class="col-12 text-center" wire:loading.remove>
            <p class="wow fadeIn animated">
                <a wire:click.prevent="loadMore()" class="btn btn-brand text-white btn-shadow-brand hover-up btn-lg" href="#">Load More</a>
            </p>
        </div>
    </div>


   <script>

        function cartNotify(){
            $.Notification.autoHideNotify('success', 'top right', 'Success', 'Product added to cart successfully');
        }

         function wishNotify(){
            $.Notification.autoHideNotify('success', 'bottom right', 'Success', 'Product added to wishlist successfully');
        }

    </script>

</div>

