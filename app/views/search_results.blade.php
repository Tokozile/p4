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


	@if ($goal->goal_completed == '1')	
	<div class='grey'>
		<h2>{{ $goal->name}}</h2>
		<p>{{ Form::label('name',$goal->name) }} </p>
		
		<p>Goal Description{{ Form::label('decription', $goal->description) }}</p>

    <p>Date Created: 
    	{{ Form::label('created_at',$goal->created_at) }}</p>
	<p>Date Completed: 
		{{ Form::label('updated_at',$goal->updated_at) }}</p>
	</div>
			<a href='/goal/edit/{{ $goal->id }}'>Edit</a> <br><br> 
						<a href='/'>Return To Homepage</a>


@elseif ($goal->goal_completed == '0')
<div class='orange'>
    <h2>{{ $goal->name}}</h2>
		<p>{{ Form::label('name',$goal->name) }} </p>

		<p>Goal Description{{ Form::label('decription', $goal->description) }}</p>

    <p>Date Created: 
    	{{ Form::label('created_at',$goal->created_at) }}</p>
	</p> </div>
			<a href='/goal/edit/{{ $goal->id }}'>Edit</a> <br><br> 
						<a href='/'>Return To Homepage</a>
@else
    <p>Sorry, we did not find any goals for you but you can always create new goals. Good Luck! Click below to start</p>
    <a href='/goal/add'>Create a new goal</a>
@endif

</body>
</html>





