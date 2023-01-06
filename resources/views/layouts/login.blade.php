<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>Promo Novatio</title>

    <!-- manifest meta -->
    <meta name="apple-mobile-web-app-capable" content="yes">

    
    @include('partials.css')

</head>

<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="landing">
    @include('components.loader')

    @yield('login')
    

    @include('partials.js')
    @yield('login-scripts')
    
</body>

</html>
