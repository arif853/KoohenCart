<!DOCTYPE html>
<html>
<head>

<style>
    body{
        font-size:10px;
        font-weight:400;
        /* letter-spacing: 1px; */
        position: relative;
    }
table, td, th {
  border: 1px solid #22212141;

}

table {
  border-collapse: collapse;
  width: 100%;

}

th, td {
  padding: 5px;
}
.customer_table{
    border: 1px solid #fff;
}
.invoice_table{
    text-align: center;
    width: 100%;
}
.invoice_table th{
    background-color:#a8cef0;
}

.tera{
    /* font-style: italic; */
}
.customer{
   float: left;

}

/* .text_margin{
    margin-top:2px;
} */
.noBorder {
    display: flex;
    justify-content: space-between;
    padding: 5px 0 5px;
    align-items: flex-end;
}
p{
    margin: 0;
}
.badge-soft-success {
    color: #34c38f;
    background-color: rgba(52, 195, 143, 0.18);
    padding: 4px !important;
    border-radius: 28px !important;
    margin-left: 20px;
    margin-top: 5px;
    width: 80px;
    text-align:center;
}

.badge-soft-danger {
    color: #f46a6a;
    background-color: rgba(244, 106, 106, 0.184);
    padding: 4px !important;
    border-radius: 28px !important;
    margin-left: 20px;
    margin-top: 5px;
    width: 40px;
    text-align:center;
}

footer{
    position: absolute;
    bottom: 30px;
    left: 40px;
    z-index: 999;
}

.bg-watermark {
    position: absolute;
    top: 35%;
    left: 90px;
    /* transform: translate3D(-50%, -50%); */
    opacity: 0.4; /* Adjust the opacity as needed */
    pointer-events: none; /* Make sure the watermark doesn't interfere with user interactions */
    width: 350px;
    z-index: -1 !important;
}
.bg-watermark img{
    opacity: 0.4;
}
.bg-watermark {
    position: absolute;
    top: 35%;
    left: 90px;
    /* transform: translate3D(-50%, -50%); */
    opacity: 0.4; /* Adjust the opacity as needed */
    pointer-events: none; /* Make sure the watermark doesn't interfere with user interactions */
    width: 350px;
    z-index: -1 !important;
}
.bg-watermark img{
    opacity: 0.4;
}
</style>
</head>

