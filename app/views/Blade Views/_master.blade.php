<!DOCTYPE html>
<html>
<head>

    <title>@yield('title', 'My Web Site')</title>

    <meta charset='utf-8'>
    <link rel='stylesheet' href='{{ asset('css/foobar.css') }}'>

    @yield('head')

</head>
<body>


    @yield('content')

    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js' type='text/javascript'></script>

    @yield('footer')

</body>
</html>