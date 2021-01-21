<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('admin.partials.head')

<body>
<!-- Sidenav -->
@include('admin.partials.sidebar')
<!-- Main content -->
<div class="main-content" id="panel">
    <!-- Topnav -->
    @include('admin.partials.header')
    <!-- Page content -->
    @yield('content')
    {{--@include('admin.partials.footer')--}}
</div>
<!-- Argon Scripts -->
<!-- Core -->
@include('admin.partials.main-js')
</body>
</html>
