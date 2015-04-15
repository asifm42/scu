<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-paper.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/site.css') }}">

    @yield('styles')
</head>
<body>
    @include('navbars/default')

    @include('flash::message')

    <div class="container-fluid">
        @yield('content')
    </div>

    @include('footer/default')
    <!-- Minified jQuery -->
    <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

    @yield('scripts')
</body>
</html>