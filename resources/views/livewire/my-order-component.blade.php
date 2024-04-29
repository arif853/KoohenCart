<div class="tab-pane fade profile-header" id="pills-orders" role="tabpanel" aria-labelledby="pills-orders-tab">
    <h2>My Order</h2>
    {{-- livewire component --}}
      @livewire('order-track-component')

      {{-- @foreach ($selectedOrder->order_item ?? [] as $orderItem)
      {{ $orderItem->product->product_name }}
      @endforeach --}}
        <div class="row">
            @if ($trackedOrder)
            <div class="col-lg-12">
                <div class="card  mb-3" >
                    <div class="card-body text-primary">

                        <h3 class="card-title">Order Details</h3>
                        <table class="table ">
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
                                @foreach ($trackedProduct as $key => $item)
                                <!--{{$trackedOrder->status}}-->
                                <tr>
                                    <th scope="row" class="text-start">{{$trackedOrder->created_at->setTimezone('Asia/Dhaka')->format('M j, Y, g:iA')}}</th>
                                    <td scope="row" class="text-center">
                                        <a href="#">
                                            <img height="80px" width="80px" src="{{asset('storage/product_images/'.$item->product_images->first()->product_image)}}" class="image-fluid" alt="ProductImage">
                                        <p>{{$item->product_name}}</p>
                                        </a>
                                        <p><small>
                                            @if($item->color)
                                            {{$item->color->color_name}},

                                            @endif

                                            @if($item->size)
                                            {{$item->size->size_name}}

                                            @endif
                                        </small></p>
                                    </td>

                                    <td class="text-center">{{$item->quantity}}</td>
                                    <td class="text-center">{{$item->price}}</td>
                                </tr>
                                @endforeach


                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2" style="border: none"></td>
                                    <td class="text-end">Subtotal :</td>
                                    <td class="text-center">{{$trackedOrder->subtotal}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="border: none"></td>
                                    <td class="text-end">Payment Type :</td>
                                    <td class="text-center">{{$trackedOrder->transaction->mode}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="border: none"></td>
                                    <td class="text-end">Delivery Charge :</td>
                                    <td class="text-center">{{$trackedOrder->delivery_charge}}.00</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="border: none"></td>
                                    <td class="text-end">Discount Charge :</td>
                                    <td class="text-center">{{$trackedOrder->discount}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="border: none"></td>
                                    <td class="text-end" style="font-size: 18px; font-weight:600 ">Grand Total :</td>
                                    <td class="text-center" style="font-size: 18px; font-weight:600 ">{{$trackedOrder->total}}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
  </div>
  
  @push('dashboard')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.33/moment-timezone-with-data.min.js"></script>

  <script>
      // Ensure orderStatus is an object with the expected properties
      var orderStatus = {!! json_encode($trackedOrder->orderstatus) !!};
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
          var formattedDate = date ? moment.utc(date).tz('Asia/Dhaka').format('D MMM YYYY') : '';
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
  </script>
  @endpush
