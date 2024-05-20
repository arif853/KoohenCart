<?php include('include/header.php');?>

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
                <div class="row">
                    <div class="col-lg-6 mb-sm-15">
                        <div class="toggle_info">
                            <span><i class="fi-rs-user mr-10"></i><span class="">Already have an account?</span> <a href="#loginform" data-bs-toggle="collapse" class="collapsed" aria-expanded="false">Click here to login</a></span>
                        </div>
                        <div class="panel-collapse collapse login_form" id="loginform">
                            <div class="panel-body">
                                <p class="mb-30 font-sm">If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing &amp; Shipping section.</p>
                                <form method="post">
                                    <div class="form-group">
                                        <input type="text" name="email" placeholder="Username Or Email">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" placeholder="Password">
                                    </div>
                                    <div class="login_footer form-group">
                                        <div class="chek-form">
                                            <div class="custome-checkbox">
                                                <input class="form-check-input" type="checkbox" name="checkbox" id="remember" value="">
                                                <label class="form-check-label" for="remember"><span>Remember me</span></label>
                                            </div>
                                        </div>
                                        <a href="#"class="chek-form-a">Forgot password?</a>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-md" name="login">Log in</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="toggle_info">
                            <span><i class="fi-rs-label mr-10"></i><span class="">Have a coupon?</span> <a href="#coupon" data-bs-toggle="collapse" class="collapsed" aria-expanded="false">Click here to enter your Coupon code</a></span>
                        </div>
                        <div class="panel-collapse collapse coupon_form " id="coupon">
                            <div class="panel-body">
                                <p class="mb-30 font-sm">If you have a coupon code, please apply it below.</p>
                                <form method="post">
                                    <div class="form-group">
                                        <input type="text" placeholder="Enter Coupon Code...">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn  btn-md" name="login">Apply Coupon</button>
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
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-25">
                            <h4>Billing Details</h4>
                        </div>
                        <form method="post">
                            <div class=row>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" required="" name="fname" placeholder="First name *">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" required="" name="lname" placeholder="Last name *">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input required="" type="text" name="phone" placeholder="Phone *">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input required="" type="text" name="email" placeholder="Email address *">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="text" name="billing_address" required="" placeholder="Address *">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input required="" type="text" name="zipcode" placeholder="Division *">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input required="" type="text" name="zipcode" placeholder="District *">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input required="" type="text" name="zipcode" placeholder="Area *">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input required="" type="text" name="zipcode" placeholder="Postcode / ZIP *">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                <div class="checkbox">
                                    <div class="custome-checkbox">
                                        <input class="form-check-input" type="checkbox" name="checkbox" id="createaccount">
                                        <label class="form-check-label label_info" data-bs-toggle="collapse" href="#collapsePassword" data-target="#collapsePassword" aria-controls="collapsePassword" for="createaccount"><span>Create an account?</span></label>
                                    </div>
                                </div>
                            </div>
                            <div id="collapsePassword" class="form-group create-account collapse in">
                                <div class="row">
                                    <div class="col-lg-6">
                                    <input required="" type="text" placeholder="Username" name="username">
                                </div>
                                <div class="col-lg-6">
                                    <input required="" type="password" placeholder="Password" name="password">
                                </div>
                                <div class="col-lg-6 mt-3">
                                    <a href="#" class="btn "> <i class="fi-rs-box-alt mr-10"></i> Create Account</a>
                                </div>
                                </div>
                            </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="ship_detail">
                                <div class="form-group">
                                    <div class="chek-form">
                                        <div class="custome-checkbox">
                                            <input class="form-check-input" type="checkbox" name="checkbox" id="differentaddress">
                                            <label class="form-check-label label_info" data-bs-toggle="collapse" data-target="#collapseAddress" href="#collapseAddress" aria-controls="collapseAddress" for="differentaddress"><span>Ship to a different address?</span></label>
                                        </div>
                                    </div>
                                </div>
                                <div id="collapseAddress" class="different_address collapse in">
                                    <div class=row>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" required="" name="fname" placeholder="First name *">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" required="" name="lname" placeholder="Last name *">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input required="" type="text" name="phone" placeholder="Phone *">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input required="" type="text" name="email" placeholder="Email address *">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="text" name="billing_address" required="" placeholder="Address *">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input required="" type="text" name="zipcode" placeholder="Division *">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input required="" type="text" name="zipcode" placeholder="District *">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input required="" type="text" name="zipcode" placeholder="Area *">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input required="" type="text" name="zipcode" placeholder="Postcode / ZIP *">
                                    </div>
                                </div>
                            </div>
                                </div>
                            </div>
                                </div>
                            </div>


                            <div class="mb-20 mt-4">
                                <h5>Additional information</h5>
                            </div>
                            <div class="form-group mb-30">
                                <textarea rows="5" placeholder="Order notes"></textarea>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="order_review">
                            <div class="mb-20">
                                <h4>Your Orders</h4>
                            </div>
                            <div class="table-responsive order_table text-center">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Product</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="image product-thumbnail"><img src="assets/imgs/shop/thumbnail-1.jpg" alt="#"></td>
                                            <td>
                                                <h5><a href="shop-product-full.html">Yidarton Women Summer Blue</a></h5> <span class="product-qty">x 2</span>
                                            </td>
                                            <td>৳1500.00</td>
                                        </tr>
                                        <tr>
                                            <td class="image product-thumbnail"><img src="assets/imgs/shop/thumbnail-2.jpg" alt="#"></td>
                                            <td>
                                                <h5><a href="shop-product-full.html">LDB MOON Women Summe</a></h5> <span class="product-qty">x 1</span>
                                            </td>
                                            <td>৳1200.00</td>
                                        </tr>
                                        <tr>
                                            <td class="image product-thumbnail"><img src="assets/imgs/shop/thumbnail-3.jpg" alt="#"></td>
                                            <td><i class="ti-check-box font-small text-muted mr-10"></i>
                                                <h5><a href="shop-product-full.html">Women's Short Sleeve Loose</a></h5> <span class="product-qty">x 1</span>
                                            </td>
                                            <td>৳1800.00</td>
                                        </tr>
                                        <tr>
                                            <th>SubTotal</th>
                                            <td class="product-subtotal" colspan="2">৳6800.00</td>
                                        </tr>
                                        <tr>
                                            <th>Shipping</th>
                                            <td colspan="2"><em>৳60.00</em></td>
                                        </tr>
                                        <tr>
                                            <th>Total</th>
                                            <td colspan="2" class="product-subtotal"><span class="font-xl text-brand fw-900">৳6860.00</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                            <div class="payment_method">
                                <div class="mb-25">
                                    <h5>Payment</h5>
                                </div>
                                <div class="payment_option">
                                    <div class="custome-radio">
                                        <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios3" checked="">
                                        <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse" data-target="#bankTranfer" aria-controls="bankTranfer">Direct Bank Transfer</label>
                                        <div class="form-group collapse in" id="bankTranfer">
                                            <p class="text-muted mt-5">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration. </p>
                                        </div>
                                    </div>
                                    <div class="custome-radio">
                                        <input class="form-check-input" required="" type="radio" name="payment_option" id="exampleRadios4" checked="">
                                        <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse" data-target="#checkPayment" aria-controls="checkPayment">Check Payment</label>
                                        <div class="form-group collapse in" id="checkPayment">
                                            <p class="text-muted mt-5">Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode. </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="#" class="btn btn-fill-out btn-block mt-30">Place Order</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php include('include/footer.php');?>
