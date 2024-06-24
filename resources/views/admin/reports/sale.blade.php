
    @extends('layouts.admin')
    @section('title','Sale Report')
    @section('content')


    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Sales Report </h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{'/dashborad'}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('sale.report')}}">Report</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sale</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <header class="card-header d-flex justify-content-between">
                    <div>
                        <h5 class="mb-3">Filter by</h5>
                    <form action="#">
                        <div class="row">
                            <div class="col-md-3 mb-4">
                                <label for="order_customer" class="form-label">Customer</label>
                                <input type="text" placeholder="Type here" class="form-control" id="order_customer">
                            </div>
                            <div class="col-md-2 mb-4">
                                <label for="invoice_no" class="form-label">Invoice No</label>
                                <input type="text" placeholder="Type here" class="form-control" id="invoice_no">
                            </div>
                            <div class="col-md-2 mb-4">
                                <label for="productSku" class="form-label">Product Sku</label>
                                <input type="text" placeholder="Type Product Sku here" class="form-control" id="productSku">
                            </div>
                            <div class="col-md-2 mb-4">
                                <label for="size" class="form-label">Size</label>
                                <input type="text" placeholder="Type Size " class="form-control" id="size">
                            </div>
                            <div class="col-md-2 mb-4">
                                <label for="category" class="form-label">Category</label>
                                <select name="category" class="form-control" id="category">
                                    <option value="">-- Select Category --</option>
                                    @php
                                        $categories = DB::table('categories')->get();
                                    @endphp
                                    @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2 mb-4">
                                <label for="start_date" class="form-label">From date</label>
                                <input type="date" placeholder="Type here" class="form-control" id="start_date" name="start_date">
                            </div>
                            <div class="col-md-2 mb-4">
                                <label for="end_date" class="form-label">To date</label>
                                <input type="date" placeholder="Type here" class="form-control" id="end_date" name="end_date">
                            </div>
                            <div class="col-md-1 mb-4">
                                {{-- <label for="submit" class="form-label"></label> --}}
                                <button type="submit" class="btn btn-primary btn-sm mt-25" id="submit">Filter</button>
                            </div>
                        </div>
                    </form>
                    </div>

                    <div class="mt-50">
                        <button id="print-btn" class="btn btn-info ">
                            <i class="material-icons md-print"></i>

                            <span class="ml-2">Print</span>
                        </button>
                    </div>

                </header>
                <style>
                    table,
                    tbody,
                    thead,
                    tfoot,
                    tr,
                    td,
                    th
                    {
                        border: 1px solid #dcdcdc;
                    }
                </style>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="myTable">
                            <thead >
                                <tr >
                                    <th width="5" >#</th>
                                    <th width="10%" class="text-center">Order</th>
                                    <th width="25%" class="text-center">Customer</th>
                                    <th class="text-center">Invoice No</th>
                                    <th width="25%" class="text-center">Product</th>
                                    <th class="text-center">Total</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                @foreach ($orders as $key => $order)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td class="text-center">
                                       <span>Order No. #{{$order->id}}</span>
                                        <br>
                                        <small>Date: {{$order->created_at->setTimezone('Asia/Dhaka')->format('M j, Y')}}</small>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ url('/orders/invoice/'.$order->id) }}" target="__blank">
                                           <span>{{$order->customer->firstName}} {{$order->customer->lastName}}</span>, <br>
                                           <span>{{$order->customer->phone}}</span>,<br>
                                           <span>{{$order->customer->billing_address}}.</span>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        Invoice No:
                                        <a href="{{ url('/orders/invoice/'.$order->id) }}" target="__blank">
                                            {{$order->invoice_no}}
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        @foreach ($order->order_item as $key=>$item)
                                        {{-- <strong>Item:</strong> --}}
                                        <a href="#">
                                             {{$item->product->sku}}
                                        </a>,
                                        @if ($item->product_sizes)
                                        <span>Size: {{$item->product_sizes->size}}</span>,
                                        @endif
                                        <br>
                                        <span>Qty: {{$item->quantity}} * {{$item->price}}</span>.
                                        <br>
                                        <br>
                                        @endforeach
                                    </td>
                                    <td class="text-center">{{$order->total}}</td>
                                </tr>
                                @endforeach

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3"></th>
                                    <th class="text-end">Total:</th>
                                    <th id="total-amount">1500.00</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div> <!-- table-responsive //end -->
                </div> <!-- card-body end// -->
            </div> <!-- card end// -->
        </div>

    </div>

    @endsection

    @push('report')
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    {{-- <script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script> --}}
    <script>
        // $('#myTable').DataTable({
            // processing: true,
            // // serverSide: true,
            // // ... other DataTable options ...
            // dom: 'Bfrtip',
            // buttons: [
            //     'copy', 'csv', 'excel', 'pdf', 'print'
            // ],
            // ... your data source and columns definition ...
        // });

        $(document).ready(function() {


        var total = 0;
        // Loop through each row in the table
        $('#myTable tbody tr').each(function() {
            // Get the value in the "Total" column for the current row
            var orderTotal = parseFloat($(this).find('td:last').text());

            // Add the value to the total
            total += orderTotal;
        });

        // Display the total in the footer row
        $('#myTable tfoot tr th:last').text(total.toFixed(2));

        var tbody = $('#myTable tbody');
        var totalFooterCell = $('#total-amount'); // assuming you have a specific cell for total amount
        var printBtn = $('#print-btn');

        $('#order_customer, #invoice_no, #productSku, #size').keyup(function() {

            var searchTermCustomer = $('#order_customer').val().trim();
            var searchTermInvoice = $('#invoice_no').val().trim();
            var productsku = $('#productSku').val().trim();
            var sizeName = $('#size').val().trim();
            // var categoryId = $('#category').val();
            console.log(productsku);

            // Check if either search term is not empty
            if (searchTermCustomer !== '' || searchTermInvoice !== '' || productsku !== '' || sizeName !== '') {
            // Show loading indicator
            // loadingIndicator.show();
            // console.log(searchTerm);

                $.ajax({
                    url: '{{ route('search.sale') }}',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        customer: searchTermCustomer,
                        invoice_no: searchTermInvoice,
                        sku: productsku,
                        size: sizeName,
                        // category: categoryId
                    },
                    success: function(response) {
                        console.log(response);
                        // var ul = showProductDiv.find('ul');
                        tbody.empty();

                        if (response.length === 0) {
                            tbody.append('<tr>No products found</tr>');
                            totalFooterCell.text('0.00');
                        } else {
                            // var totalAmount = 0;

                            response.forEach(function (order, index) {
                                var invoiceUrl = '{{ url('orders/invoice/') }}' + '/' + order.id;
                                var formattedDate = new Date(order.created_at).toLocaleDateString('en-US', {
                                    year: 'numeric',
                                    month: 'long',
                                    day: 'numeric'
                                });
                                var orderItemsHtml = '';
                                order.order_item.forEach(function (item, index) {
                                    console.log(item.product);
                                    var sizeHtml = '';
                                    if (item.product_sizes) {
                                        sizeHtml = `<span>Size: ${item.product_sizes.size}</span>`;
                                    }
                                    orderItemsHtml += `
                                        <div>
                                            <a href="#">${item.product.sku}</a>,
                                            ${sizeHtml}
                                            <br>
                                            <span>Qty: ${item.quantity} * ${item.price}</span>
                                            <br>
                                            <br>
                                        </div>`;
                                });

                                var tr = `<tr>
                                    <td>${index + 1}</td>
                                    <td class="text-center">
                                        <span>Order No. #${order.id}</span>
                                        <br>
                                        <small>Date: ${formattedDate}</small>
                                    </td>
                                    <td class="text-center">
                                        <a href="${invoiceUrl}" target="_blank">
                                            <span>${order.customer.firstName} ${order.customer.lastName}</span>, <br>
                                            <span>${order.customer.phone}</span>,<br>
                                            <span>${order.customer.billing_address}</span>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <span>Invoice No:</span>
                                        <a href="${invoiceUrl}" target="_blank">
                                            ${order.invoice_no}
                                        </a>
                                    </td>
                                    <td class="text-center">${orderItemsHtml}</td>
                                    <td class="text-center">${order.total}</td>
                                </tr>`;

                                // totalAmount += parseFloat(order.total);
                                tbody.append(tr);
                            });
                            // Update the total amount in the footer
                            // totalFooterCell.text(totalAmount.toFixed(2));
                        }

                        // Hide loading indicator after displaying results
                        // loadingIndicator.hide();
                        // Show the product div
                        tbody.show();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching product suggestions:', error);
                        // Hide loading indicator on error
                        // loadingIndicator.hide();
                    }
                });
            } else {
                // Hide the product div if the search term is empty
                tbody.hide();
                totalFooterCell.text('0.00'); // Reset total amount
            }
        });


        $('#submit').click(function() {
            var startDate = $('#start_date').val();
            var endDate = $('#end_date').val();

            $.ajax({
                    url: '{{ route('search.sale') }}',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        start: startDate,
                        end: endDate
                    },
                    success: function(response) {

                        console.log(response);
                        // var ul = showProductDiv.find('ul');
                        tbody.empty();

                        if (response.length === 0) {
                            tbody.append('<tr>No products found</tr>');
                            totalFooterCell.text('0.00');
                        } else {
                            var totalAmount = 0;
                            response.forEach(function(order, index) {
                                var invoiceUrl = '{{ url('orders/invoice/') }}' + '/' + order.id;
                                var formattedDate = new Date(order.created_at).toLocaleDateString('en-US', {
                                    year: 'numeric',
                                    month: 'long',
                                    day: 'numeric'
                                });

                                var orderItemsHtml = '';
                                order.order_item.forEach(function (item, index) {
                                    console.log(item.product);
                                    var sizeHtml = '';
                                    if (item.product_sizes) {
                                        sizeHtml = `<span>Size: ${item.product_sizes.size}</span>`;
                                    }
                                    orderItemsHtml += `
                                        <div>
                                            <a href="#">${item.product.sku}</a>,
                                            ${sizeHtml}
                                            <br>
                                            <span>Qty: ${item.quantity} * ${item.price}</span>
                                            <br>
                                            <br>
                                        </div>`;
                                });

                                var tr = `<tr>
                                    <td>${index + 1}</td>
                                    <td class="text-center">
                                        <span>Order No. #${order.id}</span>
                                        <br>
                                        <small>Date: ${formattedDate}</small>
                                    </td>
                                    <td class="text-center">
                                        <a href="${invoiceUrl}" target="_blank">
                                            <span>${order.customer.firstName} ${order.customer.lastName}</span>, <br>
                                            <span>${order.customer.phone}</span>,<br>
                                            <span>${order.customer.billing_address}</span>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <span>Invoice No:</span>
                                        <a href="${invoiceUrl}" target="_blank">
                                            ${order.invoice_no}
                                        </a>
                                    </td>
                                    <td class="text-center">${orderItemsHtml}</td>
                                    <td class="text-center">${order.total}</td>
                                </tr>`;

                                // totalAmount += parseFloat(order.total);
                                tbody.append(tr);
                            });
                            // Update the total amount in the footer
                            // totalFooterCell.text(totalAmount.toFixed(2));
                        }

                        // Hide loading indicator after displaying results
                        // loadingIndicator.hide();
                        // Show the product div
                        tbody.show();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching product suggestions:', error);
                        // Hide loading indicator on error
                        // loadingIndicator.hide();
                    }
                });
            // For demonstration purposes, you can log the values
            console.log('Start Date:', startDate);
            console.log('End Date:', endDate);

            // Prevent the default form submission
            return false;
        });

        function printTable() {
            var printWindow = window.open('', '_blank');

            // Copy the content of the table to the new window
            printWindow.document.write('<html><head><title>Sale Report</title>');

            // Include custom CSS styles for the printed table
            printWindow.document.write('<style>');
            printWindow.document.write('body { font-family: Arial, sans-serif; }');
            printWindow.document.write('h2 { color: #333; }');
            printWindow.document.write('table { width: 100%; border-collapse: collapse; }');
            printWindow.document.write('table, th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }');
            printWindow.document.write('th { background-color: #f2f2f2; }');
            printWindow.document.write('a { text-decoration: none; color:#000; }');
            printWindow.document.write('</style>');

            printWindow.document.write('</head><body>');
            printWindow.document.write('<h2>Sales Report</h2>');
            printWindow.document.write('<table>' + $('#myTable').html() + '</table>');
            printWindow.document.write('</body></html>');

            // Close the document stream
            printWindow.document.close();

            // Print the new window
            printWindow.print();
        }


        // Print button click event
        printBtn.click(function() {
            printTable();
        });

    });

    </script>

    @endpush
