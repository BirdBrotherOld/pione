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
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700;800;900&display=swap" rel="stylesheet">
    </head>
    <body class="d-flex flex-column h-100" style="background-color: rgb(245, 245, 245); padding-top: 0px;">
        @include('includes.navbar')
        @yield('content')
        <!-- Footer-->
        @include('includes.footer')
            
        <!-- Bootstrap core JavaScript -->
        @stack('prepend-script')
        @include('includes.script')
        @stack('addon-script')
        @include('includes.notifications')
    </body>
</html>
