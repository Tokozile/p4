<!-- <!DOCTYPE HTML>

<html>
<head>

		<title>SILO</title>
		<meta charset='utf-8'>

		<link rel='stylesheet' href='' type='text/css/'>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
    	<link rel='stylesheet' href='/style.css' type='text/css'>

</head>

<body>
<div class='welcome'>
	<img src='/img/Silo_hive.png' alt='SILO logo'>

</div>
	<div>
		<p>Hello! Welcome to SILO! We are glad you've here. This is a place where you can store and keep track of personal goals!
	Once you're goals have been created, they act as a journal of all the things you've
	deemed important enough to keep track of. Welcome to SILO!"</p>
Search: <input type='text'>
</div>

<nav>
		<ul>
		@if(Auth::check())
			<li><a href='/logout'>Log out {{ Auth::user()->email; }}</a></li>
			<li><a href='/book'>All Your Goals</a></li>
			<li><a href='/book/search'>Search Goals(w/ Ajax)</a></li>
			<li><a href='/tag'>All Tags</a></li>
			<li><a href='/book/create'>+ Add Goal</a></li>
			<li><a href='/debug/routes'>Routes</a></li>
		@else
			<li><a href='/signup'>Sign up</a> or <a href='/login'>Log in</a></li>
		@endif
		</ul>
	</nav>

<!-- 	Print Name Variable from routes file -->
<!-- Hello <?php echo $name; ?> -->

<!--    SAME THING IN BLADE    -->
<!--Hello {{$name}}
	<a href='https://github.com/tokozile/p4'>View on Github</a>

</body>

</html>

 -->
@extends('amaster')

@section('title')
	SILO
@stop

@section('head')

@stop

@section('content')

Hello! Welcome to SILO! We are glad you've here. This is a place where you can store and keep track of personal goals!
	Once you're goals have been created, they act as a journal of all the things you've
	deemed important enough to keep track of. Welcome to SILO!
@stop


@section('search')

	{{ Form::open(array('url' => '/data', 'method' => 'GET')) }}

		{{ Form::label('query','Search') }}

		{{ Form::text('query'); }}

		{{ Form::submit('Search'); }}

	{{ Form::close() }}

@stop


<!-- <form method='GET' action='/index'>
		<label for='query'>Search:</label>
		<input type='text' name='query' id='query'>
		<input type='submit' value='Search'>
</form> -->