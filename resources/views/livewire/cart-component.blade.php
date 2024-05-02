
<div>
    {{-- @if(Session::has('success'))
        <div class="alert alert-success">{{$message}}</div>
    @endif --}}
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Home</a>
                    <span></span> Shop
                    <span></span> Your Cart
                </div>
            </div>
        </div>
        <section class="mt-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        @if(Cart::instance('cart')->count() > 0)
                        <div class="table-responsive">
                            <table class="table shopping-summery text-center clean">
                                <thead>
                                    <tr class="main-heading">
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Subtotal</th>
                                        <th scope="col">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach (Cart::instance('cart')->content() as $item)
                                        <tr>
                                            <td class="image product-thumbnail"><img src="{{asset('storage/product_images/'.$item->options->image->product_image)}}" alt="{{$item->options->slug}}"></td>
                                            <td class="product-des product-name">
                                        {{-- <span>{{ Cart::content() }}</span> --}}
                                                <h4 class="product-name"><a href="{{route('product.detail',['slug'=>$item->options->slug])}}">{{$item->name}}</a></h4>
                                            </td>
                                            <td class="price" data-title="Price"><span>৳{{$item->price}} </span></td>
                                            <td class="text-center" data-title="Stock">
                                                <div class="detail-qty border radius  m-auto">
                                                    <a href="#" wire:click.prevent="decreaseQuantity('{{$item->rowId}}')" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                                    <span class="qty-val">{{$item->qty}}</span>
                                                    <a href="#" wire:click.prevent="increaseQuantity('{{$item->rowId}}')" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                                </div>
                                            </td>
                                            <td class="text-right" data-title="Cart">
                                                <span>৳{{$item->subtotal}} </span>
                                            </td>
                                            <td class="action" data-title="Remove"><a href="#" wire:click.prevent="removecart('{{$item->rowId}}')" class="text-danger"><i class="fi-rs-trash"></i></a></td>
                                        </tr>
                                        @endforeach

                                </tbody>
                                <tfoot class="text-end">
                                    <tr>
                                        {{-- <td></td>
                                        <td></td>
                                        <td></td> --}}
                                        <td colspan="3" style="border: none"></td>
                                        <td class="cart_total_label ">Cart Subtotal:</td>
                                        <td class="cart_total_amount"><span class="font-lg fw-900 text-brand">৳{{Cart::subtotal()}}</span></td>
                                    </tr>
                                    <tr>
                                        {{-- <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td> --}}
                                        <td colspan="3" style="border: none"></td>

                                        <td class="cart_total_label">Discount:</td>
                                        <td class="cart_total_amount"> <span class="font-xl fw-900 text-brand">৳{{0}}</span></td>
                                    </tr>
                                    <tr>
                                        {{-- <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td> --}}
                                        <td colspan="3" style="border: none"></td>

                                        <td class="cart_total_label ">Total:</td>
                                        <td class="cart_total_amount"><strong><span class="font-xl fw-900 text-brand">৳{{Cart::subtotal() }}</span></strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="divider center_icon mt-10 mb-20"><i class="fi-rs-fingerprint"></i></div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="total-amount">
                                    <div class="left">
                                        <div class="coupon">
                                            <form action="#" target="_blank">
                                                <div class="form-row row justify-content-center">
                                                    <div class="form-group col-lg-6">
                                                        <input class="font-medium" name="Coupon" placeholder="Enter Your Coupon">
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <button class="btn  btn-sm"><i class="fi-rs-label mr-10"></i>Apply</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="cart-action text-end mb-4">
                                    {{-- <a class="btn  mr-10 mb-sm-15"><i class="fi-rs-shuffle mr-10"></i>Update Cart</a> --}}
                                    <a class="btn  mr-10 mb-sm-15" href="{{route('shop')}}"><i class="fi-rs-shopping-bag mr-10"></i>Continue Shopping</a>
                                    <a href="{{route('checkout')}}" class="btn "> <i class="fi-rs-box-alt mr-10"></i> Proceed To CheckOut</a>
                                </div>
                            </div>
                        </div>

                        @else
                        <div class="mb-4">
                            <h4 class="mb-2 text-center">No items found in cart.</h4>
                            <h6 class="mb-2 text-center">Go to shop.</h6>
                        <div class="divider center_icon mt-10 mb-20"><i class="fi-rs-fingerprint"></i></div>
                            <div class="text-center">
                                <a class="btn  mr-10 mb-sm-15" href="{{route('shop')}}"><i class="fi-rs-shopping-bag mr-10"></i>Continue Shopping</a>
                            </div>
                        </div>

                        @endif
                        {{-- <div class="divider center_icon mt-50 mb-50"><i class="fi-rs-fingerprint"></i></div> --}}

                        {{-- <div class="row mb-50">
                            <div class="col-lg-6 col-md-12">
                                <div class="heading_s1 mb-3">
                                    <h4>Calculate Shipping</h4>
                                </div>
                                <p class="mt-15 mb-30">Flat rate: <span class="font-xl text-brand fw-900">5%</span></p>
                                <form class="field_form shipping_calculator">
                                    <div class="form-row">
                                        <div class="form-group col-lg-12">
                                            <div class="custom_select">
                                                <select class="form-control select-active">
                                                    <option value="">Choose a option...</option>
                                                    <option value="AX">Aland Islands</option>
                                                    <option value="AF">Afghanistan</option>
                                                    <option value="AL">Albania</option>
                                                    <option value="DZ">Algeria</option>
                                                    <option value="AD">Andorra</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row row">
                                        <div class="form-group col-lg-6">
                                            <input required="required" placeholder="State / Country" name="name" type="text">
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <input required="required" placeholder="PostCode / ZIP" name="name" type="text">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-lg-12">
                                            <button class="btn  btn-sm"><i class="fi-rs-shuffle mr-10"></i>Update</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="mb-30 mt-50">
                                    <div class="heading_s1 mb-3">
                                        <h4>Apply Coupon</h4>
                                    </div>
                                    <div class="total-amount">
                                        <div class="left">
                                            <div class="coupon">
                                                <form action="#" target="_blank">
                                                    <div class="form-row row justify-content-center">
                                                        <div class="form-group col-lg-6">
                                                            <input class="font-medium" name="Coupon" placeholder="Enter Your Coupon">
                                                        </div>
                                                        <div class="form-group col-lg-6">
                                                            <button class="btn  btn-sm"><i class="fi-rs-label mr-10"></i>Apply</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="border p-md-4 p-30 border-radius cart-totals">
                                    <div class="heading_s1 mb-3">
                                        <h4>Cart Totals</h4>
                                    </div>
                                    <div class="table-responsive mb-2">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td class="cart_total_label">Cart Subtotal</td>
                                                    <td class="cart_total_amount"><span class="font-lg fw-900 text-brand">৳{{Cart::subtotal()}}</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Shipping</td>
                                                    <td class="cart_total_amount"> <span class="font-xl fw-900 text-brand">৳{{Cart::tax()}}</span></td>
                                                </tr>
                                                <tr>
                                                    <td class="cart_total_label">Total</td>
                                                    <td class="cart_total_amount"><strong><span class="font-xl fw-900 text-brand">৳{{Cart::total()}}</span></strong></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <a href="{{route('checkout')}}" class="btn "> <i class="fi-rs-box-alt mr-10"></i> Proceed To CheckOut</a>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
    <script>
        dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
        dataLayer.push({
          event: "add_to_cart",
          ecommerce: {
            currency: "BDT",
            items: [@foreach (Cart::instance('cart')->content() as $product)
            {
              item_id: "{{ $product->id }}",
              item_name: "{{ $product->name }}",
              index: 0,
              item_brand: "{{ $product->brand_name ?? "" }}",
              item_category: "{{ $product->category_name ?? "" }}",
              item_category2: "{{ $product->category_name2 ?? "" }}",
              item_category3: "{{ $product->category_name3 ?? "" }}",
              item_category4: "{{ $product->category_name4 ?? "" }}",
              price: {{ $product->price }},
              quantity: {{ $product->qty ?? 0 }}
            },@endforeach
            ]
          }
        });
</script>
