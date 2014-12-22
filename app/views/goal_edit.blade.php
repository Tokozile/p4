<!DOCTYPE html>
<html>
<head>

	<title>Edit Goal</title>
	<meta charset='utf-8'>
	<link rel='stylesheet' href='/css/silo.css' type='text/css'>
</head>
<body>

		@if(Session::get('flash_message'))
		<div class='flash-message'>{{ Session::get('flash_message') }}</div>
		@endif

<a href='/'>Return To Homepage</a>

	<h1>Edit</h1>
	<h2>{{{ $goal->name}}}</h2>

	{{---- EDIT -----}}
	{{ Form::open(array('url' => '/goal/edit')) }}

		{{ Form::hidden('id',$goal->id) }}

			{{ Form::label('name','Name') }}
			{{ Form::text('name',$goal->name) }}

			{{ Form::label('decription', 'Description') }}
			{{ Form::text('description', $goal->description) }}

		@if ($goal->goal_completed === 0)

			{{ Form::label('created_at','Goal Creation Date') }}
			{{ Form::text('created_at',$goal->created_at) }}

		@endif

			{{ Form::label('id', 'ID') }}
			{{ Form::text('id', $goal->id) }}	

		{{ Form::submit('Save Changes') }}

		{{ Form::close() }}

			{{ Form::hidden('id',$goal->id) }}

		{{---- COMPLETE -----}}
		{{ Form::open(array('url' => '/goal/complete')) }}
			{{ Form::hidden('id',$goal->id) }}
			<button onClick='parentNode.submit();return false;'>Mark goal as complete</button>
		{{ Form::close() }}

		{{---- DELETE -----}}
		{{ Form::open(array('url' => '/goal/delete')) }}
			{{ Form::hidden('id',$goal->id) }}
			<button onClick='parentNode.submit();return false;'>Delete goal</button>
		{{ Form::close() }}


		{{---- DELETE -----}}
		{{ Form::open(array('url' => '/goal/delete')) }}
			{{ Form::hidden('id',$goal->id) }}
			<button onClick='parentNode.submit();return false;'>Delete goal</button>
		{{ Form::close() }}


</body>
</html>