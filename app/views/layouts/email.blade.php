<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta charset="UTF-8">
    <title>Obsidian Black</title>
    <link rel="stylesheet" href="{{ asset('assets/styles/bootstrap-slate.min.css')
       }}">
    <style>
        body {
            margin-top: 20px;
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="container-fluid">
        @include('flash::message')
        @yield('content')
    </div>
    <!-- Minified jQuery -->
    <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    @yield('scripts')
</body>
</html>