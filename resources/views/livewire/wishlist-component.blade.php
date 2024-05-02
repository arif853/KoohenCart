<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow">Home</a>
                <span></span> Shop
                <span></span> Wishlist
            </div>
        </div>
    </div>
    <section class="mt-50 mb-50">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        @if(Cart::instance('wishlist')->count() > 0)


                        <table class="table shopping-summery text-center">
                            <thead>
                                <tr class="main-heading">
                                    <th scope="col">Product</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Action</th>
                                    <th scope="col">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (Cart::instance('wishlist')->content() as $item)
                                <tr>

                                    <td class="product-des product-name">
                                        <h4 class="product-name"><a href="{{route('product.detail',['slug'=>$item->options->slug])}}">{{$item->name}}</a></h4>
                                    </td>
                                    <td class="price" data-title="Price"><span>৳{{$item->price}} </span></td>
                                    <td class="text-center" data-title="Stock">
                                        <span class="color3 font-weight-bold">{{$item->qty}}</span>
                                    </td>
                                    <td class="text-right" data-title="Cart">
                                        <button class="btn btn-sm" wire:click.prevent="store({{$item->id}})" onclick="cartNotify()"><i class="fi-rs-shopping-bag mr-5" ></i>Add to cart</button>
                                    </td>
                                    <td class="action" data-title="Remove"><a href="#" wire:click.prevent="removewish('{{$item->rowId}}')" onclick="wishremove()"><i class="fi-rs-trash text-danger"></i></a></td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                        @else
                            <h4>No Wishlist item found.</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<script>

    function cartNotify(){
        $.Notification.autoHideNotify('success', 'top right', 'Success', 'Product added to cart successfully');
    }
    
    function wishremove(){
        $.Notification.autoHideNotify('danger', 'top right', 'Removed', 'Product remove from wishlist.');
    }
    

</script>
