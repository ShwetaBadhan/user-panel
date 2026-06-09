<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>@yield('title','VSR | User Panel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ url ('assets/images/favicon.ico')}}">

    <!-- plugin css -->
    <link href="{{ url ('assets/libs/jsvectormap/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="{{ url ('assets/js/layout.js')}}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ url ('assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ url ('assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ url ('assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />

</head>

<body>
    <!-- Begin page -->
    <div id="layout-wrapper">
    
    @include('components.top-header')
    @yield('content')
    @include('components.sidebar')

    </div>
 <!-- JAVASCRIPT -->
    <script src="{{ url ('assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ url ('assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{ url ('assets/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{ url ('assets/libs/feather-icons/feather.min.js')}}"></script>
    <script src="{{ url ('assets/js/plugins.js')}}"></script>

    <!-- apexcharts -->
    <script src="{{ url ('assets/libs/apexcharts/apexcharts.min.js')}}"></script>

    <!-- Vector map-->
    <script src="{{ url ('assets/libs/jsvectormap/jsvectormap.min.js')}}"></script>
    <script src="{{ url ('assets/libs/jsvectormap/maps/world-merc.js')}}"></script>

    <!-- Dashboard init -->
    <script src="{{ url ('assets/js/pages/dashboard.init.js')}}"></script>

    <!-- App js -->
    <script src="{{ url ('assets/js/app.js')}}"></script>
</body>

</html>
