
@extends('layouts.home')
@section('title', 'My Account')
@section('main')

{{-- <h1>Customer dashboard</h1>
<form method="post" action="{{ route('customer.logout') }}">
    @csrf
    <button type="submit">Logout</button>
</form> --}}

    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Home</a>
                    <span></span> My Account
                </div>
            </div>
        </div>
        <style>
            .nav-list{
                margin: 45px 5px;
            }
            .nav-list li{
                border-bottom: 1px solid #FF8B13;
                padding: 10px 0px;
            }
            .nav-list .nav-item{
                padding: 8px 5px;
            }
            .profile-header h2{
                position: relative;
                margin-bottom: 20px;
            }
            .profile-header h2::after{
                content: '';
                position: absolute;
                bottom: -10px;
                left: 0;
                height: 1px;
                width: 100%;
                background-color: #FF8B13;
            }
            .nav .nav-item button.active {
            background-color: transparent;
            color: #FF8B13 !important;
            }
            .nav .nav-item button.active::after {
            content: "";
            border-right: 4px solid #FF8B13;
            height: 100%;
            position: absolute;
            right: -3px;
            top: 0;
            border-radius: 5px 0 0 5px;
            }
            .card-icon{
                font-size: 22px;
                /* padding: 10px */
            }
            .nav .nav-item{
                font-size: 18px;
                /* border-bottom: 1px solid #FF8B13; */

            }
            .action-btn{
                padding: 6px;
                border: 1px solid #088178;
                background-color: #088178;
                color: #ffffff;
                font-size: 16px;
                transition: all .4s;
                border-radius: 4px
            }
            .action-btn:last-child{
                border: 1px solid red;
                background-color: red;
            }
            .action-btn:hover{
                color: #ffffff;
                font-size: 18px
            }
        </style>
        <section class="mt-20">
            <div class="container">
                <div class="row p-5 d-flex align-items-start">
                    <div class="col-lg-2 col-md-3 col-sm-12">
                        <ul class="nav nav-pills flex-column nav-pills border-end border-3 me-3 align-items-end" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                              <button class="nav-link text-primary fw-semibold active position-relative" id="pills-Profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Profile</button>
                            </li>
                            {{-- <li class="nav-item" role="presentation">
                              <button class="nav-link text-primary fw-semibold position-relative" id="pills-orders-tab" data-bs-toggle="pill" data-bs-target="#pills-orders" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">My Order</button>
                            </li> --}}
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-primary fw-semibold position-relative" id="pills-orders-history-tab" data-bs-toggle="pill" data-bs-target="#pills-orders-history" type="button" role="tab" aria-controls="pills-orders-history" aria-selected="false">Orders History</button>
                            </li>

                            <!--<li class="nav-item" role="presentation">-->
                            <!--  <button class="nav-link text-primary fw-semibold position-relative" id="pills-transaction-tab" data-bs-toggle="pill" data-bs-target="#pills-transaction" type="button" role="tab" aria-controls="pills-transaction" aria-selected="false">Transactions</button>-->
                            <!--</li>-->
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-primary fw-semibold position-relative" id="pills-account-tab" data-bs-toggle="pill" data-bs-target="#pills-account" type="button" role="tab" aria-controls="pills-account" aria-selected="false">Account</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link text-primary fw-semibold position-relative" id="pills-logout-tab" onclick="document.getElementById('logout_form').submit();">Log Out</button>
                                {{-- <a class="dropdown-item" href="#" onclick="document.getElementById('logout_form').submit();">Logout</a> --}}
                                <form method="post" id="logout_form" action="{{ route('customer.logout') }}">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-10 col-md-9 col-sm-12">
                        <div class="tab-content border rounded-3 border-primary p-3 text-danger w-100" id="pills-tabContent">
                            {{-- Profile Tab --}}
                            @livewire('user-profile-component')

                            {{-- my order --}}
                            {{-- @livewire('my-order-component') --}}

                            {{-- order history tab --}}
                            @livewire('user-orders-component')

                            {{-- Transaction tab --}}
                            @livewire('user-transactions-component')

                            {{-- Account --}}
                            @livewire('user-account-component')

                        </div>
                    </div>

                </div>
                {{-- <div class="row">
                    <div class="col-2 col-lg-2 col-md-2">
                        <ul class="mb-4 nav-list">
                            <li>
                                <a href="#" class="nav-item mb-4">Profile</a>
                            </li>
                            <li>
                                <a href="#" class="nav-item mb-4">Order History</a>
                            </li>
                            <li>
                                <a href="#" class="nav-item mb-4">Transactions</a>
                            </li>
                            <li>
                                <a class="nav-item" href="#" onclick="document.getElementById('logout_form').submit();">Logout</a>
                                <form method="post" id="logout_form" action="{{ route('customer.logout') }}">
                                    @csrf
                                </form>

                            </li>
                        </ul>
                    </div>
                    <div class="col-10 col-lg-10">
                        <section>
                            <div class="profile-header ml-10">
                                <h2>Profile</h2>
                            </div>
                            <div class="profile-body">

                            </div>
                        </section>
                    </div>
                </div> --}}
            </div>
        </section>
    </main>

@endsection
@push('dashboard')
<script>
   $(document).ready(function () {
        // Get the districts and post offices data
        var divisionsData = {!! $divisions !!}; // Assuming $divisions is a JSON-encoded array of divisions
        var districtsData = {!! $districts !!}; // Assuming $districts is a JSON-encoded array of districts
        var postcodesData = {!! $postOffices !!}; // Assuming $postOffices is a JSON-encoded array of postcodes

        // When a division is selected
        $('.division').change(function () {
            var selectedDivisionId = $(this).val();
            var filteredDistricts = districtsData.filter(function (district) {
                return district.division_id == selectedDivisionId;
            });

            // Update the district dropdown
            updateDropdown('.district', filteredDistricts);
        });

        // When a district is selected
        $('.district').change(function () {
            var selectedDistrictId = $(this).val();
            var filteredPostcodes = postcodesData.filter(function (postcode) {
                return postcode.district_id == selectedDistrictId;
            });

            // Update the post office dropdown
            updateDropdownArea('.area', filteredPostcodes);
        });

        // Function to update a dropdown with new options
        function updateDropdown(dropdownId, options) {
            var dropdown = $(dropdownId);
            dropdown.empty();
            dropdown.append('<option value="0">Select...</option>');

            options.forEach(function (option) {
                dropdown.append('<option value="' + option.id + '">' + option.name + '</option>');
            });
        }

        function updateDropdownArea(dropdownId, options) {
            var dropdown = $(dropdownId);
            dropdown.empty();
            dropdown.append('<option value="0">Select...</option>');

            options.forEach(function (option) {
                dropdown.append('<option value="' + option.id + '">' + option.postOffice +' - '+ option.postCode + '</option>');
            });
        }
    });
    function validateMatching() {
        var password = document.getElementById('password').value;
        var c_password = document.getElementById('c_password').value;
        var passwordMatchMessage = document.getElementById('passwordMatchMessage');

        if (password === c_password) {
            passwordMatchMessage.innerHTML = 'Passwords match';
            passwordMatchMessage.style.color = 'green';
        } else {
            passwordMatchMessage.innerHTML = 'Passwords do not match';
            passwordMatchMessage.style.color = 'red';
        }
    }
</script>
@endpush
