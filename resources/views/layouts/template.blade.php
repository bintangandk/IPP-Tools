<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>{{ $title }}</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/js/select.dataTables.min.css') }}">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('assets/images/chrome-favicon.png') }}" />

  <style>
    .btn-spacing {
      margin-right: 10px;
    }

    /* Styling untuk preview image */
    #image-preview {
      margin-top: 10px;
      max-width: 300px;
      max-height: 300px;
    }

    .card-light-green {
      background-color: #90ee90;
      /* Light green color */
      color: #fff;
      /* Text color */
    }

    .card-dark-green {
      background-color: #006400;
      /* Dark green color */
      color: #fff;
      /* Text color */
    }


    .card-dark-red {
      background-color: #8b0000;
      /* Dark red color */
      color: #fff;
      /* Text color */
    }

    .card-light-yellow {
      background-color: #fffacd;
      /* Light yellow color */
      color: #000;
      /* Dark text color for better contrast */
    }
  </style>
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('layouts.navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">

      <!-- partial -->
      @include('layouts.sidebar')
      <!-- partial -->

      @yield('content')

    </div>
    <!-- page-body-wrapper ends -->
  </div>

  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
  <script src="{{ asset('assets/js/dataTables.select.min.js') }}"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
  <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('assets/js/template.js') }}"></script>
  <script src="{{ asset('assets/js/settings.js') }}"></script>
  <script src="{{ asset('assets/js/todolist.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
  <script src="{{ asset('assets/js/Chart.roundedBarCharts.js') }}"></script>
  <!-- End custom js for this page-->

  @include('sweetalert::alert')
</body>

</html>