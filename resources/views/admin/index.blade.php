@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')

<div class="content-header">
    <div>
        <h2 class="content-title card-title">Dashboard </h2>
        <p>Whole data about your business here</p>
    </div>
    <div>
        <!--<a href="#" class="btn btn-primary"><i class="text-muted material-icons md-post_add"></i>Create report</a>-->
    </div>
</div>
<div class="row">

    <div class="col-lg-3">
        <div class="card card-body mb-4">
            <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-success-light"><i class="text-primary material-icons md-monetization_on"></i></span>
                <div class="text">
                    <h6 class="mb-1 card-title">Total Sales </h6> <span>৳ {{ number_format($sales, 2 ) }}</span>
                </div>
            </article>

        </div>
    </div>
    <div class="col-lg-3">
        <div class="card card-body mb-4">
            <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-success-light"><i class="text-primary material-icons md-monetization_on"></i></span>
                <div class="text">
                    <h6 class="mb-1 card-title">Total Sale W/O delivery Charge</h6> <span>৳ {{number_format($subtotal, 2)  }}</span>

                </div>
            </article>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card card-body mb-4">
            <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-warning-light"><i class="text-warning material-icons md-shopping_bag"></i></span>
                <div class="text">
                    <h6 class="mb-1 card-title">Total Items</h6> <span>{{ $products }} <span  style="font-size:12px; display:inline">Items</span></span>
                </div>
            </article>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card card-body mb-4">
            <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-warning-light"><i class="text-warning material-icons md-shopping_bag"></i></span>
                <div class="text">
                    <h6 class="mb-1 card-title">Total Products In stock</h6> <span>{{ $productInStock }} <span  style="font-size:12px; display:inline">Items in Stock</span></span>
                </div>
            </article>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card card-body mb-4">
            <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-primary-light"><i class="text-success material-icons md-local_shipping"></i></span>
                <div class="text">
                    <h6 class="mb-1 card-title"> Total Orders </h6>
                    <span>{{$total_orders}}</span>
                </div>
            </article>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card card-body mb-4">
            <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-info-light"><i class="text-info material-icons md-shopping_basket"></i></span>
                <div class="text">
                    <h6 class="mb-1 card-title">Total Category</h6> <span>{{ $category }}</span>

                </div>
            </article>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="card card-body mb-4">
            <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-info-light"><i class="text-info material-icons md-shopping_basket"></i></span>
                <div class="text">
                    <h6 class="mb-1 card-title">Total Customer</h6> <span>{{ $customers }}</span>

                </div>
            </article>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card card-body mb-4">
            <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-info-light"><i class="text-info material-icons md-shopping_basket"></i></span>
                <div class="text">
                    <h6 class="mb-1 card-title">Total Pending Orders</h6> <span>{{ $pending_order }}</span>

                </div>
            </article>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card card-body mb-4">
            <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-info-light"><i class="text-info material-icons md-shopping_basket"></i></span>
                <div class="text">
                    <h6 class="mb-1 card-title">Total Complete Orders</h6> <span>{{ $completed_order }}</span>
                </div>
            </article>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card card-body mb-4">
            <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-info-light"><i class="text-info material-icons md-shopping_basket"></i></span>
                <div class="text">
                    <h6 class="mb-1 card-title">Active Campaign</h6> <span>{{ $campaign }}</span>
                </div>
            </article>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card card-body mb-4">
            <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-info-light"><i class="text-info material-icons md-shopping_basket"></i></span>
                <div class="text">
                    <h6 class="mb-1 card-title">Total Profit</h6>
                    <span>৳ {{ number_format($totalProfit, 2 ) }}</span>
                </div>
            </article>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card card-body mb-4">
            <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-info-light"><i class="text-info material-icons md-shopping_basket"></i></span>
                <div class="text">
                    <h6 class="mb-1 card-title">Total Loss</h6>
                    <span>৳ {{ number_format($totalLoss, 2 ) }}</span>
                </div>
            </article>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="card card-body mb-4">
            <article class="icontext">
                <span class="icon icon-sm rounded-circle bg-info-light"><i class="text-info material-icons md-shopping_basket"></i></span>
                <div class="text">
                    <h6 class="mb-1 card-title">Total Purchase</h6>
                    <span>৳ {{ number_format($totalPurchase, 2 ) }}</span>
                </div>
            </article>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-lg-8 col-md-8">
        <div class="card mb-4">
            <header class="card-header">
                <h4 class="card-title">Latest orders</h4>

            </header>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col" class="text-center">
                                        <div class="form-check align-middle">
                                            <input class="form-check-input" type="checkbox" id="transactionCheck01">
                                            <label class="form-check-label" for="transactionCheck01"></label>
                                        </div>
                                    </th>
                                    <th class="align-middle" scope="col">Order ID</th>
                                    <th class="align-middle" scope="col">Biller Name</th>
                                    <th class="align-middle" scope="col">Order Date</th>
                                    <th class="align-middle" scope="col">Total</th>
                                    <th class="align-middle" scope="col">Payment Status</th>
                                    <th class="align-middle" scope="col">Payment Method</th>
                                    <th class="align-middle" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr>
                                    <td class="text-center">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="transactionCheck02">
                                            <label class="form-check-label" for="transactionCheck02"></label>
                                        </div>
                                    </td>
                                    <td><a href="{{route('order.details', ['id' => $order->id])}}" class="fw-bold">{{$order->id}}</a> </td>
                                    <td>{{$order->customer->firstName}} {{$order->customer->lastName}}</td>
                                    <td>
                                        {{$order->created_at->setTimezone('Asia/Dhaka')->format('D, M j, Y')}}
                                        {{-- {{$order->created_at}} --}}
                                    </td>
                                    <td>
                                        {{$order->total}}
                                    </td>
                                    <td>
                                        @if ($order->transaction->status == 'paid')
                                        <span class="badge badge-pill badge-soft-success">Paid</span>
                                        @elseif ($order->transaction->status == 'unpaid')
                                        <span class="badge badge-pill badge-soft-warning">Unpaid</span>

                                        @endif

                                    </td>
                                    <td>
                                       @if($order->transaction->mode == 'cod')
                                        <i class="material-icons md-payment font-xxl text-muted mr-5"></i> Cash On Delivery

                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('order.details', ['id' => $order->id])}}" class="btn btn-xs"> View details</a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div> <!-- table-responsive end// -->
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-4">
        <div class="card mb-4">
            <header class="card-header">
                <h4 class="card-title">Top Selling Products</h4>
            </header>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap mb-0">
                            <thead class="table-light">
                                <tr>

                                    <th class="align-middle" scope="col">Product</th>
                                    <th class="align-middle" scope="col">Qty</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach ($topOrderedProducts as $item)
                                <tr>
                                    <td> {{$item->product->product_name}} </td>
                                    <td>{{$item->total_quantity}}</td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div> <!-- table-responsive end// -->
            </div>
        </div>
    </div>
</div>


@endsection
