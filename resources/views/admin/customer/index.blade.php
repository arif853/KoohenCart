@extends('layouts.admin')
@section('title', 'Customer')
@section('content')

    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Customer List</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ '/dashborad' }}">Dashborad</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Customers</li>
                </ol>
            </nav>
        </div>
        {{-- <div>
            <a href="#" class="btn btn-primary"><i class="material-icons md-plus"></i> Create new</a>
        </div> --}}
    </div>
    <div class="card mb-4">
        <header class="card-header">
            <div class="row gx-3" id="customer_live_search">
                <div class="col-lg-4 col-md-6 me-auto">
                    <input type="text" placeholder="Customer name..." class="form-control"
                        id="customer_name">
                </div>
                <div class="col-lg-4 col-md-6 me-auto">
                    <input type="text" placeholder="Customer mobile number..." class="form-control"
                        id="customer_phone">
                </div>
                <div class="col-lg-4 col-md-6 me-auto">
                    <input type="email" placeholder="Customer email..." class="form-control"
                        id="customer_email">
                </div>
                <div class="col-lg-4">
                    <a href="{{route('customerExport')}}" class="btn btn-brand font-sm  mt-4">CSV</a>
                    <a href="#" class="btn btn-brand font-sm mt-4" data-bs-toggle="modal" data-bs-target="#customerModal">Import Customer</a>
                </div>
            </div>
        </header> <!-- card-header end// -->
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="datatable">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Registered</th>
                            <th class="text-end"> Action </th>
                        </tr>
                    </thead>
                    <tbody id="CustomerTable">
                        @foreach ($customers as $key => $customer)
                            <tr>
                                <td>
                                    <a href="{{ route('customer.profile', ['id' => $customer->id]) }}" class="itemside">
                                        <div class="info pl-3">
                                            <h6 class="mb-0 title">{{ $customer->firstName }} {{ $customer->lastName }}</h6>
                                            <small class="text-muted">Customer ID: #{{ $customer->id }}</small>
                                        </div>
                                    </a>
                                </td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>
                                    @if ($customer->status == 'registerd')
                                        <span class="badge rounded-pill alert-success">Registerd</span>
                                    @else
                                        <span class="badge rounded-pill alert-danger">Not Registerd</span>
                                    @endif
                                </td>
                                <td>{{ $customer->created_at->format('d-m-Y') }}</td>
                                <td class="text-end">

                                    <form class="deleteForm"
                                        action="{{ route('customer.destroy', ['id' => $customer->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <a href="{{ route('customer.profile', ['id' => $customer->id]) }}"
                                        class="btn btn-sm btn-brand rounded font-sm mt-15">View details</a>

                                        <a href="#" data-bs-toggle="modal" data-bs-target="#customerEditModal"
                                            data-customer-id="{{ $customer->id }}"
                                            class="btn btn-sm btn-brand rounded font-sm mt-15 edit">Edit</a>
                                        <a href="#"
                                            class="btn btn-sm btn-danger rounded font-sm mt-15 delete">Delete</a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table> <!-- table-responsive.// -->
            </div>
        </div> <!-- card-body end// -->
    </div> <!-- card end// -->


    <!-- Modal -->
    <div class="modal fade" id="customerEditModal" tabindex="-1" aria-labelledby="customerEditModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="customerEditModalLabel">Update Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="customerUpdateForm">
                <input type="hidden" id="customer_id" name="customer_id">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="firstName" class="form-label">FirstName <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="firstName" name="firstName" required>
                            </div>

                            <div class="col-md-6">
                                <label for="lastName" class="form-label">LastName <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="lastName" name="lastName" required>
                            </div>

                            <div class="col-md-12">
                                <label for="customerPhone" class="form-label">Phone<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="customerPhone" name="customerPhone" required>
                            </div>

                            <div class="col-md-12">
                                <label for="customerEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="customerEmail" name="customerEmail">
                            </div>

                            <div class="col-md-12 ">
                                <label class="form-label" for="customerAddress">Address<span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="customerAddress" name="customerAddress" required>
                            </div>

                            {{-- <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div> --}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

      <!-- Modal -->
    <div class="modal fade" id="customerModal" tabindex="-1" aria-labelledby="customerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="customerModalLabel">Update Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" enctype="multipart/form-data" action="{{route('customerimport')}}">
                    @csrf
                    @method('post')
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="file" class="form-label">Add CSV file <span class="text-danger">*</span></label>
                                <input type="file" class="form-control" id="file" name="file" required>
                            </div>

                            {{-- <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div> --}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('customer_filter')
    <script type="text/javascript">



        $('#customer_live_search input').on('keyup', function() {
            let customerName = $('#customer_name').val();
            let customerPhone = $('#customer_phone').val();
            let customerEmail = $('#customer_email').val();

            $.ajax({
                url: "{{ route('customer.filter') }}",
                method: "GET",
                data: {
                    customerName: customerName,
                    customerPhone: customerPhone, // Corrected parameter name to match the server-side code
                    customerEmail: customerEmail // Corrected parameter name to match the server-side code
                },
                success: function(response) {
                    let customerTableBody = $('#CustomerTable');
                    customerTableBody.empty();

                    response.forEach(function(customer) {
                        let row = $('<tr>');

                        // Create the first cell with the customer name and ID link
                        let nameCell = $('<td>').append(
                            $('<a>').attr('href',
                                "{{ route('customer.profile', ['id' => '']) }}" + customer
                                .id).addClass('itemside').append(
                                $('<div>').addClass('info pl-3').append(
                                    $('<h6>').addClass('mb-0 title').text(customer
                                        .firstName + ' ' + customer.lastName),
                                    $('<small>').addClass('text-muted').text(
                                        'Customer ID: #' + customer.id)
                                )
                            )
                        );
                        row.append(nameCell);

                        // Create the phone and email cells
                        row.append($('<td>').text(customer.phone));
                        row.append($('<td>').text(customer.email));

                        // Create the status cell
                        let statusCell = $('<td>');
                        if (customer.status == 'registerd') {
                            statusCell.append($('<span>').addClass(
                                'badge rounded-pill alert-success').text('Registered'));
                        } else {
                            statusCell.append($('<span>').addClass(
                                'badge rounded-pill alert-danger').text(
                                'Not Registered'));
                        }
                        row.append(statusCell);

                        // Format the created_at date
                        let createdAtDate = new Date(customer.created_at);
                        let formattedDate = ("0" + createdAtDate.getDate()).slice(-2) + '-' + (
                                "0" + (createdAtDate.getMonth() + 1)).slice(-2) + '-' +
                            createdAtDate.getFullYear();

                        // Create the created_at cell with formatted date
                        row.append($('<td>').text(formattedDate));

                        // Create the "View details" button cell
                        // let detailsCell = $('<td>').addClass('text-end').append(
                        //     $('<a>').attr('href',
                        //         "{{ route('customer.profile', ['id' => '']) }}" + customer
                        //         .id)
                        //     .addClass('btn btn-sm btn-brand rounded font-sm mt-15').text(
                        //         'View details')
                        // );

                        // Create a new <td> element
                        let detailsCell = $('<td>').addClass('text-end');

                        // Create the form element
                        let form = $('<form>').addClass('deleteForm').attr('action', "{{ route('customer.destroy', ['id' => '']) }}"+ customer.id).attr('method', 'post');

                        // Add CSRF token
                        form.append('@csrf');
                        form.append('@method('DELETE')');

                        // Add the "View details" link
                        let viewDetailsLink = $('<a>').attr('href', "{{ route('customer.profile', ['id' => '']) }}"+ customer.id).addClass('btn btn-sm btn-brand rounded font-sm mt-15 mr-5').text('View details');
                        form.append(viewDetailsLink);

                        // Add the "Edit" link
                        let editLink = $('<a>').attr('href', '#').attr('data-bs-toggle', 'modal').attr('data-bs-target', '#customerEditModal').attr('data-customer-id', customer.id).addClass('btn btn-sm btn-brand rounded font-sm mt-15 mr-5 edit').text('Edit');
                        form.append(editLink);

                        // Add the "Delete" link
                        let deleteLink = $('<a>').attr('href', '#').addClass('btn btn-sm btn-danger rounded font-sm mt-15 delete').text('Delete');
                        form.append(deleteLink);

                        // Append the form to the detailsCell
                        detailsCell.append(form);

                        row.append(detailsCell);

                        // Append the row to the table body
                        customerTableBody.append(row);
                    });
                }

            });
        });

        // Edit customer
        $(document).on('click', '.edit', function(e) {
            e.preventDefault();
            var customerId = $(this).data('customer-id');
            console.log(customerId);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{url('/dashboard/customer/edit')}}',
                method: 'GET',
                data: {
                    id: customerId,
                },
                success: function(response) {
                    $('#customer_id').val(response.id);
                    $('#firstName').val(response.firstName);
                    $('#lastName').val(response.lastName);
                    $('#customerAddress').val(response.billing_address);
                    $('#customerPhone').val(response.phone);
                    $('#customerEmail').val(response.email);
                }
            });
        });

        //Update customer
        $("#customerUpdateForm").submit(function(e) {
            e.preventDefault();
            const data = new FormData(this);
                console.log(data);
            $.ajax({
                url: '{{url('/dashboard/customer/update')}}',
                method: 'post',
                data: data,
                cache: false,
                processData: false,
                contentType: false,
                success: function(res) {
                    if (res.status == 200) {
                        // $("#brandEditForm").modal('hide');
                        location.reload();
                        // $.Notification.autoHideNotify('success', 'top right', 'Success', res.message);
                    } else {
                        $.Notification.autoHideNotify('danger', 'top right', 'Danger', res.message);

                    }
                }
            })
        });

        // Delete customer
        $(document).ready(function() {
            $(document).on('click', '.delete', function(event) {
                event.preventDefault(); // Prevent the default link behavior
                console.log('click');
                // Find the closest form element related to the clicked link
                var form = $(this).closest('form');
                // Display SweetAlert confirmation
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    // If confirmed, submit the corresponding form
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

    </script>
@endpush
