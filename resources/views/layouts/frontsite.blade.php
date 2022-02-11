<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        
        <!-- Meta -->
        @include('includes.frontsite.meta')

        <!-- Title -->
        <title>Electricity Bills</title>

        <!-- Favicon -->
        <link rel="apple-touch-icon" href="{{ asset('/back-design/clients/img/apple-touch-icon.png') }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/back-design/clients/img/favicon.ico') }}">

        <!-- Font -->
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        @stack('before-style')
            @include('includes.frontsite.style')
        @stack('after-style')

    </head>
    <body>

        <!-- Header -->
        @include('includes.frontsite.header')

        <!-- Content -->
        <main id="content" role="main">
            @yield('content')
        </main>

        <!-- Scripts -->
        @stack('before-script')
            @include('includes.frontsite.script')
        @stack('after-script')
    </body>
</html>
