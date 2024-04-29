
@extends('layouts.home')
@section('title','Track Order')

@section('main')

<main class="main">
    <div class="page-header breadcrumb-wrap">
       <div class="container">
          <div class="breadcrumb">
             <a href="{{route('home')}}" rel="nofollow">Home</a>
             <span></span> Track order
          </div>
       </div>
    </div>
    <style>
        .search-container .track-btn{
            margin-top: 25px;
            border-radius: 50px;
            float: right;
        }
        button.submit, button[type="submit"] {
            font-size: 15px;
            font-weight: 500;
            padding: 10px 40px;
            color: #ffffff;
            border: none;
            background-color: #FF8B13;
            border: 1px solid #FF8B13;
            border-radius: 5px;
        }
        button.submit, button[type="submit"]:hover {
            background-color: #FF8B13 !important;
            border: 1px solid #FF8B13;
        }
        .tab{
            display: none;
        }

        .search-menu{
            margin: 30px auto;
            width: 550px;
        }

    </style>
    <section>
        <div class="container">
            <div class="search-container my-4">
                <form  id="ordertrackform">
                    {{-- @csrf --}}
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header text-center">
                                    <h2>Start Tracking your order</h2>
                                </div>
                                <div class="card-body track_search">
                                    <div class="search-menu">
                                        {{-- <label for="form-label"> Track your order:  </label>  --}}
                                        <input type="text" class="form-control " name="" id="order_number" placeholder="Track id: K24-0000">
                                        <button class="btn btn-success track-btn" type="submit">Track</button>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </form>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12">

                    <div class="card tab">
                        <header class="card-header">
                            <div class="row align-items-center">
                                <div class="col-lg-6 col-md-6 mb-lg-0 mb-15">
                                    <span>
                                        <i class="material-icons md-calendar_today"></i> <b id="order_time">Wed, Aug 13, 2022, 4:34PM</b>
                                    </span> <br>
                                    <small class="text-muted" id="track_number">Order ID: 3453012</small> <br>
                                </div>
                            </div>
                        </header> <!-- card-header end// -->
                        <div class="card-body">
                            <div class="order-tracking mb-50">
                                <div class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between">
                                    <div class="step completed">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon">
                                                <i class="far fa-shopping-basket"></i>
                                            </div>
                                        </div>
                                        <h4 class="step-title">Order Placed</h4>
                                        <small class="text-muted text-sm">15 March 2022</small>
                                    </div>
                                    <div class="step completed">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class="fas fa-shopping-bag"></i></div>
                                        </div>
                                        <h4 class="step-title">Confirmed Order</h4>
                                        <small class="text-muted text-sm">16 March 2022</small>
                                    </div>
                                    <div class="step completed">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class="fad fa-truck-couch"></i></div>
                                        </div>
                                        <h4 class="step-title">Shipped</h4>
                                        <small class="text-muted text-sm">17 March 2022</small>
                                    </div>
                                    <div class="step">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class="fal fa-shipping-fast"></i></div>
                                        </div>
                                        <h4 class="step-title">Product Delivered</h4>
                                        <small class="text-muted text-sm">18 March 2022</small>
                                    </div>
                                    <div class="step">
                                        <div class="step-icon-wrap">
                                            <div class="step-icon"><i class="fas fa-badge-check"></i></div>
                                        </div>
                                        <h4 class="step-title">Order Completed</h4>
                                        <small class="text-muted text-sm">20 March 2022</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body text-primary">

                            <h3 class="card-title">Order Details</h3>
                            <table class="table " id="orderDetailsTable">
                                <thead>
                                    <tr>
                                        <th scope="col" class="text-start" width=10% >Ordered Date</th>
                                        <th scope="col" class="text-center">Product</th>
                                        {{-- <th scope="col" class="text-center">Varient</th> --}}
                                        <th scope="col" class="text-center">Qty</th>
                                        <th scope="col" class="text-center">Price</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <th scope="row" class="text-start"></th>
                                        <td scope="row" class="text-center">
                                            <a href="#">
                                                <img height="80px" width="80px" src="" class="image-fluid" alt="ProductImage">
                                            <p></p>
                                            </a>
                                        </td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                    </tr>


                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2" style="border: none"></td>
                                        <td class="text-end">Subtotal :</td>
                                        <td class="text-center"><span id="subtotal"></span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="border: none"></td>
                                        <td class="text-end">Delivery Type :</td>
                                        <td class="text-center"><span id="d_type"></span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="border: none"></td>
                                        <td class="text-end">Delivery Charge :</td>
                                        <td class="text-center"><span id="d_charge"></span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="border: none"></td>
                                        <td class="text-end" style="font-size: 18px; font-weight:600 ">Grand Total :</td>
                                        <td class="text-center" style="font-size: 18px; font-weight:600 "><span id="g_total"></span></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div> <!-- card end// -->


                </div>
            </div>
        </div>
    </section>
