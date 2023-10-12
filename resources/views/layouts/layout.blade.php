<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>TickerRaiser</title>
    <link rel="stylesheet" href="{{asset('/bootstrap-5.0.2-dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    @yield('css-link')
</head>
<body>
@yield('content')
</body>
<script src="{{asset('/Js/jquery-3.6.3.min.js')}}"></script>
<script src="{{asset('/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js')}}"></script>
@yield('scripts-link')
</html>
