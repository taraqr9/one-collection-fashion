<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <title>@yield('title') | {{ config('app.name') }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ url()->asset('user/assets/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ url()->asset('user/assets/css/jquery-ui.css') }}"/>
    <link rel="stylesheet" href="{{ url()->asset('user/assets/css/slick.css') }}"/>
    <link rel="stylesheet" href="{{ url()->asset('user/assets/css/line-awesome.css') }}"/>
    <link rel="stylesheet" href="{{ url()->asset('user/assets/css/nice-select.css') }}"/>
    <link rel="stylesheet" href="{{ url()->asset('user/assets/css/fontawesome.css') }}"/>

    <link rel="stylesheet" href="{{ url()->asset('user/assets/css/style.css') }}"/>
    <link rel="stylesheet" href="{{ url()->asset('user/assets/css/responsive.css') }}"/>

    @yield('external_css')

    @yield('external_js')

</head>

<body>

<div class="preloader">
    <img src="{{ url()->asset('user/assets/images/preloader.gif') }}" alt="preloader"/>
</div>

@include('user.header')

@include('user.nav')

@yield('page_content')

@include('user.footer')

<script src="{{ url()->asset('user/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url()->asset('user/assets/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ url()->asset('user/assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ url()->asset('user/assets/js/slick.min.js') }}"></script>
<script src="{{ url()->asset('user/assets/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ url()->asset('user/assets/js/fontawesome.js') }}"></script>
<script src="{{ url()->asset('user/assets/js/app.js') }}"></script>

</body>

@yield('footer_js')

</html>
