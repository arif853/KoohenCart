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
                                        <th width="10%">
                                            <a href="#" class="order-btn" data-bs-toggle="modal" data-bs-target="#newItemModal"
                                            data-customer-id="{{ $order->id }}"><i class="fas fa-plus"></i></a>
                                        </th>
                                        <th width="40%">Product</th>
                                        <th >Unit Price</th>
                                        <th >Quantity</th>
                                        <th width="10%" class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orderProducts as $product)
                                    <input type="hidden" name="orderId" id="orderId" value="{{$order->id}}">
                                    <tr>
                                        <td>
                                            <a href="#" class="order-btn btn-delete" data-order-item-id="{{$product->itemId}}"><i class="fas fa-trash"></i></a>
                                            <a href="#" class="order-btn btn-edit" data-product-id="{{$product->id}}"><i class="fas fa-pen"></i></a>

                                            <a class="order-btn btn-save" style="display: none;"><i class="fas fa-check"></i></a>
                                            <button type="button" class="order-btn btn-cancel" style="display: none;"><i class="fas fa-times"></i></button>
                                        </td>
                                        <td>
                                            <span class="itemside" >
                                                <div class="left">
                                                    <img src="{{asset('storage/product_images/'. $product->product_images->first()->product_image)}}" width="40" height="40" class="img-xs" alt="Item">
                                                </div>
                                                <div class="info">
                                                    <span class="product-name" >{{$product->product_name}},</span>

                                                    <br>
                                                    @if ($product->color)
                                                    <span class="product-color">{{$product->color->color_name}}</span>
                                                    @endif
                                                <br>
                                                    @if($product->size)
                                                    <span class="product-size">{{$product->size->size_name}}</span>
                                                    @endif
                                                </div>
                                            </span>
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

