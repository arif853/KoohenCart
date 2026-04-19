
<div class="product-cart-wrap">
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
