<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title') - Koohen</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('admin/assets/imgs/favicon_128x128.ico')}}">
    {{-- <link href="{{asset('admin/assets/css/summernote-bs4.min.css')}}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/thinline.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    {{-- datatable --}}
    <link rel="stylesheet" href="{{asset('admin/assets/css/vendors/datatables.min.css')}}">
    {{-- sweet alert --}}
    <link rel="stylesheet" href="{{asset('admin/assets/css/vendors/sweetalert2.min.css')}}">
    {{-- datetime picker --}}
    <link href="{{asset('admin/assets/css/vendors/datetimepicker/jquery.datetimepicker.css')}}" rel="stylesheet">
    {{-- Dropzone --}}
    <link rel="stylesheet" href="{{asset('admin/assets/css/vendors/dropzone.min.css')}}">
    {{-- Toggle btn --}}
    <link rel="stylesheet" href="{{asset('admin/assets/css/vendors/jquery.toggleinput.css')}}">
    <!-- Template CSS -->
    <link href="{{asset('admin/assets/css/main.css')}}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{asset('admin/assets/vendors/daterangepicker/daterangepicker.css')}}">
    {{-- Notification --}}
    <link href="{{asset('admin/assets/vendors/notifications/notification.css')}}" rel="stylesheet" />



</head>

<body>
    <div class="screen-overlay"></div>

    {{-- Sidebar layout include --}}
    @include('layouts.sidebar')

    <main class="main-wrap">

        {{-- topbar layout include --}}
        @include('layouts.topbar')

        {{-- main content include here --}}
        <section class="content-main">

            @yield('content')

        </section> <!-- content-main end// -->

        <footer class="main-footer font-xs">
            <div class="row pb-30 mt-55">
                <div class="col-sm-6">
                    <script>
                    document.write(new Date().getFullYear())
                    </script> ©, Koohen - Admin Dashboard  .
                </div>
                <div class="col-sm-6">
                    <div class="text-sm-end">
                        All rights reserved by Qbit E-Store.
                    </div>
                </div>
            </div>
        </footer>

    </main>


    {{-- Jquery  --}}
    <script src="{{asset('admin/assets/js/vendors/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/vendors/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/vendors/select2.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/vendors/fontawesome.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/vendors/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('admin/assets/js/vendors/jquery.fullscreen.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/vendors/chart.js')}}"></script>

    {{-- Datatable --}}
    <script src="{{asset('admin/assets/js/vendors/datatables.min.js')}}"></script>
    {{-- Text Editor --}}
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    {{-- <script src="{{asset('admin/assets/js/summernote-bs4.min.js')}}"></script> --}}
    {{-- color picker --}}
    <script src="{{asset('admin/assets/js/vendors/colorpicker/jquery.minicolors.min.js')}}"></script>
    {{-- Toggle Btn --}}
    <script src="{{asset('admin/assets/js/vendors/jquery.toggleinput.js')}}"></script>
    <!-- datetimepicker-->
    <script src="{{asset('admin/assets/js/vendors/datetimepicker/jquery.datetimepicker.full.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/vendors/datetimepicker/custom-datetimepicker.js')}}"></script>
    <!-- Dropzone-->
    <script src="{{asset('admin/assets/js/vendors/dropzone/dropzone.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/vendors/dropzone/dropzone-custom.js')}}"></script>
    {{-- sweet alert --}}
    <script src="{{asset('admin/assets/js/vendors/sweetalert2.all.min.js')}}"></script>
    {{-- Notification --}}
    {{-- <script src="{{asset('admin/assets/vendors/notifications/notify.js')}}"></script>
    <script src="{{asset('admin/assets/vendors/notifications/notify-metro.js')}}"></script>
    <script src="{{asset('admin/assets/vendors/notifications/notifications.js')}}"></script> --}}
    <script src="{{asset('admin/assets/vendors/notifications/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('admin/assets/vendors/notifications/notifications.js')}}"></script>
    {{-- Jquery steps --}}
    <script src="{{asset('admin/assets/vendors/form-wizard/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admin/assets/vendors/form-wizard/jquery.bootstrap.wizard.js')}}"></script>
    <script src="{{asset('admin/assets/vendors/form-wizard/gsdk-bootstrap-wizard.js')}}"></script>
    {{-- <script src="{{asset('admin/assets/vendors/form-wizard/step-init.js')}}"></script> --}}

    <script src="{{asset('admin/assets/vendors/daterangepicker/moment.min.js')}}"></script>
    <script src="{{asset('admin/assets/vendors/daterangepicker/daterangepicker.min.js')}}"></script>
    <!-- Main Script -->
    <script src="{{asset('admin/assets/js/main.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/assets/js/custom-chart.js')}}" type="text/javascript"></script>
    <script src="{{asset('admin/assets/js/deleteConfirm.js')}}"></script>
    {{-- <script src="{{asset('admin/assets/js/script.js')}}"></script> --}}


    @stack('product')
    @stack('varient')
    @stack('brand')
    @stack('category')
    @stack('subcategory')
    @stack('supplier')
    @stack('zone')
    @stack('order_status')
    @stack('products_search')
    @stack('customer_filter')
    @stack('product_features')
    @stack('report')
    @stack('coupons_type')
    @stack('offers')

    <script>
        $(document).ready(function() {

            $('#notify-counter').click(function(e) {
                e.preventDefault();
                $('.notify-nav').slideToggle('slow');
                e.stopPropagation(); // Prevent event from bubbling up to the document
            });

            $(document).click(function(e) {
                if (!$(e.target).closest('.notify-counter').length && !$(e.target).closest('.notify-nav').length) {
                    $('.notify-nav').slideUp('slow'); // Slide up if clicked outside the notification area
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Get all notification items
            var notificationItems = document.querySelectorAll('.notification-item');

            // Add click event listener to each notification item
            notificationItems.forEach(function(item) {
                item.addEventListener('click', function(event) {
                    // event.preventDefault();

                    // Get the notification ID
                    var notificationId = item.getAttribute('data-notification-id');

                    // Send AJAX request to mark notification as read
                    markNotificationAsRead(notificationId);
                });
            });

            // Function to mark notification as read via AJAX
            function markNotificationAsRead(notificationId) {
                // Send AJAX request to mark notification as read
                $.ajax({
                    url: '{{route('markNotificationAsRead')}}', // Replace with your route URL
                    type: 'POST',
                    data: {
                        id: notificationId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Update UI or perform any other actions
                        location.reload();
                        console.log('Notification marked as read');
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        });
    </script>

    <script>
        $(document).ready(function() {

            $('.delete_all').on('click', function (e) {
                var allVals = [];
                $(".checkbox_animated:checked").each(function () {
                    allVals.push($(this).attr('data-id'));
                });
                //alert(allVals.length); return false;
                if (allVals.length <= 0) {
                    alert("Please select row.");
                } else {
                    //$("#loading").show();
                    WRN_PROFILE_DELETE = "Are you sure you want to delete this row?";
                    var check = confirm(WRN_PROFILE_DELETE);
                    if (check == true) {
                        $.each(allVals, function (index, value) {
                            $('table tr').filter("[data-row-id='" + value + "']").remove();
                        });
                    }
                }
            });

            // $('.remove-row').on('click', function (e) {
            //     WRN_PROFILE_DELETE = "Are you sure you want to delete this row?";
            //     var check = confirm(WRN_PROFILE_DELETE);
            //     if (check == true) {
            //         $('table tr').filter("[data-row-id='" + $(this).attr('data-id') + "']").remove();
            //     }
            // });
                    // $('.radio-toggle').toggleInput();
                    // $('#showInputBtn').click(function() {
                    //     $('#expandInput').toggle().focus();
                    // });

            $('#showVariantFields').change(function() {
                if ($(this).is(':checked')) {
                    $('#variantFields').show();
                } else {
                    $('#variantFields').hide();
                }
            });

            $('#percentage_checkbox').change(function() {
                if ($(this).is(':checked')) {
                    $('.offer-price').show();
                    $('.offer-price-2').hide();
                } else {
                    $('.offer-price').hide();
                }
            });

            $('#price_checkbox').change(function() {
                if ($(this).is(':checked')) {
                    $('.offer-price-2').show();
                    $('.offer-price').hide();
                } else {
                    $('.offer-price-2').hide();
                }
            });


            // $('.multiple-select2').select2();
            $('.colorpicker').minicolors({
                // animation speed
            animationSpeed: 50,

            // easing function
            animationEasing: 'swing',

            // defers the change event from firing while the user makes a selection
            changeDelay: 0,

            // hue, brightness, saturation, or wheel
            control: 'hue',

            // default color
            defaultValue: '',

            // hex or rgb
            format: 'rgb',

            // show/hide speed
            showSpeed: 100,
            hideSpeed: 100,

            // is inline mode?
            inline: false,

            // a comma-separated list of keywords that the control should accept (e.g. inherit, transparent, initial).
            keywords: '',

            // uppercase or lowercase
            letterCase: 'lowercase',

            // enables opacity slider
            opacity: true,

            // custom position
            // position: 'bottom left',

            // additional theme class
            theme: 'default',

            // an array of colors that will show up under the main color <a href="https://www.jqueryscript.net/tags.php?/grid/">grid</a>
            swatches: []
            });


            $('#summernote').summernote({
                placeholder: 'Write Description Here...',
                tabsize: 2,
                height: 250,
                fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Merriweather'],
                fontSizeUnits: ['px', 'pt'],
                toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                // ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

        $('#datatable').DataTable();



        });

    </script>
    @if(Session::has('success'))
        <script>
            $.Notification.autoHideNotify('success', 'top right', 'Success', '{{ Session::get('success') }}');
        </script>
    @endif
    @if(Session::has('danger'))
        <script>
            $.Notification.autoHideNotify('danger', 'top right', 'Danger', '{{ Session::get('danger') }}');
        </script>
    @endif
    @if(Session::has('warning'))
    <script>
        $.Notification.autoHideNotify('warning', 'top right', 'Warning', '{{ Session::get('warning') }}');
    </script>
    @endif
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                $.Notification.autoHideNotify('danger', 'top right', 'Error', '{{ $error }}');
            </script>
        @endforeach
    @endif
</body>

</html>
