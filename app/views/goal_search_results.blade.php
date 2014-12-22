<!DOCTYPE html>
<html>
<head>

	<title>Goals</title>
	<meta charset='utf-8'>
	<link rel='stylesheet' href='/css/silo.css' type='text/css'>
</head>
<body>

	@if(Session::get('flash_message'))
		<div class='flash-message'>{{ Session::get('flash_message') }}</div>
	@endif

	@if ($goal->goal_completed === 1)
		
		<h2>{{ $goal->name}}</h2>
		<p>{{ Form::label('name',$goal->name) }} You Completed this goal on: </p>
		<p> 
		{{ Form::label('updated_at',$goal->updated_at) }}</p>

		<p>Goal Description{{ Form::label('decription', $goal->description) }}</p>

    <p>Date Created: 
    	{{ Form::label('created_at',$goal->created_at) }}</p>

	
	</p>
			<a href='/goal/edit/{{ $goal->id }}'>Edit</a> <br><br> 
						<a href='/'>Return To Homepage</a>
	@endif

	@if ($goal->goal_completed === 0)

		<h2>{{ $goal->name }}</h2>
		<p>{{ Form::label('name',$goal->name) }}: Has Not Yet Been Completed{{ Form::label('decription', $goal->description) }}</p>
	   
	   <p>Date Created: 
    	{{ Form::label('created_at',$goal->created_at) }}</p>
			<a href='/goal/edit/{{ $goal->id }}'>Edit</a> <br><br> 			
			<a href='/'>Return To Homepage</a>
	@endif

</body>
</html>





