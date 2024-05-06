<style>
    @media print {
        /* Hide elements not needed for printing */
        .no-print {
            display: none;
        }
        /* Define styles for print layout */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .item{
            color: #000;
            text-decoration: none
        }
        .item span{
            font-size: 10px;
            color: #adadad !important;
        }
        table tr td{
            padding: 2px;
            text-align: center;
            font-size: 10px
        }
    }

</style>
<!-- HTML table structure -->
<div style="text-align: center">
    <h3>Koohen-Report</h3>
    <p>Size Wise Stock Report.</p>
</div>
<table class="table table-striped" id="datatable">
    <thead>
        <th>ID</th>
        <th>Product</th>
        <th width=50%>Size</th>
    </thead>
    <tbody>
        <!-- Table body -->
        @foreach ($products as $key => $product)
            <tr>
                <td>{{$key+1}}</td>
                <td class="item">
                    <h6 >{{$product->product_name}}</h6>
                    <span style="font-size: 10px;">{{$product->sku}}</span>
                </td>
                <td>
                    <table style="width: 400px">
                        <tr>
                            <td rowspan="2" >
                                Purchase
                            </td>
                            @foreach ($product->sizes as $size)
                                <td style="font-weight:bold;">S-{{$size->size_name}}</td>
                            @endforeach
                            <td>Total</td>
                        </tr>
                        <tr>
                            @foreach ($product->sizes as $data)
                                <td>{{$data->inStock}}</td>
                            @endforeach
                            <td>{{$product->totalInStock}}</td>
                        </tr>
                        <tr>
                            <td>Sold</td>
                            @foreach ($product->sizes as $data)
                                <td>{{$data->outStock}}</td>
                            @endforeach
                            <td>{{$product->totalOutStock}}</td>
                        </tr>
                        <tr>
                            <td>Stock</td>
                            @foreach ($product->sizes as $data)
                                <td>
                                    @if ($data->balance > 0)
                                    <div class="stock-value">{{$data->balance}} </div>
                                    @else
                                    <span class="text-danger font-sm">Stock out</span>
                                    @endif
                                </td>
                            @endforeach
                            <td>{{$product->totalBalance}}</td>
                        </tr>
                    </table>
                </td>
                        <!-- Display stock data for each size -->
            </tr>
        @endforeach
    </tbody>
</table>
