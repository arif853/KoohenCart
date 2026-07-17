<div class="row product-grid-4">
    
    @foreach ($Newproducts as $newproduct)
    <div class="col-lg-3 col-md-4 col-12 col-sm-6">
        <div class="product-cart-wrap mb-25">
            <div class="product-img-action-wrap">
                <div class="product-img product-img-zoom">
                    @php
                        $fallbackProductImage = asset('frontend/assets/imgs/shop/product-1-1.jpg');
                        $defaultThumb = $newproduct->product_thumbnail->get(0)->product_thumbnail ?? null;
                        $hoverThumb = $newproduct->product_thumbnail->get(1)->product_thumbnail ?? $defaultThumb;
                        $defaultImageUrl = $defaultThumb ? asset('storage/product_images/thumbnail/'.$defaultThumb) : $fallbackProductImage;
                        $hoverImageUrl = $hoverThumb ? asset('storage/product_images/thumbnail/'.$hoverThumb) : $defaultImageUrl;
                    @endphp
                    <a href="{{route('product.detail',['slug'=>$newproduct->slug])}}">
                            <img class="default-img"
                            src="{{$defaultImageUrl}}" alt="{{$newproduct->slug}}">
                            <img class="hover-img"
                            src="{{$hoverImageUrl}}" alt="{{$newproduct->slug}}">

                    </a>
                </div>
                <div class="product-action-1">
                    <a aria-label="Quick view" class="action-btn hover-up quickview" data-bs-toggle="modal" data-bs-target="#quickViewModal" data-product-slug="{{$newproduct->slug}}">
                                <i class="fi-rs-eye"></i></a>
                    <a aria-label="Add To Wishlist" class="action-btn hover-up" href="#" wire:click.prevent="AddToWishlist({{$newproduct->id}})" onclick="wishNotify()"><i class="fi-rs-heart"></i></a>
                </div>
                
                  @php
                    // effectivePrice() is the single source of truth for what this
                    // product actually costs (campaign > offer > regular).
                    $effectivePrice = $newproduct->effectivePrice();
                    $onSale = $effectivePrice < (float) ($newproduct->regular_price ?? 0);
                @endphp

                <div class="product-badges product-badges-position product-badges-mrg">
                    @if($onSale)
                    <span class="sale">On Sale</span>

                    @else
                    <span class="new">New</span>

                    @endif
                </div>
            </div>
            <div class="product-content-wrap text-center">
                <h2><a href="{{route('product.detail',['slug'=>$newproduct->slug])}}">{{$newproduct->product_name}}</a></h2>

                <div class="product-price">
                    @if($onSale)
                    <span>৳{{$effectivePrice}} </span>
                    <span class="old-price">৳{{$newproduct->regular_price}}</span>

                    @else
                    <span>৳{{$newproduct->regular_price}} </span>

                    @endif
                </div>
                <div>
                    @php
                        $balance = $newproduct->product_stocks->sum('inStock') - $newproduct->product_stocks->sum('outStock');
                    @endphp
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
