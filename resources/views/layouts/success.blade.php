<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <!-- Favicon-->
    <link rel="icon" href="{{ URL::asset('frontend/assets/ic-new-pione.svg') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ URL::asset('frontend/assets/ic-new-pione.svg') }}" type="image/x-icon" />
    <title>@yield('title')</title>

    {{-- Style --}}
    @stack('prepend-style')
    @include('includes.style')
    @stack('addon-style')
</head>

<body style="height: 100vh">

    {{-- Page Content --}}
    @yield('content')

    {{-- @include('includes.footer-success') --}}
    {{-- Script --}}
    @stack('prepend-script')
    @include('includes.script')
    @stack('addon-script')
</body>

</html>
