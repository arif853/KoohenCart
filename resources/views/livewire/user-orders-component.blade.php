<div class="tab-pane fade profile-header" id="pills-orders-history" role="tabpanel" aria-labelledby="pills-orders-history-tab">

    <h2>Order History</h2>
    <div class="row">
        <div class="col-lg-12">
            <div class=" mb-3" >

                {{-- <div class="card-header d-flex justify-content-between">
                <h5 class="card-title">Order Details</h5>
                <a href="#" data-bs-toggle="modal" data-bs-target="#profile_modal" class="card-icon"><i class="fad fa-edit"></i></a>
                </div> --}}
                <div class="card-body text-primary">

                    {{-- <h3 class="card-title">All Orders</h3> --}}

                    <table class="table ">
                        <thead>
                        <tr>
                            <th scope="col" class="text-center">Order date</th>
                            <th scope="col" class="text-center" width=30%>Product</th>
                            <th scope="col" class="text-center">Varient</th>
                            <th scope="col" class="text-center">Qty</th>
                            <th scope="col" class="text-center">Price</th>
                            <th scope="col" class="text-center">Status</th>
                            <th scope="col" class="text-center" width=20%> Action</th>
                        </tr>
                        </thead>
                        <tbody>

                            @foreach ($orders as $order)
                            @if ($order != null)

                                <tr>
                                    <th scope="row" class="text-center">
                                        {{$order->created_at->setTimezone('Asia/Dhaka')->format('D, M j, Y')}} <br>
                                       <span  style="color: gray ; font-size:12px;"> <small>Track id: {{$order->order_track_id}}</small></span>
                                    </th>
                                    <td >
                                        <ul>
                                            @foreach ($order->order_item as $key => $orderItem)
                                            <li>
                                                <style>
                                                    .itemside .left{
                                                    display: flex;
                                                    align-items: center;
                                                        margin-top: 4px
                                                    }
                                                </style>
                                                <a class="itemside" href="{{route('product.detail',['slug'=>$orderItem->product->slug])}}">
                                                    <div class="left">
                                                        {{-- <span>{{$key + 1}}. </span> --}}
                                                        <img src="{{asset('storage/product_images/'.$orderItem->product->product_images->first()->product_image)}}" width="40" height="40" class="img-sm img-thumbnail m-2" alt="{{$orderItem->product->slug}}">
                                                        <h6 class="mb-0 ml-2">{{ $orderItem->product->product_name }}</h6>
                                                    </div>

                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="text-center">
                                        @foreach ($order->order_item as $key => $orderItem)
                                            @if($orderItem->product->color != null || $orderItem->product->size != null)
                                            @if($orderItem->product->color != null )
                                            <ul class="list-filter color-filter">
                                                <li class="active">
                                                    <a href="#" >
                                                        <span class="product-color-red" style="background: {{$orderItem->product->color->color_code}};"></span>
                                                    </a>
                                                 </li>
                                                </ul>
                                            @endif
                                            @if($orderItem->product->size != null)
                                            <ul class="list-filter size-filter font-small">
                                                <li class="active">
                                                    <a  href="#" >{{$orderItem->product->size->size}}</a>
                                                </li>
                                            </ul>
                                            @endif
                                            {{-- <span> Color : {{ $orderItem->product->color->color_code }}</span> --}}
                                            {{-- <span> Size : {{ $orderItem->product->size->size }}</span> --}}

                                            @endif
                                        @endforeach

                                    </td>
                                    <td class="text-start">
                                        <ul >
                                            @foreach ($order->order_item as $key => $orderItem)
                                            <li class="itemside">
                                                <p class="left">{{ $orderItem->quantity }} x {{ $orderItem->price * $orderItem->quantity}}  </p>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="text-start">
                                       <span> = {{$order->total}}</span>
                                       
                                    </td>
                                    <td class="text-center">
                                        @if($order->status == 'pending')
                                        <span class="badge bg-info">{{$order->status}}</span>

                                        @elseif($order->status == 'confirmed')
                                        <span class="badge bg-primary">{{$order->status}}</span>

                                        @elseif($order->status == 'shipped')
                                        <span class="badge bg-warning">{{$order->status}}</span>

                                        @elseif($order->status == 'delivered')
                                        <span class="badge bg-warning">{{$order->status}}</span>

                                        @elseif($order->status == 'completed')
                                        <span class="badge bg-success">{{$order->status}}</span>

                                        @elseif($order->status == 'cancelled')
                                        <span class="badge bg-danger">{{$order->status}}</span>

                                        @elseif($order->status == 'returned')
                                        <span class="badge bg-secondary">{{$order->status}}</span>

                                        @endif
                                    </td>
                                    @if ($order->status == "returned")
                                        @if($order->return_confirm == 1)
                                            <td class="text-center order_status_action" >
                                                <p class="text-success">Return successful.</p>
                                            </td>
                                        @else
                                            <td class="text-center order_status_action" >
                                                <p class="text-warning">Order Return in proccess.</p>
                                            </td>
                                        @endif
                                    @else
                                    <td class="text-center order_status_action" >
                                        {{-- trackorder/order_details --}}
                                        {{-- <a href="#" class="action-btn" wire:click="trackOrder('{{ $order->order_track_id }}')">Track me</a> --}}
                                        <a href="{{url('trackorder/track_order/'.$order->order_track_id)}}" class="action-btn" >Track me</a>
                                        <a href="#" data-order-id="{{ $order->id }}" class="action-btn order_return" data-bs-toggle="tooltip" data-bs-placement="right" title="Return"><i class="fad fa-reply"></i></a>
                                        <a href="#" id="order_cancel" data-order-id="{{ $order->id }}" class="action-btn" data-bs-toggle="tooltip" data-bs-placement="right" title="Cancel"> <i class="fal fa-window-close"></i></a>
                                    </td>
                                    @endif

                                </tr>
                            @else
                            <p>you do not have any order right now.</p>
                            @endif
                            @endforeach
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
    {{-- @livewire('my-order-component') --}}
</div>
@push('order')
    <script>

        document.querySelectorAll('.order_return').forEach(function (element) {
            element.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default link behavior
            console.log('click');
            var orderId = $(this).data('order-id');
            console.log(orderId);

            // Find the closest form element related to the clicked link
            // var form = this.closest('form');
            // console.log(form)
            // Display SweetAlert confirmation
            Swal.fire({
                title: 'Are you sure?',
                text: 'You want to return it, you won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, return it!'
            }).then((result) => {
                // If confirmed, submit the corresponding form
                if (result.isConfirmed) {

                    var newStatus = "returned";

                    console.log(newStatus);
                    // Perform an AJAX request to update the status of selected orders
                    $.ajax({
                        type: 'POST',
                        url: '/customer/customer-order-return', // Update with your route
                        data: {
                            orderId: orderId,
                            newStatus: newStatus,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            // Handle success, if needed
                            location.reload();

                            // if (response.success) {
                            //     $.Notification.autoHideNotify('success', 'top right', 'Success', response.message);
                            // }
                            console.log(response);
                        },
                        error: function (error) {
                            // Handle error, if needed
                            console.error(error);
                        }
                    });
                }
            });
        });
    });
    </script>
@endpush
