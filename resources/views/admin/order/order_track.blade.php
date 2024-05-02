@extends('layouts.admin')
@section('title','Order-'.$order->id)
@section('content')

    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Order Tracking</h2>
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
                    <small class="text-muted">Order ID: {{$order->id}}</small> <br>
                    <!--<small class="text-muted">Your order has been delivered</small>-->
                </div>
                <!--<div class="col-lg-6 col-md-6 ms-auto text-md-end">-->
                <!--    <select class="form-select d-inline-block mb-lg-0 mb-15 mw-200 mr-15">-->
                <!--        <option>Change status</option>-->
                <!--        <option>Awaiting payment</option>-->
                <!--        <option>Confirmed</option>-->
                <!--        <option>Shipped</option>-->
                <!--        <option>Delivered</option>-->
                <!--    </select>-->
                <!--    <a class="btn btn-primary" href="#">Screenshot</a>-->
                <!--    <a class="btn btn-secondary print ms-2" href="#"><i class="icon material-icons md-print mr-5"></i>Print</a>-->
                <!--</div>-->
            </div>
        </header> <!-- card-header end// -->
        <div class="card-body">
            <div class="order-tracking mb-100">
                <div class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between">
                    @php
                        $statusColumn = $order->orderStatus->status . '_date_time';
                        $currentStatusTime = Carbon\Carbon::parse($order->orderStatus->created_at)->setTimezone('Asia/Dhaka');
                    @endphp

                    @if($order->orderStatus->status == 'pending')
                    <div class="step completed">
                        <div class="step-icon-wrap">
                            <div class="step-icon"><i class="material-icons md-shopping_cart"></i></div>
                        </div>
                        <h4 class="step-title">{{$order->orderStatus->status}}</h4>
                        <small class="text-muted text-sm">{{ $currentStatusTime->format('d F Y, h:iA')}}</small>
                    </div>
                    @else
                    <div class="step completed">
                        <div class="step-icon-wrap">
                            <div class="step-icon"><i class="material-icons md-shopping_cart"></i></div>
                        </div>
                        <h4 class="step-title">Pending</h4>
                        <small class="text-muted text-sm">{{$order->orderStatus->created_at->setTimezone('Asia/Dhaka')->format('d F Y, h:iA')}}</small>
                    </div>
                    @endif

                    @if($order->orderStatus->status == 'confirmed')
                    <div class="step completed">
                        <div class="step-icon-wrap">
                            <div class="step-icon"><i class="material-icons md-shopping_bag"></i></div>
                        </div>
                        <h4 class="step-title">{{$order->orderStatus->status}}</h4>
                        <small class="text-muted text-sm">{{ $currentStatusTime->format('d F Y, h:iA')}}</small>
                    </div>
                    @elseif($order->orderStatus->status == 'pending')
                    <div class="step">
                        <div class="step-icon-wrap">
                            <div class="step-icon"><i class="material-icons md-shopping_bag"></i></div>
                        </div>
                        <h4 class="step-title">Confirmed</h4>
                        {{-- <small class="text-muted text-sm">{{$order->orderStatus->created_at->setTimezone('Asia/Dhaka')->format('d F Y, h:iA')}}</small> --}}
                    </div>
                    @else
                    <div class="step completed">
                        <div class="step-icon-wrap">
                            <div class="step-icon"><i class="material-icons md-shopping_bag"></i></div>
                        </div>
                        <h4 class="step-title">Confirmed</h4>
                        <small class="text-muted text-sm">
                            {{ Carbon\Carbon::parse($order->orderStatus->confirmed_date_time)->setTimezone('Asia/Dhaka')->format('d F Y, h:iA')}}
                        </small>
                    </div>
                    @endif

                    @if($order->orderStatus->status == 'shipped')
                    <div class="step completed">
                        <div class="step-icon-wrap">
                            <div class="step-icon"><i class="material-icons md-settings"></i></div>
                        </div>
                        <h4 class="step-title">{{$order->orderStatus->status}}</h4>
                        <small class="text-muted text-sm">{{ $currentStatusTime->format('d F Y, h:iA')}}</small>
                    </div>
                    @elseif($order->orderStatus->status == 'pending' || $order->orderStatus->status == 'confirmed')
                    <div class="step">
                        <div class="step-icon-wrap">
                            <div class="step-icon"><i class="material-icons md-settings"></i></div>
                        </div>
                        <h4 class="step-title">Shipped</h4>
                        {{-- <small class="text-muted text-sm">{{$order->orderStatus->created_at->setTimezone('Asia/Dhaka')->format('d F Y, h:iA')}}</small> --}}
                    </div>
                    @else
                    <div class="step completed">
                        <div class="step-icon-wrap">
                            <div class="step-icon"><i class="material-icons md-settings"></i></div>
                        </div>
                        <h4 class="step-title">Shipped</h4>
                        <small class="text-muted text-sm">
                            {{ Carbon\Carbon::parse($order->orderStatus->shipped_date_time)->setTimezone('Asia/Dhaka')->format('d F Y, h:iA')}}
                        </small>
                    </div>
                    @endif

                    @if($order->orderStatus->status == 'delivered')
                    <div class="step completed">
                        <div class="step-icon-wrap">
                            <div class="step-icon"><i class="material-icons md-local_shipping"></i></div>
                        </div>
                        <h4 class="step-title">{{$order->orderStatus->status}}</h4>
                        <small class="text-muted text-sm">{{ $currentStatusTime->format('d F Y, h:iA')}}</small>
                    </div>
                    @elseif($order->orderStatus->status == 'pending' || $order->orderStatus->status == 'confirmed' || $order->orderStatus->status == 'shipped')
                    <div class="step">
                        <div class="step-icon-wrap">
                            <div class="step-icon"><i class="material-icons md-local_shipping"></i></div>
                        </div>
                        <h4 class="step-title">Product Delivered</h4>
                        {{-- <small class="text-muted text-sm">{{$order->orderStatus->created_at->setTimezone('Asia/Dhaka')->format('d F Y, h:iA')}}</small> --}}
                    </div>
                    @else
                    <div class="step completed">
                        <div class="step-icon-wrap">
                            <div class="step-icon"><i class="material-icons md-local_shipping"></i></div>
                        </div>
                        <h4 class="step-title">Product Delivered</h4>
                        <small class="text-muted text-sm">
                            {{ Carbon\Carbon::parse($order->orderStatus->delivered_date_time)->setTimezone('Asia/Dhaka')->format('d F Y, h:iA')}}
                        </small>
                    </div>
                    @endif

                    @if($order->orderStatus->status == 'completed')
                    <div class="step completed">
                        <div class="step-icon-wrap">
                            <div class="step-icon"><i class="material-icons md-check_circle"></i></div>
                        </div>
                        <h4 class="step-title">{{$order->orderStatus->status}}</h4>
                        <small class="text-muted text-sm">{{ $currentStatusTime->format('d F Y, h:iA')}}</small>
                    </div>
                    @else
                    <div class="step">
                        <div class="step-icon-wrap">
                            <div class="step-icon"><i class="material-icons md-check_circle"></i></div>
                        </div>
                        <h4 class="step-title">Order Completed</h4>
                        {{-- <small class="text-muted text-sm">{{$order->orderStatus->created_at->setTimezone('Asia/Dhaka')->format('d F Y, h:iA')}}</small> --}}
                    </div>

                    @endif

                    @if($order->orderStatus->status == 'returned')
                    <div class="step completed">
                        <div class="step-icon-wrap">
                            <div class="step-icon"><i class="material-icons md-assignment_returned"></i></div>
                        </div>
                        <h4 class="step-title">{{$order->orderStatus->status}}</h4>
                        <small class="text-muted text-sm">{{ $currentStatusTime->format('d F Y, h:iA')}}</small>
                    </div>
                    @elseif($order->orderStatus->status == 'cancelled')
                        <div class="step completed">
                            <div class="step-icon-wrap">
                                {{-- import CancelRoundedIcon from '@mui/icons-material/CancelRounded'; --}}
                                <div class="step-icon"><i class="material-icons md-cancel"></i></div>
                            </div>
                            <h4 class="step-title">{{$order->orderStatus->status}}</h4>
                            <small class="text-muted text-sm">{{ $currentStatusTime->format('d F Y, h:iA')}}</small>
                        </div>
                    @endif


                </div>
            </div>
            <div class="row mb-50 mt-20 order-info-wrap text-center">
                <div class="col-md-3">
                    <article class="icontext align-items-start">
                        <div class="text">
                            <h6 class="mb-1">Customer</h6>
                            <p class="mb-1">
                                {{$order->customer->firstName}} {{$order->customer->lastName}} <br> {{$order->customer->email}} <br> (+880) {{$order->customer->phone}}
                            </p>
                            <a href="{{route('customer.profile', ['id' => $order->customer->id])}}">View profile</a>
                        </div>
                    </article>
                </div> <!-- col// -->
                <div class="col-md-3">
                    <article class="icontext align-items-start">
                        <div class="text">
                            <h6 class="mb-1">Order info</h6>
                            <p class="mb-1">
                                Shipping: Global Shipping <br> Pay method: {{$order->transaction->mode}} <br> Status: {{$order->transaction->status}}
                            </p>
                            {{-- <a href="#">Download info</a> --}}
                        </div>
                    </article>
                </div> <!-- col// -->
                <div class="col-md-3">
                    <article class="icontext align-items-start">
                        <div class="text">
                            <h6 class="mb-1">Deliver to</h6>
                            <p class="mb-1">
                                City: {{$district->name}},<br> Area: {{$postOffice->postOffice}} <br>
                                {{$order->customer->billing_address}}
                            </p>
                        </div>
                    </article>
                </div> <!-- col// -->
                <div class="col-md-3">
                    <article class="icontext align-items-start">
                        <div class="text">
                            <h6 class="mb-1">Shipping to</h6>
                            @if($order->shipping)
                            <p class="mb-1">
                                City: {{$s_district->name}},<br> Area: {{$s_postOffice->postOffice}} <br>
                                {{$order->shipping->shipping_add}}
                            </p>
                            @else
                            <p>No shipping address found.</p>
                            @endif

                        </div>
                    </article>
                </div> <!-- col// -->
            </div> <!-- row // -->
           <div class="row">
                <div class="text-center mt-100 mb-50">
                    <a class="btn btn-primary" href="{{route('order.details', ['id' => $order->id])}}">View Order Details</a>
                </div>
           </div>
    </div> <!-- card end// -->

@endsection
