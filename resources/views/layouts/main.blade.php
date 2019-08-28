<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no, email=no">
    <meta name="csrf-token" content="{!! csrf_token() !!}"/>
    <meta name="viewport" content="width=device-width">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="robots" content="noindex">
    @section('title')
        @yield('title')
    @show
    <link type="text/css" href="{{ url('css/common.css') }}" rel="stylesheet">
    <link type="text/css" href="{{ url('fontawesome/css/fontawesome-all.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ url('favicon.ico') }}"/>
    @section ('css')
    @show
</head>
<body>
    <div class="l-page">
        @section('header')
            @include('layouts.header')
        @show
        @yield('content')

        @include('layouts.footer')
        @section('modal')
        @show
    </div>
</body>
<script type='text/javascript' src="{{ url('js/common.js') }}"></script>
@section('script')
@show
</html>
