<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    @include('includes.backsite.meta')

    <title>@yield('title') | Electricity Bills</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" href="{{ asset('/back-design/clients/img/apple-touch-icon.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/back-design/clients/img/favicon.ico') }}">

    {{-- Fonts --}}
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CQuicksand:300,400,500,700"
        rel="stylesheet">

    @stack('before-style')
    <!-- style -->
    @include('includes.backsite.style')

    @stack('after-style')

</head>

<body class="vertical-layout vertical-menu 2-columns fixed-navbar" data-open="click" data-menu="vertical-menu"
    data-col="2-columns">

    @include('sweetalert::alert')
    @include('includes.backsite.header')
    @include('includes.backsite.menu')
    @yield('content')
    @include('includes.backsite.footer')

    @stack('before-script')

    <!-- script -->
    @include('includes.backsite.script')

    @stack('after-script')

</body>

</html>
