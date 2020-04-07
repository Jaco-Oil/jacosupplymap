<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
{{--    <script src="{{ asset('backend/js/app.js') }}" defer></script>--}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}
    <link href="{{ asset('backend/css/style.default.css') }}" rel="stylesheet">

    <!-- Styles -->
{{--    <link href="{{ asset('backend/css/app.css') }}" rel="stylesheet">--}}
</head>
<body class="signin">

<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>
    @yield('content')
</section>

<script src="{{ asset('backend/js/jquery-1.10.2.min.js') }}"></script>
<script src="{{ asset('backend/js/jquery-migrate-1.2.1.min.js') }}"></script>
<script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('backend/js/modernizr.min.js') }}"></script>
<script src="{{ asset('backend/js/retina.min.js') }}"></script>

<script src="{{ asset('backend/js/login-custom.js') }}"></script>

</body>
</html>
