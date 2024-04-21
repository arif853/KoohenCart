
@extends('layouts.home')
@section('title', 'Checkout')
@section('main')

<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow">Home</a>
                <span></span> Shop
                <span></span> Checkout
            </div>
        </div>
    </div>

    <section class="mt-50 mb-50">
        <div class="container">
                    <!-- Display validation errors -->
            @if($errors->any())
            <div class="alert alert-danger mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="row">
                @auth('customer')
                    @php
                    $user = Auth::guard('customer')->user();
                    $fullName = $user->customer->firstName . ' ' . $user->customer->lastName;
                    @endphp

                    {{-- <a href="{{route('customer.dashboard')}}">{{ $fullName }}</a> --}}

                    {{-- <form method="post" action="{{ route('customer.logout') }}">
                        @csrf
                        <button type="submit">Logout</button>
                    </form> --}}
                @else
                <div class="col-lg-6 mb-sm-15">
                    <div class="toggle_info">
                        <span><i class="fi-rs-user mr-10"></i><span class="">Already have an account?</span> <a
                                href="#loginform" data-bs-toggle="collapse" class="collapsed"
                                aria-expanded="false">Click here to login</a></span>
                    </div>
                    <div class="panel-collapse collapse login_form" id="loginform">
                        <div class="panel-body">
                            <p class="mb-30 font-sm">If you have shopped with us before, please enter your details
                                below. If you are a new customer, please proceed to the Billing &amp; Shipping
                                section.</p>
                            <form method="post" action="{{route('checkout.login')}}">
                                @csrf
                                @method('POST')
                                <div class="form-group">
                                    <input placeholder="Email or Phone Number" id="login_identifier" type="text" name="login_identifier" :value="old('login_identifier')" required autofocus autocomplete="login_identifier">
                                </div>
                                <div class="form-group">
                                    <input placeholder="Password" type="password"
                                    name="password" required autocomplete="current-password" id="password" >
                                </div>
                                <div class="login_footer form-group">
                                    <div class="chek-form">
                                        <div class="custome-checkbox">
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                id="remember" value="">
                                            <label class="form-check-label" for="remember"><span>Remember
                                                    me</span></label>
                                        </div>
                                    </div>
                                    {{-- <a href="#" class="chek-form-a">Forgot password?</a> --}}
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-md" name="submit" type="submit">Log in</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endauth

                <div class="col-lg-6">
                    <div class="toggle_info">
                        <span><i class="fi-rs-label mr-10"></i><span class="">Have a coupon?</span> <a
                                href="#coupon" data-bs-toggle="collapse" class="collapsed"
                                aria-expanded="false">Click here to enter your Coupon code</a></span>
                    </div>
                    <div class="panel-collapse collapse coupon_form " id="coupon">
                        <div class="panel-body">
                            <p class="mb-30 font-sm">If you have a coupon code, please apply it below.</p>
                            <form id="coupne_form">

                                <div class="form-group">
                                    <input type="text" placeholder="Enter Coupon Code..." id="coupne" name="coupne">
                                </div>
                                <div class="form-group">
                                    <button class="btn  btn-md" name="login" type="submit">Apply Coupon</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="divider mt-50 mb-50"></div>
                </div>
            </div>
            <form method="post" action="{{route('order.store')}}" novalidate>
                @csrf
                @method('POST')
                <div class="row ">
                    <div class="col-md-6">
                        <div class="mb-25">
                            <h4>Billing Details</h4>
                        </div>
                        <style>
                            .form-control {
                                border-color: #FF8B13;
                            }
                            .form-group select {
                                background: #fff;
                                border: 1px solid #FF8B13;
                                height: 40px;
                                -webkit-box-shadow: none;
                                box-shadow: none;
                                padding-left: 20px;
                                font-size: 13px;
                                color: #414042;
                                width: 100%;
                                border-radius: 50px;
                            }
                        </style>
                        @auth('customer')
                        @php
                        $user = Auth::guard('customer')->user();
                        $fullName = $user->customer->firstName . ' ' . $user->customer->lastName;
                        // Retrieve shipping details using the relationship
                        $shippingAddress = $user->customer->shipping->first(); // Assuming you have a one-to-many relationship

                        // If you have multiple shipping addresses and want to get the first one, you can use:
                        // $shippingAddress = $user->customer->shipping->first();
                        @endphp

                            <p><strong>Name:</strong> {{$fullName}}</p>
                            <p><strong>Phone:</strong> {{$user->customer->phone}}</p>
                            <p><strong>Email:</strong> {{$user->customer->email}}</p>

                            @if($user->customer->billing_address == null)
                            <p><strong>Billing Address:</strong>  <span class="text-danger">You don't have any address.</span></p>

                            @else
                            <p><strong>Billing Address:</strong> {{$user->customer->billing_address}}</p>
                            @endif

                            @if($shippingAddress)
                            <div class="mt-25 mb-2">
                                <h4>Default Shipping Details</h4>
                            </div>

                            <p ><strong>Name:</strong> {{$shippingAddress->first_name}} {{$shippingAddress->last_name}}</p>
                            <p><strong>Phone:</strong> {{$shippingAddress->s_phone}}</p>
                            <p><strong>Email:</strong> {{$shippingAddress->s_email}}</p>
                            <p><strong>Shipping Address:</strong> {{$shippingAddress->shipping_add}}</p>
                            {{-- <p><strong>Shipping cost:</strong> ৳{{$shippingAddress->zone->zone_charge}}</p> --}}

                            @endif
                        @else

                            <div class="row form-group" >
                                <div class="col-lg-6">
                                    <div class="">
                                        <label for="" class="form-label">First name <span>*</span></label>
                                        <input type="text" required class="form-control mb-2" name="fname" id="customer_fname"
                                            placeholder="First name *">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="">
                                        <label for="" class="form-label">Last name <span>*</span></label>
                                        <input type="text" required class="form-control mb-2" name="lname" id="customer_lname"
                                            placeholder="Last name *">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="">
                                        <label for="" class="form-label">Phone <span>*</span></label>
                                        <input required type="text" class="form-control mb-2" name="phone" id="customer_phone"
                                            placeholder="Phone *">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="">
                                        <label for="" class="form-label">Email address <span>*</span></label>
                                        <input required type="text" class="form-control mb-2" name="email" id="customer_email"
                                            placeholder="Email address *">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="">
                                        <label for="" class="form-label">Address <span>*</span></label>
                                        <input type="text" class="form-control mb-2" name="billing_address" required id="customer_address"
                                            placeholder="Address *">
                                    </div>
                                </div>

                                @livewire('billing-area-component')

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <div class="custome-checkbox">
                                                <input class="form-check-input" type="checkbox" name="is_createaccount"
                                                    id="createaccount">
                                                <label class="form-check-label label_info" data-bs-toggle="collapse"
                                                    href="#collapsePassword" data-target="#collapsePassword"
                                                    aria-controls="collapsePassword" for="createaccount"><span>Create an account?</span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="collapsePassword" class="create-account collapse in">
                                        <div class="row form-group">
                                            <label for="" class="mb-2"><span>* </span>Use your billing email or phone to sign in.</label>
                                            <div class="col-lg-6">
                                                <input type="password" class="form-control"
                                                    placeholder="Password" name="password">
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="password" class="form-control"
                                                    placeholder="Confirm Password" name="c_password">
                                            </div>
                                            {{-- <div class="col-lg-6 mt-3">
                                                <a href="#" class="btn "> <i class="fi-rs-box-alt mr-10"></i> Create
                                                    Account</a>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="ship_detail">
                                        <div class="form-group">
                                            <div class="chek-form">
                                                <div class="custome-checkbox">
                                                    <input class="form-check-input" type="checkbox" name="is_shipping"
                                                        id="differentaddress">
                                                    <label class="form-check-label label_info" data-bs-toggle="collapse"
                                                        data-target="#collapseAddress" href="#collapseAddress"
                                                        aria-controls="collapseAddress"
                                                        for="differentaddress"><span>Ship to a different
                                                            address?</span></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="collapseAddress" class="different_address collapse in">
                                            <div class=row>
                                                <div class="col-lg-6">
                                                    <div class="">
                                                        <label for="" class="form-label">First name <span>*</span></label>
                                                        <input type="text" class="form-control mb-2" required name="shipper_fname"
                                                            placeholder="First name *">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="">
                                                        <label for="" class="form-label">Last Name <span>*</span></label>
                                                        <input type="text" class="form-control mb-2" required name="shipper_lname"
                                                            placeholder="Last name *">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-lg-6">
                                                    <div class="">
                                                        <label for="" class="form-label">Phone <span>*</span></label>
                                                        <input required class="form-control mb-2" type="text" name="shipper_phone"
                                                            placeholder="Phone *">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="">
                                                        <label for="" class="form-label">Email address <span>*</span></label>
                                                        <input required class="form-control mb-2" type="text" name="shipper_email"
                                                            placeholder="Email address *">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col-lg-12">
                                                    <div class="">
                                                        <label for="" class="form-label">Shipping Address <span>*</span></label>
                                                        <input type="text" class="form-control mb-2" name="shipper_address" required
                                                            placeholder="Address *">
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- area seletor componet --}}
                                            @livewire('area-select-component')

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-20 mt-4">
                                <h5>Additional information</h5>
                            </div>
                            <div class="form-group mb-30">
                                <textarea rows="5" placeholder="Order notes" name="comment"></textarea>
                            </div>
                        @endauth

                    </div>
                    <div class="col-md-6">
                        <div class="order_review">
                            <div class="mb-20">
                                <h4>Your Orders</h4>
                            </div>
                            {{-- || $itemData --}}
                            @auth('customer')

                            @livewire('checkout-component', ['deliveryCharge' => $shippingAddress->zone->zone_charge], key($shippingAddress->zone->zone_charge))

                            @else
                            @livewire('checkout-component', ['deliveryCharge'])

                            @endif
                            {{-- Delivery Charge: {{ $deliveryCharge }} --}}
                            <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                            <div class="payment_option">
                                <div class="custome-radio">
                                    <input class="form-check-input" type="radio" name="payment_mode" id="payment_cod" value="cod" checked>
                                    <label class="form-check-label" for="payment_cod">
                                        Cash On Delivery
                                    </label>
                                    <br>
                                    <input class="form-check-input" type="radio" name="payment_mode" id="payment_online" value="online">
                                    <label class="form-check-label" for="payment_online">
                                        Online Payment
                                    </label>
                                    <br>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg btn-block" id="sslczPayBtn"
                                    token="if you have any token validation"
                                    postdata="your javascript arrays or objects which requires in backend"
                                    order="If you already have the transaction generated for current order"
                                    endpoint="{{ url('/pay-via-ajax') }}" style="display: none;" >Order and Pay</button>

                            <button type="submit" class="btn btn-fill-out btn-block mt-30" id="placeorder">Place Order</button>
                        </div>
                    </div>
                </div>

                {{-- <input type="hidden" value="{{$order->customer->firstName}}" id="customer_fname">
                <input type="hidden" value="{{$order->customer->phone}}" id="customer_phone">
                <input type="hidden" value="{{$order->customer->email}}" id="customer_email">
                <input type="hidden" value="{{$order->customer->billing_address}}" id="customer_address">
                <input type="hidden" value="{{$order->total}}" id="t_amount"> --}}
            </form>
        </div>
    </section>