<body>

    @php
    $settings = DB::table('settings')->first();
    @endphp
    <div class="row" style="width: 100%; margin-bottom:25px;">
        <div class="content-address" style="width:60%; float:left;">
            {{-- <img src="{{ asset('frontend/assets/imgs/Kohen_Logo_Main.png')}}" alt="Logo" style="width:120px;"><br> --}}
            <img src="{{ base_path('public/frontend/assets/imgs/Kohen_Logo_Main.png')}}" alt="Logo" style="width:120px;"><br>
            <address style="margin-top:4px; font-size:8px;">{{ $settings->company_address }}</address>
            <p style="margin-top:4px; font-size:8px;">{{ $settings->secondary_mobile_no }},  {{ $settings->email }}</p>
        </div>
        <div class="invoice-content"style=" float:right;">
            <h2 style="margin-left:20px; width:70%; background: #e9e9e9b7;  text-align:center;text-transform:uppercase;color:#3abff0; padding:8px;">Invoice</h2>
            <p style="margin-left:20px; text-align:left; "><b class="tera">Date:</b> {{ date('j F, Y', strtotime($order->created_at)) }}</p>
            <p style="margin-left:20px; text-align:left;"><b class="tera">Invoice No:#</b> {{ $order->invoice_no ?? $order->id  }}</p>

                @if ($order->transaction->status == 'paid')
                    <p class="badge-soft-success">Paid</p>
                @elseif($order->transaction->status == 'unpaid')
                <p class="badge-soft-danger">Unpaid</p>

                @endif
            </div>
        </div>

    <h3 class="tera" style="margin-bottom:0%;text-transform:uppercase;">Ship To:-</h3>
    <div class="customer" style="display: flex; justify-content: space-between; align-items: center;">
        @if ($order->customer->shipping->isNotEmpty())
            <p style="margin-top:4px; font-family: 'nikosh';"> <strong>Customer Name :</strong>
                {{ $order->customer->shipping[0]->first_name.' '.$order->customer->shipping[0]->last_name }}
            </p>
            <p style="margin-top:4px; font-family: 'nikosh';"> <strong>Phone :</strong>
                {{ $order->customer->shipping[0]->s_phone }}
            </p>
            <p style="margin-top:4px; font-family: 'nikosh';"> <strong>Address :</strong>
                {{ $order->customer->shipping[0]->shipping_add }}
            </p>
        @else
        <p style="margin-top:4px; font-family: 'nikosh';"> <strong>Customer Name :</strong>{{ $order->customer->firstName.' '.$order->customer->lastName }}</p>
        <p style="margin-top:4px; font-family: 'nikosh';"> <strong>Phone :</strong>
            {{ $order->customer->phone }}
        </p>
        <p style="margin-top:4px; font-family: 'nikosh';"> <strong>Address :</strong>
        {{ $order->customer->billing_address }}
        </p>
        @endif


        </div>

        <table class="invoice_table" style="margin-top: 14px; position: absolute;z-index: 999;">
            <tr>
                <th class="tera" >SL</th>
                <th class="tera" >Product Name</th>
                <th class="tera" >Item Code</th>
                <th class="tera" >Qty</th>
                <th class="tera" >Unit Price</th>
                <th class="tera" >Total</th>
            </tr>
            @foreach ($order->order_item as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{  $item->product->product_name }}</td>
                <td style="font-size:10px;"> {{ $item->product->sku }} <br>
                    @if ($item->product_sizes)
                    <span>Size :</span>
                    <span> {{ $item->product_sizes->size }} </span>  <br>
                    @endif

                    @if ($item->product_colors)
                    <span>Color :</span>
                    <span> {{ $item->product_colors->color_name }} </span>
                    @endif

                </td>
                <td> {{ $item->quantity }}</td>
                <td> {{ $item->price }}</td>
                <td>{{ number_format($item->quantity * $item->price, 2)}}</td>
            </tr>

            @endforeach

        </table>

        <div class="row payment_table" style="width:100%; margin-top: -5px; ">
            <div class="noBorder" style="width:30%; float:right;">
                <div style="background: #99ddff; font-size:10px; padding: 4px 8px; display: flex; justify-content: space-between; align-items: center;">
                    <div style="flex-basis: 50%"><strong>Sub total:</strong></div>
                    <div style="flex-basis: 50%; text-align: right; padding-top: -13px;">{{ $order->subtotal }}</div>
                </div>
                <div style="background: #e6e6e6;  font-size:10px; padding: 4px 8px; display: flex; justify-content: space-between; align-items: center;">
                    <div style="flex-basis: 50%"><strong>Shipping Charge:</strong></div>
                    <div style="flex-basis: 50%; text-align: right; padding-top: -13px;">{{  $order->delivery_charge }}</div>
                </div>

                <div style="background: #80d190; font-size:10px; padding: 4px 8px; display: flex; justify-content: space-between; align-items: center;">
                    <div style="flex-basis: 50%"><strong>Discount:</strong></div>
                    <div style="flex-basis: 50%; text-align: right; padding-top: -13px;">{{  $order->discount }}</div>
                </div>
                <div style="background: #99ddff; font-size:10px; padding: 4px 8px; display: flex; justify-content: space-between; align-items: center;">
                    <div style="flex-basis: 50%"><strong>Total:</strong></div>
                    <div style="flex-basis: 50%; text-align: right; padding-top: -13px;">{{  $order->total }}</div>
                </div>
                <div style="background: #dde2a3; font-size:10px; padding: 4px 8px; display: flex; justify-content: space-between; align-items: center;">
                    <div style="flex-basis: 50%"><strong>Paid:</strong></div>
                    <div style="flex-basis: 50%; text-align: right; padding-top: -13px;">{{  $order->total_paid }}</div>
                </div>
                <div style="background: #ee9c55; font-size:10px; padding: 4px 8px; display: flex; justify-content: space-between; align-items: center;">
                    <div style="flex-basis: 50%"><strong>Total Due:</strong></div>
                    <div style="flex-basis: 50%; text-align: right; padding-top: -13px;">{{  $order->total_due }}</div>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <div class="row " style="width:75%; margin-top: 15px; float: left;">

            <h2 style="font-size:11px; font-family: 'nikosh';">নিন্মোক্ত শর্ত সাপেক্ষে কোন ধরনের ডেলিভারি চার্জ ব্যতীত পণ্য ফেরত দেয়া যাবে।</h2>
            <p style="font-size:10px; margin-bottom:5px;font-family: 'nikosh';">১. &nbsp;পণ্যটি অবশ্যই ডেলিভারি ম্যান এর সামনে চেক করে দেখে নিতে হবে
                    অন্যথায় ডেলিভারি ম্যান চলে গেলে আপনার অভিযোগ গ্রহণ যোগ্য হবে না। </p>
            <p style="font-size:10px; margin-bottom:5px;font-family: 'nikosh';">২.&nbsp;ডেলিভারি কৃত পণ্য কালার বা সাইজ যদি অর্ডারকৃত পণ্য থেকে ব্যতিক্রম হয়। </p>
            <p style="font-size:10px; margin-bottom:5px;font-family: 'nikosh';">৩.&nbsp;কাস্টমারের কাছে যদি পণ্য ক্ষতিগ্রস্ত অবস্থায় পৌঁছায় । </p>
        </div>
        <div style="width:20%; margin-top: 15px; float: right; text-align:right; background:transparent;">
            @php
            $data = "Invoice: $order->invoice_no, Total: $order->total, Website: https://www.koohen.com";
                $qrcode = DNS2D::getBarcodePNG($data, 'QRCODE',2,2);
                // echo $qrcode;
            @endphp
            <img src="data:image/png;base64, {{$qrcode}} " alt="https://www.koohen.com" style="margin-left: 15px; padding:4px; border: 1px solid;"/>
        </div>
    </footer>

    <div class="bg-watermark">
        <img class="watermark" style="opacity: 0.08;" src="{{ base_path('public/frontend/assets/imgs/Kohen_Favicon.png')}}" alt="Watermark">
        {{-- <img class="watermark" style="opacity: 0.08;" src="{{ asset('frontend/assets/imgs/Kohen_Favicon.png')}}" alt="Watermark"> --}}
    </div>
</body>
</html>
