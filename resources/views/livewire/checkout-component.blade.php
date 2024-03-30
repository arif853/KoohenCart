

<div>
    <style>
        .form-select-size
        {
            width: 40px;
            height: 20px;
        }
    </style>
    {{-- Delivery Charge: {{ $deliveryCharge }} --}}
    @if(Cart::instance('cart')->count() > 0  )
    <div class="table-responsive order_table text-center">
        <table class="table">
            <thead>
                <tr>
                    <th colspan="2">Product</th>
                    {{-- <th colspan="1">Qty</th> --}}
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                $total = 0;
                $discount = 0;
                @endphp
                {{-- cart item --}}
                @foreach (Cart::instance('cart')->content() as $item)
                <tr>
                    <td class="image product-thumbnail">

                        <img src="{{asset('storage/product_images/'.$item->options->image->product_image)}}" alt="{{$item->options->image->product_image}}">
                        @php
                        $color = DB::table('colors')->where('id', $item->options->color)->first();
                        if ($color) {
                            // Access the properties of $color
                            $colorName = $color->color_name;
                        } else {
                            // Handle the case when no record is found
                            $colorName = 'No color';
                        }
                        @endphp
                        <p style="font-size: 12px; margin-bottom:0;">Color: {{$colorName}}</p>
                        @php
                            $size = DB::table('sizes')->where('id', $item->options->size)->first();
                            if ($size) {
                                // Access the properties of $color
                                $sizeName = $size->size;
                            } else {
                                // Handle the case when no record is found
                                $sizeName = null;
                            }
                            @endphp
                        <p style="font-size: 12px; margin:0;">Size:
                                @php
                                    $sizesData = DB::table('products_sizes')
                                                ->join('sizes', 'products_sizes.size_id', '=', 'sizes.id')
                                                ->where('products_sizes.product_id', $item->id)
                                                ->select('sizes.*') // Select the columns you need from both tables
                                                ->get();
                                @endphp
                            <select name="size_id" id="size_id" class="form-select-size">
                                @foreach ($sizesData as $data)

                                    @php
                                    $sizeStock = DB::table('product_stocks')
                                        ->where('product_id', $item->id)
                                        ->where('size_id', $data->id)
                                        ->first();

                                        if ($sizeStock) {
                                            # code...
                                            $b_stock = $sizeStock->inStock - $sizeStock->outStock;
                                        }
                                        @endphp
                                    @if ($sizeStock && $b_stock > 0)
                                        <option value="{{$data->id}}" {{$sizeName == $data->size ? 'Selected':''}} >{{$data->size_name}}</option>
                                    @endif

                                @endforeach
                            </select>
                        </p>

                        {{-- <input type="hidden" name="size_id" id="size_id" value="{{$item->options->size}}"> --}}
                        <input type="hidden" name="color_id" id="color_id" value="{{$item->options->color}}">
                    </td>
                    <td>
                        <h5><a href="{{route('product.detail',['slug'=>$item->options->slug])}}">{{$item->name}}</a></h5>
                        <span class="product-qty mt-4">
                            <a href="#" wire:click.prevent="decreaseQuantity('{{$item->rowId}}')" class="qty-down">
                                <i class="fi-rs-angle-small-down"></i>
                            </a>
                            <span class="qty-val">{{$item->qty}}</span>

                            <a href="#" wire:click.prevent="increaseQuantity('{{$item->rowId}}')" class="qty-up">
                                <i class="fi-rs-angle-small-up"></i>
                            </a>
                        </span>
                    </td>
                    <td>৳{{$item->subtotal}}</td>
                </tr>

                @php
                // Increment total for each item
                $total += $item->subtotal;
                @endphp
                @endforeach
                {{-- cart loop end --}}

                <!-- Subtotal row -->
                <tr>
                    <th class="text-end">SubTotal</th>
                    <td class="product-subtotal">{{Cart::instance('cart')->count()}}</td>
                    <td class="product-subtotal" colspan="1">৳{{$total}}</td>
                    <input type="hidden" name="subtotal" value="{{$total}}">
                </tr>
                <!-- Delivery charge row -->
                <tr>
                    <th class="text-end">Delivery Charge</th>
                    {{-- @if( $deliveryCharge)
                        <td colspan="3"><em>৳{{ $deliveryCharge }}</em></td>
                        <input type="hidden" name="shipping_cost" id="shipping_cost" value="{{ $deliveryCharge }}">
                    @else --}}
                    <td colspan="3"><em>৳{{$deliveryCharge}}</em></td>

                    <input type="hidden" name="shipping_cost" id="shipping_cost" value="{{$deliveryCharge}}">
                    {{-- @endif --}}

                </tr>
                 <!-- Discount row -->
                <tr>
                    <th class="text-end">Discount</th>
                    <td colspan="3"><em id="discountValue">৳{{$discount}}</em></td>
                    <input type="hidden" name="discount" id="discount" value="{{$discount}}">
                    <input type="hidden" name="coupon_code" id="coupon_code" >
                </tr>
                 <!-- Total row -->
                <tr>
                    <th class="text-end">Total</th>
                    @if($deliveryCharge)
                    <td colspan="3" class="product-subtotal">
                        @php
                            $total =  $total - $discount + $deliveryCharge ;
                        @endphp
                        <span class="font-xl text-brand fw-900">৳{{$total }}</span>
                        <input type="hidden" name="total_amount" id="t_amount" value="{{$total }}">
                    </td>
                    @else
                    <td colspan="3" class="product-subtotal">
                        @php
                        $total =  $total - $discount + $deliveryCharge ;
                    @endphp
                        <span id="totalAmount" class="font-xl text-brand fw-900">৳{{$total}}</span>
                            <input type="hidden" name="total_amount" id="t_amount" value="{{$total}}">
                    </td>
                    @endif
                </tr>
            </tbody>
        </table>
    </div>
    @else
    <h5>No item found. </h5>

    @endif
</div>

