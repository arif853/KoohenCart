@extends('layouts.home')
@section('title', 'Checkout')
@section('main')

@php
    $customer = auth()->guard('customer')->check()
        ? auth()->guard('customer')->user()->customer
        : null;
@endphp

<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ url('/') }}" rel="nofollow">Home</a>
                <span></span> Shop
                <span></span> Checkout
            </div>
        </div>
    </div>

    <section class="mt-50 mb-50">
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger mb-4">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @guest('customer')
                @php($showLogin = session('show_login') || $errors->has('login_identifier'))
                <div class="row mb-4">
                    <div class="col-lg-6">
                        <div class="toggle_info">
                            <span>
                                <i class="fi-rs-user mr-10"></i>
                                <span>Already have an account?</span>
                                <a href="#loginform" data-bs-toggle="collapse" aria-expanded="{{ $showLogin ? 'true' : 'false' }}">Click here to login</a>
                            </span>
                        </div>
                        {{-- Opened automatically when checkout found an existing account for
                             the phone/email that was typed in. --}}
                        <div class="panel-collapse collapse login_form {{ $showLogin ? 'show' : '' }}" id="loginform">
                            <div class="panel-body">
                                <p class="mb-20 font-sm">Log in and your cart will be waiting for you.</p>
                                <form method="post" action="{{ route('checkout.login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="login_identifier" placeholder="Phone number or email"
                                            value="{{ old('login_identifier', old('phone')) }}" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" placeholder="Password" required
                                            autocomplete="current-password">
                                    </div>
                                    <div class="login_footer form-group">
                                        <div class="chek-form">
                                            <div class="custome-checkbox">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                                <label class="form-check-label" for="remember"><span>Remember me</span></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-md" type="submit">Log in</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endguest

            <form method="post" action="{{ route('order.store') }}">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-25">
                            <h4>Delivery Details</h4>
                        </div>

                        <style>
                            .form-control {
                                border-color: #FF8B13;
                            }
                        </style>

                        <div class="row form-group">
                            <div class="col-lg-6">
                                <label for="fname" class="form-label">First name <span>*</span></label>
                                <input type="text" id="fname" name="fname" required class="form-control mb-2"
                                    placeholder="First name *"
                                    value="{{ old('fname', $customer->firstName ?? '') }}">
                            </div>
                            <div class="col-lg-6">
                                <label for="lname" class="form-label">Last name <span>*</span></label>
                                <input type="text" id="lname" name="lname" required class="form-control mb-2"
                                    placeholder="Last name *"
                                    value="{{ old('lname', $customer->lastName ?? '') }}">
                            </div>

                            <div class="col-lg-6">
                                <label for="phone" class="form-label">Phone <span>*</span></label>
                                <input type="text" id="phone" name="phone" required class="form-control mb-2"
                                    placeholder="Phone *"
                                    value="{{ old('phone', $customer->phone ?? '') }}">
                            </div>
                            <div class="col-lg-6">
                                <label for="email" class="form-label">Email address <small>(optional)</small></label>
                                <input type="email" id="email" name="email" class="form-control mb-2"
                                    placeholder="Email address"
                                    value="{{ old('email', $customer->email ?? '') }}">
                            </div>

                            <div class="col-lg-12">
                                <label for="billing_address" class="form-label">Address <span>*</span></label>
                                <input type="text" id="billing_address" name="billing_address" required
                                    class="form-control mb-2" placeholder="House, road, area *"
                                    value="{{ old('billing_address', $customer->billing_address ?? '') }}">
                            </div>
                        </div>

                        <div class="mb-20 mt-4">
                            <h5>Additional information</h5>
                        </div>
                        <div class="form-group mb-30">
                            <textarea rows="5" placeholder="Order notes (optional)" name="comment">{{ old('comment') }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="order_review">
                            <div class="mb-20">
                                <h4>Your Order</h4>
                            </div>

                            @livewire('checkout-component')

                            <div class="bt-1 border-color-1 mt-30 mb-30"></div>

                            <div class="payment_method">
                                <div class="mb-25">
                                    <h5>Payment</h5>
                                </div>
                                <div class="payment_option">
                                    <div class="custome-radio">
                                        <input class="form-check-input" type="radio" name="payment_mode"
                                            id="payment_cod" value="cod" checked>
                                        <label class="form-check-label" for="payment_cod">Cash On Delivery</label>
                                    </div>
                                    <div class="custome-radio">
                                        <input class="form-check-input" type="radio" name="payment_mode"
                                            id="payment_online" value="online">
                                        <label class="form-check-label" for="payment_online">Online Payment</label>
                                    </div>

                                    <div class="form-check mt-3">
                                        <input class="form-check-input" type="checkbox" id="agreeTerms" required>
                                        <label class="form-check-label" for="agreeTerms">
                                            I agree to the
                                            <a href="{{ url('/terms-and-condition') }}" target="_blank">Terms &amp; Conditions</a>,
                                            <a href="{{ url('/privacy_and_policy') }}" target="_blank">Privacy Policy</a> and
                                            <a href="{{ url('/cancellation_and_return') }}" target="_blank">Return and Refund Policy</a>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            @if (Cart::instance('cart')->count() > 0)
                                <button type="submit" class="btn btn-fill-out btn-block mt-30">Place Order</button>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>

<script>
    dataLayer.push({ ecommerce: null });

    dataLayer.push({
        event: "begin_checkout",
        ecommerce: {
            currency: "BDT",
            items: [@foreach (Cart::instance('cart')->content() as $product)
                {
                    item_id: "{{ $product->id }}",
                    item_name: @json($product->name),
                    price: {{ $product->price }},
                    index: {{ $loop->index }},
                    quantity: {{ $product->qty ?? 0 }},
                },@endforeach
            ]
        }
    });
</script>
@endsection