</main>

@endsection
@push('dashboard')
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.33/moment-timezone.min.js"></script>

<script>
   $(document).ready(function () {
    // Attach a submit event listener to the form
        $('#ordertrackform').submit(function (event) {
            // Prevent the default form submission
            event.preventDefault();

            // Get the track ID from the input field
            var trackId = $('#order_number').val();
            console.log(trackId);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // Make an AJAX request to fetch product details
            $.ajax({
                url: '/trackorder/order_details',
                method: 'post',
                dataType: 'json',
                data: { trackid: trackId },
                success: function (response) {

                    if (response && response.order ) {
                        console.log(response.order); // Access order details

                        var orderStatus = response.order.order_status;
                        var steps = $('.steps');
                        steps.empty();

                        var statusIcons = {
                            pending: 'far fa-shopping-basket',
                            confirmed: 'fas fa-shopping-bag',
                            shipped: 'fad fa-truck-couch',
                            delivered: 'fal fa-shipping-fast',
                            completed: 'fas fa-badge-check',
                            returned: 'fas fa-undo-alt',
                            cancelled: 'fas fa-times-circle'
                        };

                        var currentStatusIndex = ['pending', 'confirmed', 'shipped', 'delivered', 'completed'].indexOf(orderStatus.status);

                        // Iterate over all possible statuses and update the steps
                        $.each(['pending', 'confirmed', 'shipped', 'delivered', 'completed'], function(index, stepStatus) {
                            var iconClass = statusIcons[stepStatus];
                            var date = orderStatus[stepStatus + '_date_time'];
                            var formattedDate = date ?  moment.utc(date).tz('Asia/Dhaka').format('D MMM YYYY, h:mmA') : '';
                            var isCompleted = index <= currentStatusIndex;

                            steps.append(
                                '<div class="step ' + (isCompleted ? 'completed' : '') + '">' +
                                    '<div class="step-icon-wrap">' +
                                        '<div class="step-icon"><i class="' + iconClass + '"></i></div>' +
                                    '</div>' +
                                    '<h4 class="step-title">' + stepStatus.replace(/^\w/, c => c.toUpperCase()) + '</h4>' +
                                    '<small class="text-muted text-sm">' + formattedDate + '</small>' +
                                '</div>'
                            );
                        });


                        $('#orderDetailsTable tbody').empty();
                        $('.tab').css('display', 'block');
                        // Clear existing table content

                        $.each(response.orderProducts, function (index, item) {
                            var baseUrl = '{{ url('products/') }}';
                            var row = '<tr>' +
                                    '<td scope="row" class="text-start">' + response.order.created_at_formatted + '</td>' +
                                    '<td scope="row" class="text-center">' +
                                        '<a href="' + baseUrl+'/' + item.slug + '">';

                                // Check if product has images
                                if (item.product_images && item.product_images.length > 0) {
                                    // Display only the first image
                                    var firstImage = item.product_images[0].product_image;
                                    row += '<img height="80px" width="80px" src="{{asset('storage/product_images/')}}'+'/' + firstImage + '" class="image-fluid" alt="' + firstImage + '">';
                                }

                                row += '<p>' + item.product_name + '</p>' ;

                                if (item.color && item.color.length > 0) {
                                    var color = item.color.color_name;
                                    row += '<p>'+ color +'</p>';
                                }
                                if (item.size && item.size.length > 0) {
                                    var size = item.size.size_name;
                                    row += '<p>'+ size +'</p>';
                                }

                                row +=   '</a>' +
                                    '</td>' +
                                    '<td class="text-center">' + item.quantity + '</td>' +
                                    '<td class="text-center">' + item.price + '</td>' +
                                    '</tr>';


                            $('#orderDetailsTable tbody').append(row);

                            var subtotal = response.order.subtotal;
                            var deliveryCharge = response.order.delivery_charge;
                            var total = parseFloat(response.order.total);

                            $('#subtotal').text(subtotal);
                            $('#d_type').text(response.order.transaction.mode);
                            $('#d_charge').text(deliveryCharge);
                            $('#g_total').text(total.toFixed(2));
                            $('#order_time').text(response.order.created_at_formatted);
                            $('#track_number').text('Track Number: '+ response.order.order_track_id);


                        });
                    }else {
                        // Handle the case where no data is returned
                       '<h4> No data found for the order. </h4>';
                    }
                },
                error: function (error) {
                    console.error('Error fetching order data:', error);
                }
            });
        });
    });


</script>
@endpush
