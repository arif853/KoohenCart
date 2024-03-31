@extends('layouts.admin')
@section('title','Orders-'.$order->id)
@section('content')

<style>
    .icontext span {
        font-size: 12px;
        font-weight: 400;
        display: inline-block;
    }
    .color-select{
        background-color: #f4f5f9;
        border: 2px solid #f4f5f9;
        font-size: 13px;
        -webkit-box-shadow: none;
        box-shadow: none;
        padding-left: 16px;
        color: #4f5d77;
        width: 80px;
        border-radius: 4px;
        height: 36px;
    }
    .size-select{
        background-color: #f4f5f9;
        border: 2px solid #f4f5f9;
        font-size: 13px;
        -webkit-box-shadow: none;
        box-shadow: none;
        padding-left: 16px;
        color: #4f5d77;
        width: 80px;
        border-radius: 4px;
        height: 36px;
    }
</style>

    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Order detail</h2>
            <p>Details for Order ID: {{$order->id}}</p>
        </div>
        <div class="content-header">
            <a href="javascript:history.back()"><i class="material-icons md-arrow_back"></i> Go back </a>
        </div>
    </div>
    <div class="card">
        <header class="card-header">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 mb-lg-0 mb-15">
                    <span>
                        <i class="material-icons md-calendar_today"></i> <b>{{$order->created_at->setTimezone('Asia/Dhaka')->format('D, M j, Y, g:iA')}}</b>
                    </span> <br>
                    <small class="text-muted">Order ID: {{$order->id}}</small>
                </div>
                <div class="col-lg-6 col-md-6 ms-auto text-md-end">
                    {{-- <select class="form-select d-inline-block mb-lg-0 mb-15 mw-200">
                        <option>Change status</option>
                        <option>Awaiting payment</option>
                        <option>Confirmed</option>
                        <option>Shipped</option>
                        <option>Delivered</option>
                    </select> --}}
                    {{-- <a class="btn btn-primary" href="#">Save</a> --}}
                    <a class="btn btn-secondary print ms-2" href="{{ url('/orders/invoice/'.$order->id) }}"><i class="icon material-icons md-print"></i></a>
                </div>
            </div>
        </header> <!-- card-header end// -->
        <div class="card-body">
            <div class="row mb-50 mt-20 order-info-wrap">
                <div class="col-md-4">
                    <article class="icontext align-items-start">
                        <span class="icon icon-sm rounded-circle bg-primary-light">
                            <i class="text-primary material-icons md-person"></i>
                        </span>
                        <div class="text">
                            <h6 class="mb-1">Customer</h6>
                            <p class="mb-1">
                                {{$order->customer->firstName}} {{$order->customer->lastName}} <br> {{$order->customer->email}} <br> {{$order->customer->phone}}
                            </p>
                            <a href="{{route('customer.profile', ['id' => $order->customer->id])}}">View profile</a>
                        </div>
                    </article>
                </div> <!-- col// -->
                <div class="col-md-4">
                    <article class="icontext align-items-start">
                        <span class="icon icon-sm rounded-circle bg-primary-light">
                            <i class="text-primary material-icons md-local_shipping"></i>
                        </span>
                        <div class="text">
                            <h6 class="mb-1">Order info</h6>

                            <p class="mb-1">
                                Shipping: Global Shipping <br> Pay method: {{$order->transaction->mode}} <br>
                                Status:
                                @if($order->status == 'pending')
                                <span class="badge rounded-pill alert-primary">{{$order->status}}</span>

                                @elseif($order->status == 'confirmed')
                                <span class="badge rounded-pill alert-info ">{{$order->status}}</span>

                                @elseif($order->status == 'shipped')
                                <span class="badge rounded-pill alert-warning">{{$order->status}}</span>

                                @elseif($order->status == 'delivered')
                                <span class="badge rounded-pill alert-success">{{$order->status}}</span>

                                @elseif($order->status == 'completed')
                                <span class="badge rounded-pill alert-success">{{$order->status}}</span>

                                @elseif($order->status == 'returned')
                                <span class="badge rounded-pill alert-danger">{{$order->status}}</span>

                                @elseif($order->status == 'cancelled')
                                <span class="badge rounded-pill alert-danger">{{$order->status}}</span>
                                @endif
                            </p>
                            {{-- <a href="#">Download info</a> --}}
                        </div>
                    </article>
                </div> <!-- col// -->
                <div class="col-md-4">
                    @if ($district)

                    <article class="icontext align-items-start">
                        <span class="icon icon-sm rounded-circle bg-primary-light">
                            <i class="text-primary material-icons md-place"></i>
                        </span>
                        <div class="text">
                            <h6 class="mb-1">Deliver to</h6>
                            <p class="mb-1">
                                City: {{$district->name}},<br> Area: {{$postOffice->postOffice}} <br>
                                {{$order->customer->billing_address}}

                            </p>
                            <a href="#">View profile</a>
                        </div>
                    </article>
                        @endif

                </div> <!-- col// -->
            </div> <!-- row // -->
            <div class="row">
                <div class="col-lg-7">
                    {{-- <form id="orderUpdateForm"> --}}
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th width="10%"><a href="#" class="order-btn"><i class="fas fa-plus"></i></a></th>
                                        <th width="40%">Product</th>
                                        <th >Unit Price</th>
                                        <th >Quantity</th>
                                        <th width="10%" class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderProducts as $product)
                                    <tr>
                                        <td>
                                            <a href="#" class="order-btn btn-delete"><i class="fas fa-trash"></i></a>
                                            <a href="#" class="order-btn btn-edit"><i class="fas fa-pen"></i></a>

                                            <a class="order-btn btn-save" style="display: none;"><i class="fas fa-check"></i></a>
                                            <button type="button" class="order-btn btn-cancel" style="display: none;"><i class="fas fa-times"></i></button>
                                        </td>
                                        <td>
                                            <a class="itemside" href="#">
                                                <div class="left">
                                                    <img src="{{asset('storage/product_images/'. $product->product_images->first()->product_image)}}" width="40" height="40" class="img-xs" alt="Item">
                                                </div>
                                                <div class="info">
                                                    <span class="product-name">{{$product->product_name}},</span>
                                                    <br>
                                                    @if ($product->color)
                                                    <span class="product-color">{{$product->color->color_name}},</span>
                                                    @endif
                                                <br>
                                                    @if($product->size)
                                                    <span class="product-size">{{$product->size->size_name}}</span>
                                                    @endif
                                                </div>
                                                </div>
                                            </a>
                                        </td>
                                        <td>৳{{$product->price}} </td>
                                        <td> {{$product->quantity}} </td>
                                        <td class="text-end"> ৳{{$product->price * $product->quantity}} </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5">
                                            <article class="float-end">
                                                <dl class="dlist">
                                                    <dt>Subtotal:</dt>
                                                    <dd id="subtotal">৳{{$order->subtotal}}</dd>
                                                </dl>
                                                <dl class="dlist">
                                                    <dt>Shipping cost:</dt>
                                                    <dd id="delivery_charge">৳{{$order->delivery_charge}}</dd>
                                                </dl>
                                                <dl class="dlist">
                                                    <dt>Discount :</dt>
                                                    <dd id="discount">৳{{$order->discount}}</dd>
                                                </dl>
                                                <dl class="dlist">
                                                    <dt>Grand total:</dt>
                                                    <dd> <b class="h5" id="g_total">৳{{$order->total}}</b> </dd>
                                                </dl>
                                                <dl class="dlist">
                                                    <dt>Paid :</dt>
                                                    <dd id="totalPaid">৳{{$order->total_paid}}</dd>
                                                </dl>
                                                <dl class="dlist">
                                                    <dt>Due :</dt>
                                                    <dd id="totalDue">৳{{$order->total_due}}</dd>
                                                </dl>
                                                <dl class="dlist">
                                                    <dt class="text-muted">Payment Status:</dt>
                                                    <dd>
                                                        <span class="badge rounded-pill alert-success text-success" style="text-transform: uppercase;">{{$order->transaction->status}}</span>
                                                    </dd>
                                                </dl>
                                            </article>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div> <!-- table-responsive// -->
                    {{-- </form> --}}
                    <a class="btn btn-primary" href="{{route('order.track', ['id' => $order->id])}}">View Order Tracking</a>
                </div> <!-- col// -->
                <div class="col-lg-1"></div>
                <div class="col-lg-4">
                    <div class="box shadow-sm bg-light">
                        <h6 class="mb-15">Payment info</h6>
                        <p>
                            @if($order->transaction->mode == 'cod')
                            Cash On delivery <br>
                            Charge: {{$order->delivery_charge}}
                            <br>
                            @else
                                Master Card **** **** 4768 <br>
                                Business name: Grand Market LLC <br>
                                Phone: +1 (800) 555-154-52
                            @endif
                        </p>
                    </div>
                    <div class="h-25 pt-4">
                        <div class="mb-3">
                            <label>Notes</label>
                            <textarea class="form-control" name="notes" id="notes" placeholder="Type some note"></textarea>
                        </div>
                        <button class="btn btn-primary">Save note</button>
                    </div>
                </div> <!-- col// -->
            </div>
        </div> <!-- card-body end// -->
    </div> <!-- card end// -->

