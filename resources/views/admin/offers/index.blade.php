@extends('layouts.admin')
@section('title','Offers')
@section('content')
    <div class="content-header">
        <div>
            <h2 class="content-title card-title">Offers List</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ '/dashborad' }}">Dashborad</a></li>
                    <li class="breadcrumb-item active" aria-current="page">offers</li>
                </ol>
            </nav>
        </div>
        <div>
            {{-- <a href="#" class="btn btn-primary btn-sm rounded">Add New category</a> --}}
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary btn-sm rounded" data-bs-toggle="modal" data-bs-target="#typeModal">
                Add offer Type
            </button>
            <button type="button" class="btn btn-primary btn-sm rounded" data-bs-toggle="modal"
                data-bs-target="#offerModal">
                Add New Offer
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card mb-4">
                <header class="card-header">
                    <div class="row gx-3">
                        <div class="col-lg-4 mb-lg-0 mb-15 me-auto">
                            <input type="text" placeholder="Search..." class="form-control">
                        </div>
                        {{-- <div class="col-lg-2 col-6">
                        <div class="custom_select">
                            <select class="form-select select-nice">
                                <option selected>Categories</option>
                                <option>Technology</option>
                                <option>Fashion</option>
                                <option>Home Decor</option>
                                <option>Healthy</option>
                                <option>Travel</option>
                                <option>Auto-car</option>
                            </select>
                        </div>
                    </div> --}}
                        <div class="col-lg-2 col-6">
                            <input type="date" class="form-control" name="">
                        </div>
                    </div>
                </header> <!-- card-header end// -->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Offer Name</th>
                                    <th>Offer Type</th>
                                    <th>Products Name</th>
                                    <th>Days</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody id="OfferTable">
                                @if ($offers->isNotEmpty())
                                    @foreach ($offers as $list)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td><b>{{ $list->offer_name }}</b></td>
                                            <td>
                                                {{ $list->OfferType->offer_type_name }}
                                            </td>
                                            <td>
                                                <ul>
                                                    @foreach ($list->products as $product)
                                                        <li>{{ $product->product_name }}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>{{ $list->day }}</td>
                                            <td class="text-end">
                                                <form class="deleteForm"
                                                    action="{{ route('offer.destroy', ['id' => $list->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#offerModalEdit" data-offer-id="{{ $list->id }}"
                                                        class="btn btn-sm btn-brand rounded font-sm mt-15 edit-offer">Edit</a>
                                                    <a href="#"
                                                        class="btn btn-sm btn-danger rounded font-sm mt-15 delete_offer">Delete</a>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div> <!-- table-responsive//end -->
                </div>
            </div> <!-- card end// -->
        </div>
    </div>
    @include('admin.offers.offer_type')
    @include('admin.offers.create_offer')
    @include('admin.offers.edit_offer')
@endsection
@push('offers')
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#CheckBoxFields').change(function() {
                if ($(this).is(':checked')) {
                    $('#EditvariantFields').show();
                } else {
                    $('#EditvariantFields').hide();
                }
            });

            $('#OfferProductForm').on('submit', function(event) {
                event.preventDefault();
                let formData = new FormData(this); // Use 'FormData', capitalize the 'D'
                $.ajax({
                    url: "{{ route('offer.saved') }}",
                    method: "POST",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        console.log(data);
                        if (data.status == 'success') { // Check for 'success' instead of 200
                            $('#OfferProductForm')[0].reset();
                            $('#offerModal').modal('hide'); // Correct modal ID
                            $.Notification.autoHideNotify('success', 'top right', 'Excellent!!',
                                data.message);
                            location.reload();
                        } else {
                            $.Notification.autoHideNotify('danger', 'top right', 'Danger!!',
                                data.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $('.edit-offer').on('click', function(e) {
                e.preventDefault();
                var offerId = $(this).data('offer-id');

                $.ajax({
                    url: '{{url('/dashboard/promotion/edit_offers_data')}}',
                    method: 'GET',
                    data: {
                        id: offerId,
                    },
                    success: function(response) {
                        console.log(response);
                        $('#offer_name').val
                        $('#offer_id').val(response.id);
                        $('#OffersName').val(response.offer_name);
                        $('#offer_percent').val(response.offer_percent);
                        $('.fDate').val(response.from_date);
                        $('.toDate').val(response.to_date);
                        // Iterate through each option in the select element
                        $('#editOffertype').find('option').each(function() {
                            // Check if the value of the option matches the offer_type_id from the response
                            if ($(this).val() == response.offer_type_id) {
                                // Set the selected attribute for the matching option
                                $(this).prop('selected', true);
                            } else {
                                // Remove the selected attribute for other options
                                $(this).prop('selected', false);
                            }
                        });
                    }
                });
            });

            //Update Brand
            $("#UpdateOfferProductForm").submit(function(e) {
                e.preventDefault();
                const data = new FormData(this);
                $.ajax({
                    url: '{{url('/dashboard/promotion/update_offers_data')}}',
                    method: 'post',
                    data: data,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                        if (res.status == 'success') {
                            // Hide the edit modal
                            $('#offerModalEdit').modal('hide');
                            // Reload the page
                            location.reload();
                            $.Notification.autoHideNotify('success', 'top right', 'Success', res
                                .message);
                        } else {
                            $.Notification.autoHideNotify('danger', 'top right', 'Danger', res
                                .message);
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error(xhr.responseText);
                    }
                })
            });

            $(document).on('click', '.delete_offer', function(event) {
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
