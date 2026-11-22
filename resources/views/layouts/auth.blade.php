<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title')</title>
    <!-- Favicon-->
    <link rel="icon" href="{{ URL::asset('frontend/assets/ic-new-pione.svg') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ URL::asset('frontend/assets/ic-new-pione.svg') }}" type="image/x-icon" />
    @include('includes.style')
</head>

<body class="d-flex flex-column h-100">
    @include('includes.navbar-auth')
    @yield('content')
    <!-- Footer-->
    {{-- @include('includes.footer') --}}
    @include('includes.script')
    @include('includes.notifications')
</body>

</html>
