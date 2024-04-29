
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
                                        <input type="text" required class="form-control mb-2" name="fname"
                                            placeholder="First name *">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="">
                                        <label for="" class="form-label">Last name <span>*</span></label>
                                        <input type="text" required class="form-control mb-2" name="lname"
                                            placeholder="Last name *">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="">
                                        <label for="" class="form-label">Phone <span>*</span></label>
                                        <input required type="text" class="form-control mb-2" name="phone"
                                            placeholder="Phone *">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="">
                                        <label for="" class="form-label">Email address <span>*</span></label>
                                        <input required type="text" class="form-control mb-2" name="email"
                                            placeholder="Email address *">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="">
                                        <label for="" class="form-label">Address <span>*</span></label>
                                        <input type="text" class="form-control mb-2" name="billing_address" required
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

                            @livewire('checkout-component', ['delivery_charge' => $shippingAddress->zone->zone_charge], key($shippingAddress->zone->zone_charge))
                            @else
                            @livewire('checkout-component', ['delivery_charge'])

                            @endif

                            <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                            <div class="payment_method">
                                <div class="mb-25">
                                    <h5>Payment</h5>
                                </div>
                                <div class="payment_option">
                                    <div class="custome-radio">
                                        <input class="form-check-input" type="radio" name="payment_mode"
                                            id="payment_cod" checked value="cod">
                                        <label class="form-check-label" for="payment_cod" data-bs-toggle="collapse"
                                            data-target="#bankTranfer" aria-controls="bankTranfer">Cash On
                                            Delivery</label>
                                        
                                        {{-- <div class="form-group collapse in" id="bankTranfer">
                                            <p class=" mt-5">There are many variations of passages of Lorem
                                                Ipsum available, but the majority have suffered alteration. </p>
                                        </div> --}}
                                    </div>
                                    <!-- Terms & Conditions Checkbox -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="agreeTerms" required>
                                        <label class="form-check-label" for="agreeTerms">
                                            I agree to the <a href="{{ url('/terms-and-condition') }}" target="_blank">Terms & Conditions</a>
                                        </label>
                                    </div>
                                    {{-- <div class="custome-radio">
                                        <input class="form-check-input" required type="radio" name="payment_option"
                                            id="exampleRadios4" >
                                        <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse"
                                            data-target="#checkPayment" aria-controls="checkPayment">Online
                                            Payment</label>
                                        <div class="form-group " id="checkPayment">
                                            <p class="text-muted mt-5">Please send your cheque to Store Name, Store
                                                Street, Store Town, Store State / County, Store Postcode. </p>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>



                            <button type="submit" class="btn btn-fill-out btn-block mt-30">Place Order</button>
                            {{-- @endif --}}

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>
    <script>
    // Clear the previous ecommerce object
    dataLayer.push({ ecommerce: null });

    // Push new ecommerce data to dataLayer for beginning checkout
    dataLayer.push({
        event: "begin_checkout",
        ecommerce: {
            currency: "BDT",
            items: [@foreach (Cart::content() as $product)
                {
                    item_id: "{{ $product->id }}", // Assuming sku is present in your product array
                    item_name: "{{ $product->name }}",
                    item_brand: "{{ $product->brand_name ?? "" }}", // Assuming brand_name is present in your product array
                    item_category: "{{ $product->category_name ?? "" }}", // Assuming category_name is present in your product array
                    // Add other item properties as needed
                    price: {{ $product->price }}, // Assuming regular_price is present in your product array
                    index: 0,
                    quantity: {{ $product->qty ?? 0 }},
                },@endforeach
            ]
        }
    });
</script>
@endsection
@push('checkout')
    <script>

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
