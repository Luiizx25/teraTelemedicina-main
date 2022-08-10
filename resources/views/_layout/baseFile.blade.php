<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ $theme??'light' }}">
<!-- BEGIN: Head -->
<head>
    <meta charset="utf-8">
    <link href="{{ asset('dist/images/logo.svg') }}" rel="shortcut icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="ref_description" content="Pzn Criativo">
    <meta name="keywords" content="pzn criativo, web app">
    <meta name="author" content="PZNCRIATIVO.COM">

    <title>
        inTera - {{ __($title??'TELE MEDICINA') }}
    </title>

    <!-- BEGIN: CSS Assets-->
    <link rel="stylesheet" href="{{ mix('dist/css/app.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{asset('/app/css/custom.css')}}">
    <!-- END: CSS Assets-->
    <!-- BEGIN: USE-->
    @if($useDataTable??false)
        <link rel="stylesheet" type="text/css" href="{{asset('/app/css/jquery.dataTables.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{asset('/app/css/buttons.dataTables.min.css')}}">
    @endif
    @if($useToastr??false)
        <link rel="stylesheet" type="text/css" href="{{asset('/app/css/toastr.min.css')}}">
    @endif
    <!-- END: USE-->
</head>
<!-- END: Head -->

<!-- BEGIN: USE-->
@if($useJquery??false)
    <script src="{{asset('/app/js/jquery.js')}}"></script>
    <script src="{{asset('/app/js/custom.js')}}"></script>
@endif

<body>
    @yield('body')
</body>
</html>
