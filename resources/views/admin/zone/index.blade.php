
@extends('layouts.admin')
@section('title','Add zone')

@section('content')
<div class="content-header">
    <div>
        <h2 class="content-title card-title">Delivery Zone</h2>
    </div>
    <div>
        <input type="text" placeholder="Search by name" class="form-control bg-white">
    </div>
</div>
<div class="card mb-4">
    <header class="card-header">
        <form action="{{url('dashboard/zone/store')}}" method="POST">
            @csrf
            @method('POST')
            <div class="row gx-3">
                <div class="col-lg-3 col-md-3">
                    <div class="form-group mb-4">
                        <label for="" class="form-label">Select Districts</label>
                        <select name="district" id="district" class="select-nice district" >
                            <option value="">--Select District--</option>
                            @foreach ($districts as $district)
                            <option value="{{$district->id}}">{{$district->name}} -- {{$district->bn_name}} </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="form-group mb-4">
                        <label for="" class="form-label">Select Upazila/Thana</label>
                        <select name="upazila" id="upazila" class="select-nice upazila" >
                            <option value="">--Select Upazila/Thana--</option>
                            @foreach ($areas as $area)
                            <option value="{{$area->upazila}}" data-zone-charge="{{$area->zone_charge}}">{{$area->upazila}} </option> <br>
                            @endforeach
                        </select>
                    </div>
                </div>
                <style>
                    .form-control{
                        height: 38px !important;
                    }
                </style>
                <div class="col-lg-3 col-md-3">
                    <div class=" mb-4">
                        <label for="" class="form-label">Delivery Charge</label>
                        <input type="text" name="delivery_charge" id="delivery_charge"  placeholder="Delivery Charge" class="form-control" >
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    {{-- <label for="" class="form-label"></label> --}}
                    <button class="btn btn-brand mt-4" type="submit">Save</button>
                </div>
            </div>
        </form>
    </header>
    <!-- card-header end// -->
    <div class="card-body">


        {{-- <div class="row  mb-4 gx-4  ">
            <div class="col-lg-12">
                <h6>Primary Delivery charge: 80</h6>
                <h6>Secondary Delivery charge: 130</h6>
            </div>
        </div> --}}

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" />
                            </div>
                        </th>
                        <th>#ID</th>
                        <th>Delivery Zone</th>
                        <th>Delivery Charge</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($delivery_zone as $key => $zone)
                    <tr>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" />
                            </div>
                        </td>
                        <td>{{$key+1}}</td>
                        <td>{{$zone->upazila}} ,  {{$zone->district->name}}.</td>
                        <td>{{$zone->charge}}</td>
                        <td>
                            @if($zone->status == 'Active')
                            <a href="{{ route('zonestatus.update', ['id' => $zone->id]) }}">
                                {{-- @method('POST') --}}
                                <span class="badge rounded-pill alert-success">{{ $zone->status }}</span>
                            </a>
                            @else
                            <a href="{{ route('zonestatus.update', ['id' => $zone->id]) }}">
                                {{-- @method('POST') --}}

                                <span class="badge rounded-pill alert-danger">{{ $zone->status }}</span>
                            </a>
                            @endif
                        </td>
                        <td>{{$zone->created_at->setTimezone('Asia/Dhaka')->format('M j, Y')}}</td>
                        <td class="text-end">
                            {{-- <a href="#" class="btn btn-danger rounded font-sm">Delete</a> --}}

                            <form class="deleteForm" action="{{route('zone.destroy', ['id' => $zone->id])}}" method="post">
                                @csrf
                                @method('DELETE')
                                <a href="#" class="btn btn-sm btn-danger rounded font-sm mt-15 delete_zone">Delete</a>
                            </form>

                            {{-- <div class="dropdown">
                                <a href="#" data-bs-toggle="dropdown" class="btn btn-light rounded btn-sm font-sm"> <i class="material-icons md-more_horiz"></i> </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Edit info</a>
                                    <a class="dropdown-item text-danger" href="#">Delete</a>
                                </div>
                            </div> --}}
                            <!-- dropdown //end -->
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div> <!-- table-responsive//end -->
    </div>
    <!-- card-body end// -->
</div>
{{-- @foreach ($areas as $area)
    {{$area}} <br>
@endforeach --}}

@endsection

@push('zone')
<script>
   $(document).ready(function () {
        // Get the districts and post offices data
        var districtsData = {!! $districts !!}; // Assuming $districts is a JSON-encoded array of districts
        var upazilasData = {!! $areas !!}; // Assuming $districts is a JSON-encoded array of districts


        // When a district is selected
        $('.district').change(function () {
            var selectedDistrictId = $(this).val();
            var filteredUpazila = upazilasData.filter(function (upazila) {
                return upazila.district_id == selectedDistrictId;
            });

            // Update the post office dropdown
            updateDropdown('.upazila', filteredUpazila);
        });

        // Function to update a dropdown with new options
        function updateDropdown(dropdownId, options) {
            var dropdown = $(dropdownId);
            dropdown.empty();
            dropdown.append('<option value="0">--Select Upazila/Thana--</option>');

            options.forEach(function (option) {
                dropdown.append('<option value="' + option.upazila + '" data-zone-charge="' + option.zone_charge + '">' + option.upazila + '</option>');

            });

            // Add the change event listener outside the loop
            $('.upazila').change(function () {
                var selectedOption = $(this).find(':selected');
                var deliveryCharge = selectedOption.data('zone-charge'); // Assuming you have a data attribute for zone_charge
                // Update the delivery charge input
                $('#delivery_charge').val(deliveryCharge);
            });
        }
    });

    document.querySelectorAll('.delete_zone').forEach(function (element) {
        element.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default link behavior
            console.log('click');
            // Find the closest form element related to the clicked link
            var form = this.closest('form');
            // console.log(form);
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
