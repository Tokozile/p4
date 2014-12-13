<!DOCTYPE html>
<html>
<head>

    <title>@yield('title', 'My Web Site')</title>

    <meta charset='utf-8'>
    <link rel='stylesheet' href='{{ asset('css/foobar.css') }}'>

    @yield('head')

</head>
<body>
	<img src='/img/Silo_hive.png' alt='SILO logo'>


    @yield('content')

    @yield('search')

    <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js' type='text/javascript'></script>


    @yield('footer')
 

</body>
</html>