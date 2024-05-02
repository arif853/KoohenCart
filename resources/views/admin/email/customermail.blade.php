<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email</title>

</head>
<body style="background-color: #f3f4f6; padding: 20px;">
    <div style=" width:580px; margin:50px auto; border-radius: 8px; background-color:#fff; box-shadow: 0px 10px 15px 0px rgba(0,0,0,0.1); ">

        <div class="card-header" style=" color:#fff; border-radius: 8px 8px 0px 0; height: 60px;  background-color:#046584; padding:15px 30px; text-align:center;">
            <h2>New Order #{{$order->id}}</h2>
        </div>
        <div class="card-body" style="padding:15px 25px;">
            <h3 class="card-title"><strong>{{$order->customer->firstName}} {{$order->customer->lastName}}</strong>, your order has been placed. Login to check order status.</h3>
            <p class="card-text">
                <h4><a href="#">[Tracking No #{{$order->order_track_id}}]</a>  ({{$order->created_at->setTimezone('Asia/Dhaka')->format('M j, Y')}})</h4>
                <h4>Order Status : <span style="color: #088178; border-bottom:1px solid #088178">{{$order->orderStatus->status}}</span></h4>
            </p>
            <table cellspacing="0" cellpadding="8" border="1" bgcolor="#000000" style="width: 100%; text-align:center">
                <tr bgcolor="#ffffff" >
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                </tr>
                @foreach ($order->order_item as $item)
                <tr bgcolor="#ffffff">
                    <td>{{$item->product->product_name}}</td>
                    <td>{{$item->quantity}}</td>
                    <td>{{$item->price * $item->quantity}}</td>
                </tr>
                @endforeach

                <tr bgcolor="#ffffff" >
                    <td style="text-align: end" colspan="2" >Subtotal:</td>
                    <td>{{$order->subtotal}}</td>
                </tr>
                <tr bgcolor="#ffffff">
                    <td style="text-align: end" colspan="2" >Shipping Cost:</td>
                    <td>{{$order->delivery_charge}}</td>
                </tr>
                <tr bgcolor="#ffffff">
                    <td style="text-align: end"  colspan="2">Payment Method:</td>
                    <td>{{$order->transaction->mode}}</td>
                </tr>
                <tr bgcolor="#ffffff">
                    <td style="text-align: end" colspan="2">Total:</td>
                    <td>{{$order->total}}</td>
                </tr>
            </table>

            <div class="card-body" style="display:inline-block; border:1px solid #c0c0c0; width:40%; margin:50px 15px; border-radius: 8px; background-color:#f8f8f8; box-shadow: 15px 10px 30px -5px rgba(0,0,0,0.1); padding: 15px;">
                <h5 class="card-title">Billing Address</h5>
                <p class="card-text">Address: {{$order->customer->billing_address}}</p>
                <p>Phone: <a href="tel:{{$order->customer->phone}}">{{$order->customer->phone}}</a></p>
                <p>Email: <a href="mailto:{{$order->customer->email}}">{{$order->customer->email}}</a></p>
            </div>
            <div class="card-body" style="display:inline-block; border:1px solid #c0c0c0; width:40%; margin:50px 0; border-radius: 8px; background-color:#f8f8f8; box-shadow: 15px 10px 30px -5px rgba(0,0,0,0.1); padding: 15px;">
                <h5 class="card-title">Shipping Address</h5>
                <p class="card-text">
                    @foreach($order->customer->shipping as $key => $shipping)

                    @endforeach
                    <p>Address: {{$shipping->shipping_add}}</p>
                    <p>Phone: <a href="#">{{$shipping->s_phone}}</a></p>
                    <p>Email: <a href="#">{{$shipping->s_email}}</a></p>
                </p>
            </div>
            <p>Track Your order <a href="https://www.koohen.com/trackorder" class="">Click on.</a></p>
        </div>
    </div>
</body>
</html>
