<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   
    <link href="{{ url('/admin/assets/css/print.css') }}" rel="stylesheet">
    <title>Koohen Invoice</title>
    <style>
    @page 
    {
          /* auto is the initial value */
        margin:0mm;  /* this affects the margin in the printer settings */
        height: 0mm;
    }
    </style>

</head>
<body>
    @php
    $settings = DB::table('settings')->first();
    @endphp
    <div class="invoice-wrapper" id="print-area">
        <div class="invoice">
            <div class="invoice-container">
                <div class="invoice-head">
                    <div class="invoice-head-top">
                        <div class="invoice-head-top-left text-start">
                        
                            <img src="{{ asset('/') }}frontend/assets/imgs/Kohen_Logo_Main.png">

                            <p><span class="text_soft">{{ $settings->company_address }}</span></p>
                            <p><span class="text_soft">{{ $settings->primary_mobile_no }}</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span class="text_soft">{{ $settings->email }}</span></p>
                        </div>
                        <div class="invoice-head-top-right text-end">
                            <div id="invoice-title" style="padding:6px;">
                                <h3 style="background-color:#84aa65;">Invoice</h3>
                            </div>
                           
                            <p><span class="text-bold font-style">Date</span> : {{ date('j F y',strtotime($order->created_at)) }}</p>
                            <p >
                                <span class="text-bold font-style">Invoice No : {{ $order->order_track_id ?? 'K25-5200' }}</span>
                            </p>
                        </div>
                    </div>


                    <div class="invoice-head-bottom">
                        <div class="invoice-head-bottom-left">
                            <ul class="text_soft">
                                {{-- This order's delivery details, not the customer's current profile. --}}
                                @php($shipTo = $order->deliveryDetails())
                                <li class="text-bold font-style">SHIP To:</li>
                                <li>Name : {{ $shipTo->name }}</li>
                                <li>Phone: {{ $shipTo->phone }}</li>
                                <li>Address: {{ $shipTo->address }}</li>

                            </ul>
                        </div>
                        <div class="invoice-head-bottom-right">

                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="invoice-body">
                      
                        <table class="text-center">
                            <tr style="background-color:#a8cef0;font-style:italic">
                                <th class="text-bold">SL</th>
                                <th class="text-bold">Product</th>
                                <th class="text-bold">Item Code</th>
                                <th class="text-bold">QTY</th>
                                <th class="text-bold">Unit Price</th>
                                <th class="text-bold">Total</th>
                            </tr>
                          
                            @foreach ($order->order_item as $key=>$item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                             
                                <td>{{ $item->product->product_name }}</td>
                                <td>
                                    {{ $item->product->sku }}<br>
                                   
                                    @foreach ($item->product->sizes as $size)
                                     <strong> Size :</strong> {{$size->size }} 
                                     <br>
                                    @endforeach
                                   
                                </td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->price }}</td>
                                <td class="">{{$item->quantity * $item->price}} &#2547;</td>
                            </tr>
                            @endforeach
                            
                        
                        </table>
                        <div class="invoice-body-bottom text-end">
                            
                            <div class="invoice-body-info-item noborder" style="display: flex; justify-content: flex-end;">
                                <table class="table">
                                    <tr style="background-color:#a8cef0">
                                      <th>Sub Total:</th>
                                      <td>
                                        {{ $order->subtotal }} &#2547;
                                    </td>
                                    </tr>
                                    <tr style="background-color:#eeeee8">
                                      <th>Shipping Charge:</th>
                                      <td>{{ $order->delivery_charge }} &#2547;</td>
                                    </tr>
                                    <tr style="background-color:#a8cef0">
                                      <th>Total:</th>
                                      <td>{{ $order->total }} &#2547;</td>
                                    </tr>
                                    <tr style="background-color:#99ffdd">
                                        <th>Discount:</th>
                                        <td>{{ $order->discount}} &#2547;</td>
                                      </tr>
                                      <tr style="background-color:#ffe6b3">
                                        <th>Payable Amount:</th>
                                        <td>{{ $order->total }} &#2547;</td>
                                      </tr>
                                </table>
                              
                            </div>
                          
                        </div>
                    </div>
                </div>
                <div class="invoice-foot" style="margin-top:25%;">
                    <h5><span class="text-bold" style=""></span>নিন্মোক্ত শর্ত সাপেক্ষে কোন ধরনের ডেলিভারি চার্জ ব্যতীত পণ্য ফেরত দেয়া যাবে</h5>
                    <ul class="text_soft">
                        <li class="text_soft"><p style="margin-right:2px;margin-bottom:5px;font-size:12px;width:100cm;">১. &nbsp;পণ্যটি অবশ্যই ডেলিভারি ম্যান এর সামনে চেক করে দেখে নিতে হবে অন্যথায় ডেলিভারি ম্যান চলে গেলে আপনার অভিযোগ গ্রহণ যোগ্য হবে না </p></li>
                        <li class="text_soft"><p style="margin-right:2px;margin-bottom:5px;font-size:12px;width:100cm;"> ২.&nbsp;ডেলিভারি কৃত পণ্য কালার বা সাইজ যদি অর্ডারকৃত পণ্য থেকে ব্যতিক্রম হয় </p></li>
                        <li class="text_soft"><p style="margin-right:2px;margin-bottom:5px;font-size:12px;width:100cm;">৩.&nbsp;কাস্টমারের  কাছে যদি পণ্য ক্ষতিগ্রস্ত অবস্থায় পৌঁছায় </p></li>

                    </ul>
                    <div class="invoice-btns">
                        <button type ="button" class="invoice-btn"  id ="btnPrint">
                            <span>
                                <i class="fa-solid fa-print"></i>
                            </span>
                            <span>Print</span>
                        </button>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const $btnPrint = document.querySelector("#btnPrint");
        $btnPrint.addEventListener("click", () => {
            window.print();
        });
    </script>
    
</body>

</html>