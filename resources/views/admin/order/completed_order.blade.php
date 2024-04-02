@extends('layouts.admin')
@section('title','Orders list')
@section('content')

    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Order List </h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{'/dashborad'}}">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Order</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <header class="card-header">
                    <h5 class="mb-3">Filter by</h5>
                    <form id="orderFilterForm">
                        <div class="row order_live_search">
                            <div class="col-md-3 mb-4">
                                <label for="Order" class="form-label">Order ID</label>
                                <input type="text" placeholder="Type here" class="form-control" id="order_id">
                            </div>
                            <div class="col-md-3 mb-4">
                                <label for="customer_name" class="form-label">Customer</label>
                                <input type="text" placeholder="Type here" class="form-control" id="customer_name">
                            </div>
                            <div class="col-md-3 mb-4">
                                <label for="customerPhone" class="form-label">Phone</label>
                                <input type="text" placeholder="Type here" class="form-control" id="customerPhone">
                            </div>
                        </div>
                    </form>
                </form>

                </header>
                    <div class="row gx-3 mt-4">
                        <div class="col-lg-4 col-md-6 me-auto">
                            {{-- <input type="text" placeholder="Search..." class="form-control"> --}}
                        </div>
                        <div class="col-lg-2 col-md-3 col-6">
                            <select class="form-select  mb-lg-0 mb-15 mw-200 all_order_status" id="all_order_status" name="all_order_status" style="display: none;">
                                <option value="0" >Change Status</option>
                                <option value="pending" style="color: orange;" >Pending</option>
                                <option value="confirmed" style="color: blue;" >Confirmed</option>
                                <option value="shipped" style="color: green;" >Shipped</option>
                                <option value="delivered" style="color: #00cc00;" >Delivered</option>
                                <option value="completed" style="color: purple;">Completed</option>
                                <option value="returned" style="color: gray;" >Returned</option>
                                <option value="cancelled" style="color: red;" >Cancelled</option>
                            </select>
                        </div>

                    </div>
                <!-- card-header end// -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="datatable">
                            <thead>
                                <tr>
                                    {{-- <td><input type="checkbox" id="select-all-checkbox"></td> --}}
                                    <th>ID</th>
                                    <th>Order No</th>
                                    <th>Customer </th>
                                    <th>Product Info</th>
                                    <th>Price</th>
                                    <th>Due</th>
                                    <th>Status</th>
                                    <th class="text-end"> Action </th>
                                </tr>
                            </thead>
                            <tbody id="orderTableBody">
                                @foreach ($completedOrders as $key => $order)
                                <tr>
                                    {{-- <td><input type="checkbox" class="form-group order-checkbox" value="{{$order->id}}" id="order_checkbox"></td> --}}
                                    <td>{{$key+1}}</td>
                                    <td>
                                        <small >Order No.: #{{$order->id}}</small><br>
                                        Date: <small >{{ $order->created_at->format('d-m-Y') }}</small>
                                    </td>
                                    <td>
                                        <a href="{{route('customer.profile', ['id' => $order->customer->id])}}" class="">
                                            <div class="info pl-3">
                                                <h6 class="mb-0 title">{{$order->customer->firstName}} {{$order->customer->lastName}}</h6>
                                                <a class="text-muted" href="tel:{{$order->customer->phone}}">{{$order->customer->phone}}</a><br>
                                                <small class="text-muted" style="width:200px">{{$order->customer->billing_address}}</small>
                                            </div>
                                        </a>
                                    </td>

                                    <td>
                                        @foreach ($order->order_item as $key => $item   )
                                            {{$key+1}} .
                                            <span class="text-brand">{{$item->product->product_name}}</span>,
                                            <span > Size: {{$item->product_sizes->size_name}}</span>,
                                            @if($item->product_colors)
                                            <span> Color: {{$item->product_colors->color_name}}</span>,
                                            @endif
                                            <span>Quantiy: {{$item->quantity}}</span><br>
                                        @endforeach
                                    </td>
                                    <td>৳{{$order->total}}</td>
                                    <td>৳<span>{{ $order->total_due }}</span></td>
                                    <td>
                                        @if($order->is_pos !=1 )
                                        <div class="status-container">
                                            <select class="form-select d-inline-block mb-lg-0 mb-15 mw-200 order_status" id="order_status" data-order-id="{{ $order->id }}" name="order_status">
                                                <option value="pending" style="color: orange;" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="confirmed" style="color: blue;" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                                <option value="shipped" style="color: green;" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                                <option value="delivered" style="color: #00cc00;" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                                <option value="completed" style="color: purple;" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="returned" style="color: gray;" {{ $order->status == 'returned' ? 'selected' : '' }}>Returned</option>
                                                <option value="cancelled" style="color: red;" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                        </div>
                                        @else
                                        <div class="status-container">
                                            <select class="form-select d-inline-block mb-lg-0 mb-15 mw-200 order_status" id="order_status" data-order-id="{{ $order->id }}" name="order_status">

                                                <option value="completed" style="color: purple;" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                                <option value="returned" style="color: gray;" {{ $order->status == 'returned' ? 'selected' : '' }}>Returned</option>
                                                {{-- <option value="cancelled" style="color: red;" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option> --}}
                                            </select>
                                        </div>
                                        @endif
                                    </td>

                                    <td class="text-end">
                                        <a href="{{route('order.details', ['id' => $order->id])}}" class="btn btn-md rounded font-sm">Detail</a>
                                        @if($order->is_pos == 0 )
                                        <a class="btn btn-md rounded font-sm" href="{{route('order.track', ['id' => $order->id])}}">Track me</a>
                                        @endif

                                        @if($order->is_pos == 1 )
                                        <a href="{{ url('/dashboard/pos/invoice/'.$order->id) }}" target="__blank" class="btn btn-facebook rounded font-sm">Invoice</a>
                                        @else
                                        <a href="{{ url('/orders/invoice/'.$order->id) }}" target="__blank" class="btn btn-facebook rounded font-sm">Invoice</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div> <!-- table-responsive //end -->
                </div> <!-- card-body end// -->
            </div> <!-- card end// -->
        </div>

    </div>

