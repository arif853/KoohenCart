@extends('layouts.admin')
@section('title','SteadFast Order Status')
@section('content')

    <div class="content-header">
        <div>
            <h2 class="content-title card-title">SteadFast Order Status</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{'/dashborad'}}">Dashboard</a></li>
                  <li class="breadcrumb-item " aria-current="page">Order</li>
                  <li class="breadcrumb-item active" aria-current="page">SteadFast Order</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card mb-4">
                <header class="card-header">
                    <a href="https://steadfast.com.bd/t/{{$SteadfastOrder->tracking_code}}" target="__blank" class="btn btn-brand rounded">Track Order</a>
                    <p id="copiedMessage" style="display:none;color:green; margin-top:10px;">Text copied to clipboard!</p>
                </header>
                <!-- card-header end// -->
                <div class="card-body">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <td>1</td>
                            </tr>
                            <tr>
                                <th>Order No</th>
                                <td>{{$SteadfastOrder->order_id}}</td>
                            </tr>
                            <tr>
                                <th>Consignment Id</th>
                                <td>
                                    <span class="mr-10">{{$SteadfastOrder->consignment_id}}</span>
                                    <a href="#" id="copyText" onclick="copyText('{{$SteadfastOrder->consignment_id}}')" style="font-size: 16px;"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="right"
                                        title="right">
                                        <i class="fas fa-clipboard-check"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th>Invoice</th>
                                <td>{{$SteadfastOrder->invoice}}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td><span class="badge bg-primary">{{$orderStatus['delivery_status']}}</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div> <!-- card-body end// -->
            </div> <!-- card end// -->
        </div>

    </div>
<script>
    function copyText(token) {
        // Create a temporary textarea element
        var tempTextArea = document.createElement("textarea");
        tempTextArea.value = token;

        // Append the temporary textarea to the body
        document.body.appendChild(tempTextArea);

        // Select the text inside the temporary textarea
        tempTextArea.select();
        tempTextArea.setSelectionRange(0, 99999); // For mobile devices

        // Copy the text inside the temporary textarea
        navigator.clipboard.writeText(tempTextArea.value).then(function() {
            // Optional: display a message indicating the text was copied
            var copiedMessage = document.getElementById("copiedMessage");
            copiedMessage.style.display = "block";
            setTimeout(function() {
                copiedMessage.style.display = "none";
            }, 2000);
        }, function(err) {
            console.error('Could not copy text: ', err);
        });

        // Remove the temporary textarea from the body
        document.body.removeChild(tempTextArea);
    }

</script>
@endsection