</main>

@endsection
@push('checkout')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the radio buttons and buttons
            const paymentCOD = document.getElementById('payment_cod');
            const paymentOnline = document.getElementById('payment_online');
            const placeOrderButton = document.getElementById('placeorder');
            const payNowButton = document.getElementById('sslczPayBtn');

            // Add event listener to radio buttons
            paymentCOD.addEventListener('change', function() {
                placeOrderButton.style.display = 'block';
                payNowButton.style.display = 'none';
            });

            paymentOnline.addEventListener('change', function() {
                placeOrderButton.style.display = 'none';
                payNowButton.style.display = 'block';
            });
        });

        var obj = {};
        obj.cus_name = $('#customer_fname').val();
        obj.cus_phone = $('#customer_phone').val();
        obj.cus_email = $('#customer_email').val();
        obj.cus_addr1 = $('#customer_address').val();
        obj.amount = $('#t_amount').val();

        $('#sslczPayBtn').prop('postdata', obj);

        (function (window, document) {
            var loader = function () {
                var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
                // script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR LIVE
                script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR SANDBOX
                tag.parentNode.insertBefore(script, tag);
            };

            window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
        })(window, document);

    $("#coupne_form").submit(function(event) {
        event.preventDefault(); // Prevent form submission
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var couponCode = $('#coupne').val(); // Get coupon code from input
        // console.log(couponCode);
        // Send AJAX request to apply coupon
        $.ajax({
            url: '{{route('applied.coupone')}}',
            method: 'post',
            data: { coupne: couponCode },
            success: function(response) {
                // Handle successful response
                if(response.status == 200){
                    // console.log(response.status);
                    // console.log(response.coupon);

                    if (response.coupon !== undefined) {

                        if (response.coupon.discounts_type == 'percent') {
                            // If discount is less than 0, it's a percentage value
                            var discountValue = parseFloat(response.coupon.percent_value);
                            var subtotal = parseFloat($("input[name='subtotal']").val());
                            var deliveryCharge = parseFloat($("#shipping_cost").val());
                            var discount = subtotal * (discountValue/100); // Calculate discount amount
                            var totalAmount = subtotal + deliveryCharge - discount; // Subtract discount amount from total
                            // console.log(discount);
                        } else {
                            // If discount is greater than or equal to 0, it's a fixed value
                            var discount = parseFloat(response.coupon.fixed);
                            var subtotal = parseFloat($("input[name='subtotal']").val());
                            var deliveryCharge = parseFloat($("#shipping_cost").val());
                            var totalAmount = subtotal + deliveryCharge - discount; // Subtract fixed discount from total
                            // console.log(discount);

                        }
                        // Update discount value display
                        $("#discountValue").text("৳" + discount);
                        $("#discount").val(discount); // Update hidden discount input value
                        $("#coupon_code").val(response.coupon.coupons_code)
                        // Update total amount display
                        $("#totalAmount").text("৳" + totalAmount);
                        $("#t_amount").val(totalAmount); // Update hidden total amount input value

                        $.Notification.autoHideNotify('success', 'top right', 'Success', response.message);

                    } else {
                        $.Notification.autoHideNotify('danger', 'top right', 'Error', response.message);
                        // console.log(response.error);
                    }
                }
                else{
                    $.Notification.autoHideNotify('danger', 'top right', 'Error', response.message);
                    // console.log(response.message);
                }
            },
            error: function(xhr, status, error) {
                // Handle error response
                // alert('Failed to apply coupon. Please try again.');
                $.Notification.autoHideNotify('danger', 'top right', 'Error', response.message);
                // location.reload();
            }
        });
    });
    </script>
@endpush