@endsection
@push('order_status')
<script>
    $(document).ready(function() {
    //     // Get references to the global and individual checkboxes
    //     const selectAllCheckbox = document.getElementById('select-all-checkbox');
    //     const individualCheckboxes = document.querySelectorAll('.order-checkbox');
    //     const statusSelect = $('#all_order_status');

    //     // Add an event listener to the global checkbox
    //     selectAllCheckbox.addEventListener('change', function () {
    //         // Update the state of all individual checkboxes based on the state of the global checkbox
    //         individualCheckboxes.forEach(checkbox => {
    //             checkbox.checked = selectAllCheckbox.checked;
    //         });

    //         // Show/hide the statusSelect based on the state of the global checkbox
    //         statusSelect.toggle(selectAllCheckbox.checked);
    //     });

    //     // Add an event listener to each individual checkbox
    //     individualCheckboxes.forEach(checkbox => {
    //         checkbox.addEventListener('change', function () {
    //             // Update the state of the global checkbox based on the state of individual checkboxes
    //             selectAllCheckbox.checked = [...individualCheckboxes].every(checkbox => checkbox.checked);

    //             // Show/hide the statusSelect based on the state of the individual checkboxes
    //             statusSelect.toggle([...individualCheckboxes].some(checkbox => checkbox.checked));
    //         });
    //     });

    //     $('.order-checkbox').change(function() {
    //         var orderId = $(this).val();
    //         var statusSelect = $('#all_order_status');

    //         if ($(this).prop('checked')) {
    //             statusSelect.show();
    //         } else {
    //             statusSelect.hide();
    //         }
    //     });

    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });

    //     $('.all_order_status').change(function() {
    //         var selectedStatus = $(this).val();
    //         var selectedOrders = $('.order-checkbox:checked').map(function() {
    //             return $(this).val();
    //         }).get();
    //         // console.log(selectedOrders);
    //         // Perform an AJAX request to update the status of selected orders
    //         $.ajax({
    //             type: 'POST',
    //             url: '/update-order-status',
    //             data: {
    //                 status: selectedStatus,
    //                 orders: selectedOrders
    //             },
    //             success: function(response) {
    //                 // Handle success, if needed
    //                 location.reload();
    //                 if (response.success) {
    //                     $.Notification.autoHideNotify('success', 'top right', 'Success', response.message);
    //                 }
    //                 console.log(response);
    //             },
    //             error: function(error) {
    //                 // Handle error, if needed
    //                 location.reload();
    //                 console.error(error);
    //             }
    //         });
    //     });

        $('.order_status').change(function() {
            var orderId = $(this).data('order-id');
            var newStatus = $(this).val();

            console.log(newStatus);
            console.log(orderId);
            // Perform an AJAX request to update the status of selected orders
            $.ajax({
                type: 'POST',
                url: '/update-one-order-status', // Update with your route
                data: {
                    orderId: orderId,
                    newStatus: newStatus,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    // Handle success, if needed
                    location.reload();
                    if (response.success) {
                        $.Notification.autoHideNotify('success', 'top right', 'Success', response.message);
                    }
                    console.log(response);
                },
                error: function (error) {
                    // Handle error, if needed
                    console.error(error);
                }
            });
        });

    //     // // $('.order_status').change(function () {
    //     //     var selectedColor = $('option:selected', '.order_status').css('color');
    //     //     $('.order_status').css('background-color', selectedColor);
    //     // // });

        $('#orderFilterForm input').on('keyup change', function() {
            // Capture form input values

            var orderId = $('#order_id').val();
            // console.log(orderId);

            var customerName = $('#customer_name').val();
            // console.log(customerName);

            var customerPhone = $('#customerPhone').val();
            // console.log(customerPhone);

            $.ajax({
                url: "{{ route('order.completedfilters') }}",
                method: "GET",
                data: {
                    orderId: orderId,
                    customerName: customerName,
                    customerPhone: customerPhone,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    // Handle success, if needed
                    console.log(response);

                    var tableBody = $('#orderTableBody');
                    tableBody.empty(); // Clear existing table rows

                    response.forEach(function(order, index) {

                        var statusOption = '';

                        // Check if the order is POS or not
                        if (order.is_pos != 1) {
                            // If not POS, include full status options
                            statusOption = `
                                <div class="status-container">
                                    <select class="form-select d-inline-block mb-lg-0 mb-15 mw-200 order_status" id="order_status" data-order-id="${order.id}" name="order_status">
                                        <option value="pending" style="color: orange;" ${order.status == 'pending' ? 'selected' : ''}>Pending</option>
                                        <option value="confirmed" style="color: blue;" ${order.status == 'confirmed' ? 'selected' : ''}>Confirmed</option>
                                        <option value="shipped" style="color: green;" ${order.status == 'shipped' ? 'selected' : ''}>Shipped</option>
                                        <option value="delivered" style="color: #00cc00;" ${order.status == 'delivered' ? 'selected' : ''}>Delivered</option>
                                        <option value="completed" style="color: purple;" ${order.status == 'completed' ? 'selected' : ''}>Completed</option>
                                        <option value="returned" style="color: gray;" ${order.status == 'returned' ? 'selected' : ''}>Returned</option>
                                        <option value="cancelled" style="color: red;" ${order.status == 'cancelled' ? 'selected' : ''}>Cancelled</option>
                                    </select>
                                </div>
                            `;
                        } else {
                            // If POS, include limited status options
                            statusOption = `
                                <div class="status-container">
                                    <select class="form-select d-inline-block mb-lg-0 mb-15 mw-200 order_status" id="order_status" data-order-id="${order.id}" name="order_status">
                                        <option value="completed" style="color: purple;" ${order.status == 'completed' ? 'selected' : ''}>Completed</option>
                                        <option value="returned" style="color: gray;" ${order.status == 'returned' ? 'selected' : ''}>Returned</option>
                                    </select>
                                </div>
                            `;
                        }

                        // Initialize a variable to store the HTML for order items
                        var orderItemsHtml = '';

                        // Iterate through order items and create HTML
                        order.order_item.forEach(function(item, key) {
                            // console.log(item);
                            orderItemsHtml += `
                                <span>${key + 1}. <span class="text-brand">${item.product.product_name}</span>, Size: ${item.product_sizes.size_name}`;

                            // Include color if available
                            if (item.product_colors) {
                                orderItemsHtml += `, Color: ${item.product_colors.color_name}`;
                            }

                            orderItemsHtml += `, Quantity: ${item.quantity}<br>`;
                        });

                        var createdAtDate = new Date(order.created_at);
                        // Define options for date formatting
                        var options = {
                            year: 'numeric',
                            month: '2-digit',
                            day: '2-digit'
                        };

                        // Format the date using toLocaleDateString() method
                        var formattedDate = createdAtDate.toLocaleDateString('en-GB', options).replace(/\//g, '-');

                        // Construct the row HTML with all details
                        var row = `
                            <tr>
                                <td>${index + 1}</td>
                                <td>
                                    <small>Order No.: #${order.id}</small><br>
                                    Date: <small>${formattedDate}</small>
                                </td>
                                <td>
                                    <a href="{{ route('customer.profile', ['id' => '']) }}${order.customer_id}" class="">
                                        <div class="info pl-3">
                                            <h6 class="mb-0 title">${order.customer.firstName} ${order.customer.lastName}</h6>
                                            <a class="text-muted" href="tel:${order.customer.phone}">${order.customer.phone}</a><br>
                                            <small class="text-muted" style="width:200px">${order.customer.billing_address}</small>
                                        </div>
                                    </a>
                                </td>
                                <td>${orderItemsHtml}</td>
                                <td>৳${order.total}</td>
                                <td>৳<span>${order.total_due}</span></td>
                                <td>${statusOption}</td>
                                <td class="text-end">
                                    <a href="{{route('order.details', ['id' => ''])}}${order.id}" class="btn btn-md rounded font-sm">Detail</a>
                                    ${order.is_pos == 0 ? `<a class="btn btn-md rounded font-sm" href="{{route('order.track', ['id' => ''])}}${order.id}">Track me</a>` : ''}
                                    <a href="{{ url('/dashboard/pos/invoice') }}/${order.id}" target="__blank" class="btn btn-facebook rounded font-sm">Invoice</a>
                                </td>
                            </tr>
                        `;
                        // console.log(row);

                        // Append more columns as needed
                        tableBody.append(row);
                    });
                },
                error: function(error) {
                    // Handle error, if needed
                    console.error(error);
                }
            })
        });
    });
</script>
@endpush