<!--New item add Modal -->
<div class="modal fade" id="newItemModal" tabindex="-1" aria-labelledby="newItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="newItemModalLabel">Add New Item</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="newItemForm">
                <input type="hidden" name="newItemOrderId" id="newItemOrderId" value="{{$order->id}}">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="newProduct" class="form-label">Product <span class="text-danger">*</span></label>
                            <select name="newProduct" id="newProduct" class="form-control">
                                <option value="">Select Product</option>
                                @foreach ($items as $item)
                                <option value="{{$item->id}}">{{$item->product_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="" class="form-label">Size</label>
                            <select name="size" id="size" class="form-control">
                               <option value="">select size</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="" class="form-label">Color</label>
                            <select name="color" id="color" class="form-control">
                               <option value="">select color</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="" class="form-label">Price</label>
                            <input type="number" name="newprice" id="newprice" class="form-control" placeholder="Price" value="0">
                        </div>
                        <div class="col-md-2">
                            <label for="" class="form-label">Qty</label>
                            <input type="number" name="newqty" id="newqty" class="form-control" placeholder="Quantity" min="1">
                        </div>
                        <div class="col-md-9"></div>
                        <div class="col-md-1">
                            <span for="newSubtotal" class="form-label">Subtotal: </span>
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control" id="newSubtotal" name="newSubtotal" value="0">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@push('order_status')
<script>
$(document).ready(function() {

    $('.select-me').select2();
    // Define a variable to store original values
    var originalValues = {};

    $('.btn-edit').on('click', function(e) {
        var productId = $(this).data('product-id');
        console.log(productId);
        e.preventDefault();
        var $row = $(this).closest('tr');

        originalValues.color = $row.find('.product-color').text().trim()
        originalValues.size = $row.find('.product-size').text().trim()
        originalValues.price = $row.find('td:nth-child(3)').text().trim().replace('৳', '');
        originalValues.quantity = $row.find('td:nth-child(4)').text().trim();
        originalValues.total = $row.find('td:nth-child(5)').text().trim().replace('৳', '');

        originalValues.deliveryCharge = parseInt($('#delivery_charge').text().trim().replace('৳', ''), 10);
        originalValues.discount = parseInt($('#discount').text().trim().replace('৳', ''), 10);
        originalValues.paidAmount = parseInt($('#totalPaid').text().trim().replace('৳', ''), 10);

        originalValues.subtotal = parseInt($('#subtotal').text().trim().replace('৳', ''), 10);
        originalValues.gTotal = parseInt($('#g_total').text().trim().replace('৳', ''), 10);
        originalValues.dueAmount = parseInt($('#totalDue').text().trim().replace('৳', ''), 10);

        $row.find('.product-color').replaceWith($('<select>').addClass('color-select colorId mt-2').append($('<option>').text(originalValues.color)));
        $row.find('.product-size').replaceWith($('<select>').addClass('size-select sizeId mt-2').append($('<option>').text(originalValues.size)));

         // Fetch color options
         $.ajax({
            url: '/get-color-options', // Replace with your route URL
            type: 'GET',
            success: function(response) {
                var colorSelect = $row.find('.color-select');
                colorSelect.empty(); // Clear existing options
                response.forEach(function(color) {
                    var option = $('<option>').attr('value', color.id).text(color.color_name);
                    if (color.color_name == originalValues.color) {
                        option.prop('selected', true); // Pre-select if matches original value
                    }
                    colorSelect.append(option);
                });
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });

        // Fetch size options
        $.ajax({
            url: '/get-size-options', // Replace with your route URL
            type: 'GET',
            success: function(response) {
                var sizeSelect = $row.find('.size-select');
                sizeSelect.empty(); // Clear existing options
                response.forEach(function(size) {
                    var option = $('<option>').attr('value', size.id).text(size.size_name);
                        if (size.size_name == originalValues.size) {
                            option.prop('selected', true); // Pre-select if matches original value
                        }
                        sizeSelect.append(option);
                    });
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });

        //$row.find('td:nth-child(3)').html($('<input>').addClass('form-control price').attr('type', 'text').val(originalValues.price));
        //$row.find('td:nth-child(4)').html($('<input>').addClass('form-control quantity').attr('type', 'number').attr('min',1).val(originalValues.quantity));

        $('#delivery_charge').html($('<input>').addClass('color-select deliveryCharge').attr('type','number').val(originalValues.deliveryCharge));
        $('#discount').html($('<input>').addClass('color-select discount').attr('type','number').val(originalValues.discount));
        $('#totalPaid').html($('<input>').addClass('color-select totalPaid').attr('type','number').val(originalValues.paidAmount));


        // Show save and cancel buttons, hide edit and delete buttons
        $row.find('.btn-save, .btn-cancel').attr('data-product-id',productId).show();
        $row.find('.btn-edit, .btn-delete').hide();

        // Update total on quantity change
        $row.find('.price, .quantity').on('input', function() {
            var newPrice = parseInt($('.price').val(), 10);
            var newQuantity = parseInt($('.quantity').val(), 10);
            var newTotal = newPrice * newQuantity;

            $row.find('td:nth-child(5)').text('৳' + newTotal);
            $row.find('td:nth-child(5)').append($('<input>').addClass('total').attr('type', 'hidden').attr('min',0).val(newTotal));

            var subtotal = originalValues.subtotal;

            if(newTotal < originalValues.total)
            {
                subtotal -= newTotal;
            }
            else{
                subtotal += newTotal;
            }
            // subtotal with hidden field
            $("#subtotal").text('৳' + subtotal);
            $("#subtotal").append($('<input>').addClass('subtotal').attr('type', 'hidden').attr('min',0).val(newTotal));
            // grandtotal value with hidden field
            var grandTotal = subtotal + originalValues.deliveryCharge - originalValues.discount;
            $("#g_total").text('৳' + grandTotal);
            $("#g_total").append($('<input>').addClass('g_total').attr('type', 'hidden').attr('min',0).val(grandTotal));
            // due value with hidden field
            if(grandTotal > originalValues.paidAmount)
            {
                var due = grandTotal - originalValues.paidAmount;
                $("#totalDue").text('৳' + due);
                $("#totalDue").append($('<input>').addClass('totalDue').attr('type', 'hidden').attr('min',0).val(due));
            }
            else{
                var due = grandTotal - originalValues.paidAmount;
                $("#totalDue").text('৳' + due);
                $("#totalDue").append($('<input>').addClass('totalDue').attr('type', 'hidden').attr('min',0).val(due));
            }

            if(grandTotal == originalValues.paidAmount)
            {
                var due = 0;
                $("#totalDue").text('৳' + due);
                $("#totalDue").append($('<input>').addClass('totalDue').attr('type', 'hidden').attr('min',0).val(due));
            }

        });

        $(document).on('input', '.deliveryCharge, .discount', function() {
            var d_charge = parseInt($('.deliveryCharge').val(), 10);
            // console.log(d_charge);
            var discount = parseInt($('.discount').val(), 10);
            // console.log(discount);
            var subtotal = parseInt($('#subtotal').text().trim().replace('৳', ''), 10);
            // console.log(subtotal);
            var grandTotal = subtotal + d_charge - discount;
            // console.log(grandTotal);

            $("#g_total").text('৳' + grandTotal);
            $("#g_total").append($('<input>').addClass('g_total').attr('type', 'hidden').attr('min', 0).val(grandTotal));

            if(grandTotal > originalValues.paidAmount)
            {
                var due = grandTotal - originalValues.paidAmount;
                $("#totalDue").text('৳' + due);
                $("#totalDue").append($('<input>').addClass('totalDue').attr('type', 'hidden').attr('min',0).val(due));
            }
            else{
                var due = grandTotal - originalValues.paidAmount;
                $("#totalDue").text('৳' + due);
                $("#totalDue").append($('<input>').addClass('totalDue').attr('type', 'hidden').attr('min',0).val(due));
            }

            if(grandTotal == originalValues.paidAmount)
            {
                var due = 0;
                $("#totalDue").text('৳' + due);
                $("#totalDue").append($('<input>').addClass('totalDue').attr('type', 'hidden').attr('min',0).val(due));
            }
        });


        $(document).on('input', '.totalPaid', function() {
            var paidAmount = parseInt($(this).val(), 10) || 0; // Get the paid amount entered by the user
            var grandTotal = parseInt($('#g_total').text().trim().replace('৳', ''), 10); // Get the grand total

            // Calculate the new due amount
            var newDueAmount = grandTotal - paidAmount;

            // Update the total due amount displayed on the page
            $("#totalDue").text('৳' + newDueAmount);

            // Update the hidden input field for total due
            $("#totalDue").append($('<input>').addClass('totalDue').attr('type', 'hidden').attr('min', 0).val(newDueAmount));

        });

    });

    $('.btn-cancel').on('click', function() {
        var $row = $(this).closest('tr');

        $row.find('.color-select').replaceWith($('<span>').addClass('product-color').text(originalValues.color));
        $row.find('.size-select').replaceWith($('<span>').addClass('product-size').text(originalValues.size));

        $row.find('td:nth-child(3)').html('৳' + originalValues.price);
        $row.find('td:nth-child(4)').html(originalValues.quantity);
        $row.find('td:nth-child(5)').html('৳' + originalValues.total);

        $('#delivery_charge').html('৳' + originalValues.deliveryCharge);
        $('#discount').html('৳' + originalValues.discount);
        $('#totalPaid').html('৳' + originalValues.paidAmount);

        $("#subtotal").text('৳' + originalValues.subtotal);
        $("#g_total").text('৳' + originalValues.gTotal);
        $("#totalpaid").text('৳' + originalValues.paidAmount);
        $("#totalDue").text('৳' + originalValues.dueAmount);

        // Hide save and cancel buttons, show edit and delete buttons
        $row.find('.btn-save, .btn-cancel').hide();
        $row.find('.btn-edit, .btn-delete').show();
    });

    $('.btn-save').on('click', function() {
        var $row = $(this).closest('tr');

        // Array to store input field values
        var formData = {};

        formData.orderId = $('#orderId').val();
        // Get product details
        formData.productId = $(this).data('product-id');

        // Get color and size
        formData.colorId = $row.find('.colorId').val();
        formData.sizeId = $row.find('.sizeId').val();

        // Get price and quantity
        formData.price = $row.find('.price').val() || originalValues.price;
        formData.quantity = $row.find('.quantity').val()|| originalValues.quantity;
        formData.total = $row.find('.total').val() || originalValues.total;

        formData.subtotal = $('#subtotal').find('.subtotal').val() || originalValues.subtotal;

        // Get delivery charge, discount, and total paid
        formData.deliveryCharge = $('.deliveryCharge').val();
        formData.discount = $('.discount').val();
        formData.totalPaid = $('.totalPaid').val() || originalValues.paidAmount;

        // Get grand total and total due
        formData.grandTotal = $('#g_total').find('.g_total').val() || originalValues.gTotal;
        formData.totalDue = $('#totalDue').find('.totalDue').val() || originalValues.dueAmount;

        // Use SweetAlert for confirmation
        Swal.fire({
            title: "Do you want to save the changes?",
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: "Save",
            denyButtonText: `Don't save`
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                saveData(formData);
                Swal.fire("Saved!", "", "success");
            } else if (result.isDenied) {
                Swal.fire("Changes are not saved", "", "info");
            }
        });
        // Swal.fire({
        //     title: 'Confirm Save',
        //     text: 'Are you sure you want to save this data?',
        //     icon: 'info',
        //     showCancelButton: true,
        //     confirmButtonColor: '#3085d6',
        //     cancelButtonColor: '#d33',
        //     confirmButtonText: 'Yes, save it!'
        // }).then((result) => {
        //     if (result.isConfirmed) {
        //         // Proceed with AJAX request to save the data
        //         saveData(formData);
        //     }
        // });
    });

    // Function to make an AJAX request to save the data
    function saveData(formData) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // Make an AJAX request to save the data
        $.ajax({
            url: '{{ route('order.update') }}', // Replace with your server endpoint
            type: 'POST',
            data: formData,
            success: function(response) {
                // Handle success response
                location.reload();
                console.log('Data saved successfully!');
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(error);
            }
        });
    }

    $('.btn-delete').on('click',function(event){
        event.preventDefault();
        var orderId = $('#orderId').val();
        var orderItemId = $(this).data('order-item-id');
        console.log(orderId);
        console.log(orderItemId);
        var totalOrderItems = $('.btn-delete').length;
        // Check if there's only one order item
        if (totalOrderItems === 1) {
            // Show error message
            Swal.fire('Error!', 'You cannot delete the only item in the order.', 'error');
            return; // Stop further execution
        }

        // Show confirmation dialog using SweetAlert
        Swal.fire({
            title: 'Confirm Delete',
            text: 'Are you sure you want to delete this order item?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Proceed with AJAX request to delete the order item
                deleteOrderItem(orderId, orderItemId);
            }
        });

    });

    function deleteOrderItem(orderId, orderItemId) {
        // console.log(orderId);
        // console.log(orderItemId);
        $.ajax({
            url: '{{route('orderItem.delete')}}', // Replace with your server endpoint
            type: 'POST',
            data: {
                order_id: orderId,
                order_item_id: orderItemId,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                // Handle success response
                if (response.status === 'success') {
                    // Optionally, update the UI to reflect the deletion
                    // For example, remove the deleted order item from the DOM
                    $(`.btn-delete[data-order-item-id="${orderItemId}"]`).closest('tr').remove();
                    // Show success message
                    Swal.fire('Deleted!', 'The order item has been deleted.', 'success');
                    location.reload();
                } else {
                    // Show error message
                    Swal.fire('Error!', 'Failed to delete the order item.', 'error');
                }
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(error);
            }
        });
    }

    $('#newProduct').on('change', function() {
        var productId = $(this).val();

        // Fetch product details via AJAX
        $.ajax({
            url: '{{ route('newproduct.details') }}', // Replace with your route URL to fetch product details
            type: 'GET',
            data: { id: productId },
            success: function(response) {
                // Populate size options
                // console.log(response);
                $('#size').html('');
                $.each(response.sizes, function(index, size) {
                    $('#size').append('<option value="' + size.id + '">' + size.size_name + '</option>');
                });

                // Populate color options
                $('#color').html('');
                $.each(response.colors, function(index, color) {
                    $('#color').append('<option value="' + color.id + '">' + color.color_name + '</option>');
                });

                // // Set price input
                var price = $('#newprice').val(response.price);
                var qty = $('#newqty').val(1);
                var subtotal = response.price * 1;
                $('#newSubtotal').val(subtotal.toFixed(2));
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(error);
            }
        });
    });
    // Function to calculate subtotal
    function calculateSubtotal() {
        var price = parseFloat($('#newprice').val());
        var quantity = parseInt($('#newqty').val());
        var subtotal = price * quantity;
        $('#newSubtotal').val(subtotal.toFixed(2)); // Display subtotal with two decimal places
    }

    // Event listener for price input change
    $('#newprice').on('input', function() {
        calculateSubtotal();
    });

    // Event listener for quantity input change
    $('#newqty').on('input', function() {
        calculateSubtotal();
    });

    $('#newItemForm').on('submit', function(e) {
        e.preventDefault();
        var newItemData = $(this).serialize();
        console.log(newItemData);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // Make an AJAX request to save the data
        $.ajax({
            url: '{{ route('newProduct.store') }}', // Replace with your server endpoint
            type: 'POST',
            data: newItemData,
            success: function(response) {
                // Handle success response
                location.reload();
                console.log('Data saved successfully!');
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(error);
            }
        });
    });

});

</script>
@endpush
