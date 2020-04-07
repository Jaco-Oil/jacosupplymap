<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="icon" href="/images/favicon.png">
    <link href="{{ asset('css/fa/css/font-awesome.min.css') }}" rel="stylesheet"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Jaco') }}</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet"/>
</head>

<body>
<div id="app"></div>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
