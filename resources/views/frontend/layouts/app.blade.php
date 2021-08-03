<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('frontend.partials.head')
</head>
<body>
@include('frontend.partials.header_app')

@yield('content')

@include('frontend.partials.footer')

@include('frontend.partials.main-js')
@yield('js')
</body>
</html>