@endsection
@push('order_status')
<script>
    $(document).ready(function() {
        $('.btn-edit').on('click', function(e) {
            e.preventDefault();
            var $row = $(this).closest('tr');
            var productName = $row.find('.product-name').text();
            var productColor = $row.find('.product-color').text();
            var productSize = $row.find('.product-size').text();
            var price = parseInt($row.find('td:nth-child(3)').text().replace('৳', ''), 10);
            var quantity = parseInt($row.find('td:nth-child(4)').text(), 10);
            var deliveryCharge = parseInt($('#delivery_charge').text().replace('৳', ''), 10);
            var discount = parseInt($('#discount').text().replace('৳', ''), 10);
            var paidAmount = parseInt($('#totalPaid').text().replace('৳', ''), 10);
            var total = price * quantity;

            var $productCell = $row.find('td:nth-child(2)');
            $productCell.empty();
            $productCell.append($('<span>').text(productName));
            $productCell.append($('<select>').addClass('color-select  mt-2').append($('<option>').text(productColor)));
            $productCell.append($('<select>').addClass('size-select  mt-2').append($('<option>').text(productSize)));

            $row.find('td:nth-child(3)').html($('<input>').addClass('form-control price').attr('type', 'text').val(price));
            $row.find('td:nth-child(4)').html($('<input>').addClass('form-control quantity').attr('type', 'number').attr('min',0).val(quantity));
            $row.find('td:nth-child(5)').text(total);

            $('#delivery_charge').html($('<input>').addClass('color-select deliveryCharge').attr('type','number').val(deliveryCharge));
            $('#discount').html($('<input>').addClass('color-select discount').attr('type','number').val(discount));
            $('#totalPaid').html($('<input>').addClass('color-select totalPaid').attr('type','number').val(paidAmount));

            // Show save and cancel buttons
            $row.find('.btn-save, .btn-cancel').show();
            $row.find('.btn-delete').hide();
            // Hide edit button
            $(this).hide();

                // Update total on quantity change
            $row.find('.price, .quantity').on('input', function() {
                var newPrice = parseInt($('.price').val(), 10);
                var newQuantity = parseInt($('.quantity').val(), 10);
                var newTotal = newPrice * newQuantity;
                $row.find('td:nth-child(5)').text('৳' + newTotal);
                $row.find('td:nth-child(5)').append($('<input>').addClass('total').attr('type', 'hidden').attr('min',0).val(newTotal));
                $("#subtotal").text('৳' + newTotal);
                $("#subtotal").append($('<input>').addClass('subtotal').attr('type', 'hidden').attr('min',0).val(newTotal));
                var grandTotal = newTotal + deliveryCharge - discount;
                $("#g_total").text('৳' + grandTotal);
                $("#g_total").append($('<input>').addClass('g_total').attr('type', 'hidden').attr('min',0).val(grandTotal));
                if(grandTotal > paidAmount)
                {
                    var due = grandTotal - paidAmount;
                    $("#totalDue").text('৳' + due);
                    $("#totalDue").append($('<input>').addClass('totalDue').attr('type', 'hidden').attr('min',0).val(due));
                }
                if(grandTotal == paidAmount)
                {
                    var due = 0;
                    $("#totalDue").text('৳' + due);
                    $("#totalDue").append($('<input>').addClass('totalDue').attr('type', 'hidden').attr('min',0).val(due));
                }

            });


        });

        $('.btn-cancel').on('click', function() {
            var $row = $(this).closest('tr');
            // Restore original content
            // For simplicity, I'm just reloading the page, you might want to handle this differently
            window.location.reload();
        });

        $('.btn-save').on('click', function() {
            var $row = $(this).closest('tr');
            var productName = $row.find('input[type="text"]').val();
            var productColor = $row.find('.color-select').val();
            var productSize = $row.find('.size-select').val();
            var price = parseInt($row.find('.price').val(), 10);
            var quantity = parseInt($row.find('.quantity').val(), 10);
            var total = price * quantity;
            console.log(productName)
            console.log(productColor)
            console.log(productSize)
            console.log(price)
            console.log(quantity)
            console.log(total)
            // Save the changes
            // For simplicity, I'm just reloading the page, you might want to handle this differently
            // window.location.reload();

            // $('#orderUpdateForm').submit(function(){
            //     e.preventDefault();
            //     const data = new FormData(this);
            //     console.log(data);
            // });

        });
    });
</script>
@endpush
