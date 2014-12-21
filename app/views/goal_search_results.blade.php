<!DOCTYPE html>
<html>
<head>

	<title>Goals</title>
	<meta charset='utf-8'>

	<link href="//netdna.bootstrapcdn.com/bootswatch/3.1.1/flatly/bootstrap.min.css" rel="stylesheet">
	<link rel='stylesheet' href='/css/silo.css' type='text/css'>



</head>
<body>

		@if(Session::get('flash_message'))
		<div class='flash-message'>{{ Session::get('flash_message') }}</div>
	@endif

	<link rel='stylesheet' href='/css/silo.css' type='text/css'>


	@if ($goal->goal_completed === 1)
<div class='grey'>
		<h2>{{ $goal->name }}</h2>
		<p>{{ Form::label('name',$goal->name) }} {{ Form::label('decription', $goal->description) }}</p>

    <p>Date Created: 
    	{{ Form::label('created_at',$goal->created_at) }}</p>

	<p>Date Completed: 
		{{ Form::label('updated_at',$goal->updated_at) }}
	</p>
			<a href='/goal/edit/{{ $goal->id }}'>Edit</a> <br><br> 
						<a href='/'>Return To Homepage</a>

</div>


	@elseif ($goal->goal_completed === 0)
	<div class='orange'>
		<h2>{{ $goal->name }}</h2>
		<p>{{ Form::label('name',$goal->name) }}{{ Form::label('decription', $goal->description) }}</p>
	   
	   <p>Date Created: 
    	{{ Form::label('created_at',$goal->created_at) }}</p>
			<a href='/goal/edit/{{ $goal->id }}'>Edit</a> <br><br> 			
						<a href='/'>Return To Homepage</a>

</div>

	@else
	    You do not have any goals created yet. Please Click on the link below to start creating goals!
	    <a href='/goal/add'>Edit</a>
	@endif

</body>
</html>





