@extends('layouts.admin')
@section('title', 'Transaction')
@section('content')

    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Transaction List</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ '/dashborad' }}">Dashborad</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Transaction</li>
                </ol>
            </nav>
        </div>
        {{-- <div>
            <a href="#" class="btn btn-primary"><i class="material-icons md-plus"></i> Create new</a>
        </div> --}}
    </div>
    <div class="card mb-4">
        <header class="card-header">
            <h4 class="mb-2">Search Transactions:-</h4>
            <div class="row gx-3 customer_live_search">
                <div class="col-lg-4 col-md-6 ">
                    <input type="text" placeholder="Type Order Number" class="form-control" name="orderId"
                        id="orderId">
                </div>
                <div class="col-lg-4 col-md-6 ">
                    <input type="text" placeholder="Type a Customer name..." class="form-control" name="customer"
                        id="customer">
                </div>
                {{-- <div class="col-lg-4 col-md-6 me-auto">
                    <input type="email" placeholder="Customer email..." class="form-control" name="customer_email"
                        id="customer_email">
                </div> --}}
            </div>
        </header> <!-- card-header end// -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="datatable">
                    <thead>
                        <tr>
                            <th>Order No</th>
                            <th>Customer Name</th>
                            <th>Order Date</th>
                            <th>Total</th>
                            <th>Paid</th>
                            <th>Due</th>
                            <th>Payment Method</th>
                            <th>Payment Status</th>
                            <th>Transaction Date</th>
                        </tr>
                    </thead>
                    <tbody id="transactionTable">
                        @foreach ($data as $key => $list)
                            <tr>
                                <td> Order ID: {{ $list->order->id }}</td>
                                <td>
                                    <a href="{{ route('customer.profile', ['id' => $list->customer->id]) }}"
                                        class="itemside">
                                        <div class="info pl-3">
                                            <h6 class="mb-0 title">{{ $list->customer->firstName }}
                                                {{ $list->customer->lastName }}</h6>
                                            <small class="text-muted">Customer ID: #{{ $list->customer->id }}</small>
                                        </div>
                                    </a>
                                </td>
                                <td>{{$list->order->created_at->format('d-m-Y') }}</td>
                                <td>{{ $list->order->total }}</td>
                                <td>{{ $list->order->total_paid }}</td>
                                <td>{{ $list->order->total_due }}</td>
                                <td>
                                    @if ($list->mode == 'online')
                                        <span class="badge rounded-pill alert-success">Online</span>
                                    @elseif($list->mode =='cash')
                                        <span class="badge rounded-pill alert-info">Cash</span>
                                    @elseif($list->mode =='cod')
                                        <span class="badge rounded-pill alert-success">Cash On Delivery</span>
                                    @else
                                       <span class="badge rounded-pill alert-success">Other</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($list->status == 'paid')
                                        <span class="badge rounded-pill alert-success">Paid</span>
                                    @elseif($list->status == 'unpaid')
                                        <span class="badge rounded-pill alert-danger">Unpaid</span>
                                        {{-- @if ($list->order->is_pos == 1) --}}
                                        <a class="badge rounded-pill bg-success ml-2 pay" data-bs-toggle="modal" data-bs-target="#makepament" data-trans_id="{{$list->id}}"> Pay Now</a>
                                        {{-- @endif --}}
                                    @elseif($list->status == 'refunded')
                                        <span class="badge rounded-pill alert-danger">Refunded</span>
                                    @elseif($list->status == 'declined')
                                        <span class="badge rounded-pill alert-warning">declined</span>
                                    @else
                                        <span class="badge rounded-pill alert-danger">Not Found
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $list->updated_at->format('d-m-Y') }}</td>

                            </tr>
                        @endforeach

                    </tbody>
                    <tr id="loading-indicator" class="d-none">
                        <td>Loading...</td>
                    </tr>
                </table> <!-- table-responsive.// -->
            </div>
        </div> <!-- card-body end// -->
    </div> <!-- card end// -->

 <!-- Modal -->
    <div class="modal fade" id="makepament" tabindex="-1" aria-labelledby="makepamentLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="makepamentLabel">Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="paymentForm">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label for="orderNo" class="form-label">Order No</label>
                            <input type="text" class="form-control" id="orderNo" name="orderNo" readonly>
                        </div>
                         <div class="col-md-4">
                            <label for="trans_id" class="form-label">Transaction Id</label>
                            <input type="text" class="form-control" id="trans_id" name="trans_id" readonly>
                        </div>

                        <div class="col-md-12">
                            <label for="customerName" class="form-label">Customer Name</label>
                            <input type="text" class="form-control" id="customerName" name="customerName" readonly>
                        </div>

                        <div class="col-md-4">
                            <label for="total" class="form-label">Total</label>
                            <input type="text" class="form-control" id="total" name="total" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="paid" class="form-label">Paid</label>
                            <input type="text" class="form-control" id="paid" name="paid" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="due" class="form-label">Due</label>
                            <input type="text" class="form-control" id="due" name="due" readonly>
                        </div>

                          <div class="col-md-4">
                            {{-- <label for="total" class="form-label">Total</label>
                            <input type="text" class="form-control" id="total" name="total" readonly> --}}
                        </div>
                        <div class="col-md-4">
                            {{-- <label for="paid" class="form-label">Paid</label>
                            <input type="text" class="form-control" id="paid" name="paid" readonly> --}}
                        </div>
                        <div class="col-md-4">
                            <label for="payment" class="form-label">
                                Payment:
                                <input type="text" class="form-control" id="payment" name="payment" value="0">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="payButton">Pay</button>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@push('transaction')
    <script>
        // Edit customer
        $(document).on('click', '.pay', function(e) {
            e.preventDefault();
            var transId = $(this).data('trans_id');
            console.log(transId);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{url('/dashboard/transaction/payment-info')}}',
                method: 'GET',
                data: {
                    id: transId,
                },
                success: function(response) {

                    // console.log(response);
                    var fullname = response.customer.firstName +' ' +response.customer.lastName;
                    $('#orderNo').val(response.order_id);
                    $('#trans_id').val(response.id);
                    $('#customerName').val(fullname);
                    $('#total').val(response.order.total);
                    $('#paid').val(response.order.total_paid);
                    $('#due').val(response.order.total_due);

                     // Enable input field for payment
                    $('#payment').prop('disabled', false);
                    $('#payButton').prop('disabled', true);

                    // Add change event listener to payment input field
                    $('#payment').on('change', function() {
                        var payment = parseFloat($(this).val());
                        var due = parseFloat($('#due').val());

                        if (isNaN(payment) || payment < 0) {
                            $(this).val('');
                            $('#payButton').prop('disabled', true); // Disable pay button
                            return;
                        }

                        if (payment > due) {
                            $('#payButton').prop('disabled', true); // Disable pay button
                            alert('Payment amount cannot exceed due amount.');
                            $(this).val('');
                        } else {
                            $('#payButton').prop('disabled', false); // Enable pay button
                        }
                    });
                }
            });
        });

        //Update customer
        $("#paymentForm").submit(function(e) {
            e.preventDefault();
            const data = new FormData(this);
                console.log(data);
            $.ajax({
                url: '{{url('/dashboard/transaction/payment-update')}}',
                method: 'post',
                data: data,
                cache: false,
                processData: false,
                contentType: false,
                success: function(res) {
                    console.log(res);
                    if (res.status == 200) {
                        // $("#brandEditForm").modal('hide');
                        location.reload();
                        // $.Notification.autoHideNotify('success', 'top right', 'Success', res.message);
                    } else {
                        $.Notification.autoHideNotify('danger', 'top right', 'Danger', res.message);

                    }
                }
            })
        });

        $(document).ready(function() {

            function searchHandler() {
                var loadingIndicator = $('#loading-indicator');
                var orderId = $('#orderId').val().trim();
                var customerName = $('#customer').val().trim();

                // Show loading indicator
                loadingIndicator.show();

                $.ajax({
                    url: "{{ route('transaction.search') }}",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        orderNo: orderId,
                        customerName: customerName
                    },
                    success: function(data) {
                        console.log(data);
                        var tbody = $('#transactionTable');
                        tbody.empty();

                        if (data.transactions.length === 0) {
                            tbody.append('<tr><td colspan="9">No products found</td></tr>');
                        } else {
                            $.each(data.transactions, function(index, transaction) {

                                var createdDate = new Date(transaction.order.created_at);
                                var transactionDate = new Date(transaction.updated_at);

                                // Define formatting options
                                var options = {
                                    day: '2-digit',   // numeric day with leading zeros
                                    month: '2-digit', // numeric month with leading zeros
                                    year: 'numeric'   // full numeric year
                                };

                                // Format the date
                                var orderDate = createdDate.toLocaleDateString('en-GB', options).replace(/\//g, '-');
                                var transDate = transactionDate.toLocaleDateString('en-GB', options).replace(/\//g, '-');
                                // console.log(formattedDate);

                                if(transaction.status == 'unpaid')
                                {
                                    var status = '<span class="badge rounded-pill alert-danger">' + transaction.status + '</span>'+
                                    '<a class="badge rounded-pill bg-success ml-2 pay" data-bs-toggle="modal" data-bs-target="#makepament" data-trans_id="'+transaction.id+'"> Pay Now</a>';
                                }else {
                                    status = '<span class="badge rounded-pill alert-success">' + transaction.status + '</span>';
                                }

                                var tr = $('<tr>' +
                                    '<td> Order ID: ' + transaction.order.id + '</td>' +
                                    '<td>' +
                                    '<a href="{{ route('customer.profile', ['id' => $list->customer->id]) }}" class="itemside">' +
                                    '<div class="info pl-3">' +
                                    '<h6 class="mb-0 title">' + transaction.customer.firstName + ' ' + transaction.customer.lastName + '</h6>' +
                                    '<small class="text-muted">Customer ID: #' + transaction.customer.id + '</small>' +
                                    '</div>' +
                                    '</a>' +
                                    '</td>' +
                                    '<td>' + orderDate + '</td>' +
                                    '<td>' + transaction.order.total + '</td>' +
                                    '<td>' + transaction.order.total_paid + '</td>' +
                                    '<td>' + transaction.order.total_due + '</td>' +
                                    '<td><span class="badge rounded-pill alert-success">' + transaction.mode + '</span></td>' +
                                    '<td>'+ status +
                                    '</td>' +
                                    '<td>' + transDate + '</td>' +
                                    '</tr>');

                                tbody.append(tr);
                            });
                        }

                        // Hide loading indicator after displaying results
                        loadingIndicator.hide();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching product suggestions:', error);
                        // Hide loading indicator on error
                        loadingIndicator.hide();
                    }
                });
            }

            // Call the function for each search input
            $('#orderId, #customer').on('keyup', function(event) {
                searchHandler();
            });
        });

    </script>
@endpush
