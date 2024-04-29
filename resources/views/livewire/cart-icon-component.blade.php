<div>
    <div class="header-action-icon-2">
        <a class="mini-cart-icon" href="{{route('cart')}}">
            <i class="fal fa-shopping-bag"></i>
            @if(Cart::instance('cart')->count() > 0)
            <span class="pro-count blue">{{Cart::count()}}</span>
            @endif
        </a>
        @if(Cart::instance('cart')->count() > 0)
        <div class="cart-dropdown-wrap cart-dropdown-hm2">
            <ul>
                @foreach (Cart::instance('cart')->content() as $item)
                <li>
                    <div class="shopping-cart-img">
                        <a href="{{route('cart')}}"><img alt="{{$item->options->slug}}" src="{{asset('storage/product_images/'.$item->options->image->product_image)}}"></a>
                    </div>
                    <div class="shopping-cart-title">
                        <h4><a href="{{route('cart')}}">{{substr($item->name,0,20)}}</a></h4>
                        <h3><span>{{$item->qty}} × </span>${{$item->price}}</h3>
                    </div>
                    <div class="shopping-cart-delete">
                        <a href="#" wire:click.prevent="removecart('{{$item->rowId}}')"><i class="fi-rs-cross-small"></i></a>
                    </div>
                </li>
                @endforeach
            </ul>
            <div class="shopping-cart-footer">
                <div class="shopping-cart-total">
                    <h4>Total <span>${{Cart::instance('cart')->subtotal()}}</span></h4>
                </div>
                <div class="shopping-cart-button">
                    <a href="{{route('cart')}}" class="outline">View cart</a>
                    <a href="{{route('checkout')}}">Checkout</a>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
