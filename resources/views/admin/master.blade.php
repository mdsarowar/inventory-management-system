<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="POS - Bootstrap Admin Template">
    <meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, invoice, html5, responsive, Projects">
    <meta name="author" content="Dreamguys - Bootstrap Admin Template">
    <meta name="robots" content="noindex, nofollow">
    <title>Pos-@yield('title')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('/')}}admin/assets/img/favicon.png">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@include('admin.include.assets.css')
{{--    @notifyCss--}}
</head>

<body>
{{--<div id="global-loader" >--}}
{{--    <div class="whirly-loader"> </div>--}}
{{--</div>--}}
<!-- Main Wrapper -->
<div class="main-wrapper">

    <!-- Header -->
    <div class="header">

        <!-- Logo -->
       @include('admin.include.logo')
        <!-- /Logo -->

        <a id="mobile_btn" class="mobile_btn" href="#sidebar">
					<span class="bar-icon">
						<span></span>
						<span></span>
						<span></span>
					</span>
        </a>

        <!-- Header Menu -->
        @include('admin.include.header')
        <!-- /Header Menu -->

        <!-- Mobile Menu -->
        @include('admin.include.mobile_menu')
        <!-- /Mobile Menu -->
    </div>
    <!-- Header -->

    <!-- Sidebar -->
@include('admin.include.sidebar')
    <!-- /Sidebar -->

    <div class="page-wrapper">
        @yield('content')
    </div>

</div>
<!-- /Main Wrapper -->

@include('admin.include.assets.js')


</body>
</html>
