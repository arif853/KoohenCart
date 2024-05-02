
    <div class="carausel-4-columns-cover arrow-center position-relative">

        <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-arrows"></div>

        <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns">

            @foreach ($products as $product)
            <div class="product-cart-wrap">
                <div class="product-img-action-wrap">
                    <div class="product-img product-img-zoom">
                        <a href="{{route('product.detail',['slug'=>$product->slug])}}">

                                @foreach ($product->product_thumbnail as $index => $image)
                                @if($index == 0)
                                <img class="default-img"
                                src="{{asset('storage/product_images/thumbnail/'.$product->product_thumbnail[0]->product_thumbnail)}}" alt="{{$product->slug}}">
                                @endif
    
                                @if($index == 1)
                                <img class="hover-img"
                                src="{{asset('storage/product_images/thumbnail/'.$product->product_thumbnail[1]->product_thumbnail)}}" alt="{{$product->slug}}">
                                @endif
                                @endforeach
                        </a>
                    </div>
                    <div class="product-action-1">
                        <a aria-label="Quick view" class="action-btn hover-up quickview" data-bs-toggle="modal" data-bs-target="#quickViewModal" data-product-slug="{{$product->slug}}">
                                <i class="fi-rs-eye"></i></a>
                        <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                    </div>
                    <div class="product-badges product-badges-position product-badges-mrg">
                        <span class="hot">Hot</span>
                    </div>
                </div>
                <div class="product-content-wrap">
                    <h2><a href="{{route('product.detail',['slug'=>$product->slug])}}">{{$product->product_name}}</a></h2>
                        <div class="product-price pt16">
                            @if ($product->product_price->offer_price > 0)
                                <span>৳{{$product->product_price->offer_price}} </span>
                                <span class="old-price">৳{{$product->regular_price}}</span>
                            @else
                                <span >৳{{$product->regular_price}} </span>

                            @endif
                        </div>
                    <div class="product-action-1 show">
                        {{-- <a href="#" wire:click.prevent="store({{$product->id}})" ><button type="button" class="adto-cart-btn">Add To Cart</button></a> --}}

                        <a aria-label="Add To Cart" wire:click.prevent="store({{$product->id}})"  class="action-btn hover-up" href="#"><i class="fi-rs-shopping-bag-add"></i></a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>


