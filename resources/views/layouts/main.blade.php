<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('page-title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('custom-css')
</head>
<body class="bg-dark">

    @yield('content')

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('custom-script')
</body>
</html>