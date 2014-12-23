<!DOCTYPE html>
<html>
<head>

	<title>@yield('title','SILO')</title>
	<meta charset='utf-8'>

	<link href="//netdna.bootstrapcdn.com/bootswatch/3.1.1/flatly/bootstrap.min.css" rel="stylesheet">
	<link rel='stylesheet' href='/css/silo.css' type='text/css'>

	@yield('head')


</head>
<body>


	@if(Session::get('flash_message'))
		<div class='flash-message'>{{ Session::get('flash_message') }}</div>
	@endif


<a href='/'>
	<img src='/img/Silo_hive.png' alt='SILO logo'>
</a>


	@if(Auth::check())
			<div class='user'>
				<nav>
					<ul>
						<li><a href='/logout'>Log out   {{{ Auth::user()->first_name}}} ({{ Auth::user()->email; }})</a></li>

				<nav>
					<ul>
			</div>

		@else
			<div class='non-user'>

					<nav>
						<ul>
							<li><a href='/signup'>Sign up</a> or <a href='/login'>Log in</a></li>
			</div>
	@endif
						</ul>
					</nav>
		
		
				<nav>
						<ul>


							@if(Auth::check())
								

								<li><a href='/goal'>Show all your Goals and Notes</a></li>
								<li><a href='/goal/search'>Search for Goal</a></li>
								<li><a href='/goal/incomplete'>Show Only Incomplete Goals</a></li>
								<li><a href='/goal/complete'>Show Only Complete Goals</a></li>
								<li><a href='/goal/add'>Add a new Goal</a></li>
							@endif
						</ul>
				</nav>

	<a href='https://github.com/tokozile/p4'>Find on Github</a>

	@yield('content')

	@yield('search')

	@yield('/body')

</body>
</html>





