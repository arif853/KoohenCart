<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="{{ url('/admin/assets/css/print.css') }}" rel="stylesheet">
    <title>Koohen_Invoice_{{$order->id}}</title>
   <style>
        table,
        td,
        th {
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
            width: 50%;
        }
    </style>

</head>

<body>
    @php
    $settings = DB::table('settings')->first();
    @endphp
    <div class="wrapper print-area">
        <div class="invoice_wrapper">
            <div class="header">
                <div class="logo_invoice_wrap">
                    <div class="logo_sec">
                        <img src="{{ asset('/') }}frontend/assets/imgs/Kohen_Logo_Main.png" alt="code logo"><br>

                        <div class="title_wrap">
                            <p class="sub_title">{{ $settings->company_address }}</p>
                          <p class="sub_title">{{ $settings->primary_mobile_no }} &nbsp;&nbsp;&nbsp;&nbsp;{{ $settings->email }}</p>
                        </div>
                    </div>
                    <div class="invoice_sec">
                        <p class="invoice bold" style="background-color:#e6e6e6;color:#528d52 ;padding-right:6px;">INVOICE</p>

                        <p class="date">
                            <span class="bold tera">Date :</span>&nbsp;&nbsp;
                            <span>{{ date('j F y',strtotime($order->created_at)) }} </span>
                        </p>
                        <p class="invoice_no">
                            <span class="bold tera">Invoice No :</span>&nbsp;&nbsp;
                            <span>{{ $order->order_track_id ?? ' ' }}</span>
                        </p>
                    </div>
                </div>
                <div class="bill_total_wrap" style="margin-top: 0; margin-bottom: 0;">
                    <div class="bill_sec">
                        <p class="tera bold shiping">Ship To</p>

                        <ul style="width: 100%;margin-top:5%;">
                            <li style="margin-bottom:2%;">Name <span style="font-weight: 600; margin-left:40px;">
                                   {{ $order->customer->firstName.' '.$order->customer->lastName }} </span> </li>
                            <li style="margin-bottom:2%;">Phone <span style="margin-left:40px;"> {{ $order->customer->phone }}</span>
                            </li>
                            <li style="margin-bottom:2%;">Address<span style="margin-left:36px;">{{ $order->customer->billing_address }}</span></li>

                        </ul>
                    </div>
                    <div class="total_wrap">
                        <p></p>
                        <p class="bold price"></p>
                    </div>
                </div>
            </div>
            <div class="body">
                <div class="main_table">

                    <div class="container">
                        <div class="row" style="padding:3%;margin: 0 auto;">
                            <table style="width:100%; text-align: center;">
                                <thead style="background: #99ddff">
                                    <tr>
                                        <th class="tera" style="padding: 2%; width:2%">SL</th>
                                        <th class="tera" style="padding: 2%; width:2%">Product Name</th>
                                        <th class="tera" style="padding: 2%; width:2%">Item Code</th>
                                        <th class="tera" style="padding: 2%; width:2%">Qty </th>
                                        <th class="tera" style="padding: 2%; width:2%">Unit Price </th>
                                        <th class="tera" style="padding: 2%; width:2%">Total </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->order_item as $key=>$item)
                                    <tr>
                                        <td style="padding: 2%;">{{ $key+1 }}</td>
                                        <td style="padding: 2%;">{{ $item->product->product_name }}</td>
                                        <td style="padding: 2%;">
                                            {{ $item->product->sku }}<br>

                                            @if($item->product_sizes)

                                            <span>Size :</span>
                                            <span> {{ $item->product_sizes->size }} </span>  <br>
                                           
                                            @endif
                                            <br>

                                            @if($item->product_colors)
                                            <span>Color :</span>

                                            <span> {{ $item->product_colors->color_name }} </span>

                                            @endif

                                        </td>
                                        <td style="padding: 2%;">{{ $item->quantity }}</td>
                                        <td style="padding: 2%;">{{ $item->price }}</td>
                                        <td style="padding: 2%;">{{$item->price *  $item->quantity}}</td>
                                    </tr>
                                      @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="paymethod_grandtotal_wrap">
                    <div class="paymethod_sec">

                    </div>
                    <div class="grandtotal_sec" style="padding-right:3%;font-size:12px; width:40%;">
                        <p class="" style="display: flex; flex-wrap: wrap; padding-top: 2px;background:  #99ddff;margin-right:5px; ">
                            <span style="padding-top:7px;">Sub total</span>
                            <span> <input value=" {{ $order->subtotal }}"
                                    style="width:60px;padding:2px;border-color:transparent;background-color: transparent;" />
                                &#2547;</span>
                        </p>
                        <p style="background: #e6e6e6; ">
                            <span style="padding-top:7px;">Shipping Charge</span>
                            <span><input value="{{ $order->delivery_charge }} "
                                    style="width:60px; padding:4px;border-color:transparent;background-color: transparent;" />
                                &#2547; </span>
                        </p>
                        <p style="background: #99ddff;">
                            <span style="padding-top:7px;">Total </span>
                            <span> <input value="{{ $order->total }}"
                                    style="width:60px; padding: 2px;border-color:transparent;background-color: transparent;" />
                                &#2547; </span>
                        </p>
                        <p style="background: #c9efa3;">
                            <span style="padding-top:7px;">Discount </span>
                            <span> <input value="{{ $order->discount}}"
                                    style="width:60px; padding: 2px;border-color:transparent;background-color: transparent;" />
                                &#2547; </span>
                        </p>
                        {{-- <p style="background: #ffdd99;">
                            <span style="padding-top:7px;">Advance Payment</span>
                            <span> <input value=""
                                    style="width: 40px; padding: 2px; border-color:transparent;background-color: transparent;" />
                                &#2547;</span>
                        </p> --}}
                        <p style="background: #ff80b3;">
                            <span style="padding-top:7px;">Payable Amount</span>
                            <span> <input value="{{ $order->total }}"
                                    style="width:60px; padding: 2px;border-color:transparent; background-color: transparent;" />&#2547;</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="footer">
                <div class="terms">
                    <p class="tc bold" style="font-size: 13px; margin-bottom:5px;">নিন্মোক্ত শর্ত সাপেক্ষে কোন ধরনের ডেলিভারি চার্জ ব্যতীত
                        পণ্য ফেরত দেয়া যাবে।</p>
                    <p style="font-size:14px; margin-bottom:5px;">১. &nbsp;পণ্যটি অবশ্যই ডেলিভারি ম্যান এর সামনে চেক করে দেখে নিতে হবে
                        অন্যথায় ডেলিভারি ম্যান চলে গেলে আপনার অভিযোগ গ্রহণ যোগ্য হবে না। </p>
                    <p style="font-size:14px; margin-bottom:5px;">২.&nbsp;ডেলিভারি কৃত পণ্য কালার বা সাইজ যদি অর্ডারকৃত পণ্য থেকে ব্যতিক্রম
                        হয়। </p>
                    <p style="font-size:14px; margin-bottom:5px;">৩.&nbsp;কাস্টমারের কাছে যদি পণ্য ক্ষতিগ্রস্ত অবস্থায় পৌঁছায় । </p>
                </div>
            </div>
            <div class="button_printer" style="text-align: center; padding: 20px;">
                <!-- Your existing content -->
                <button id="printButton" onclick="printInvoice()" >Print</button>
            </div>
        </div>
    </div>
    <script src="{{ url('/admin/assets/js/print.js ') }}"></script>

</body>

</html>
