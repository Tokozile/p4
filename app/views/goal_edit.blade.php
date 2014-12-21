@extends('amaster')


@section('title')
    Edit Goal
@stop


   @section('content')

<section>

		@if(Session::get('flash_message'))
		<div class='flash-message'>{{ Session::get('flash_message') }}</div>
		@endif

		<link rel='stylesheet' href='/css/silo.css' type='text/css'>

					<a href='/'>Home</a>
	<h1>Edit</h1>
	<h2>{{{ $goal->name}}}</h2>

	{{---- EDIT -----}}
	{{ Form::open(array('url' => '/goal/edit')) }}

		{{ Form::hidden('id',$goal->id) }}

		<div class='form-group'>
			{{ Form::label('name','Name') }}
			{{ Form::text('name',$goal->name) }}
		</div>

		<div class='form-group'>
			{{ Form::label('decription', 'Description') }}
			{{ Form::text('description', $goal->description) }}
		</div>


		@if ($goal->goal_completed === 0)
		<div class='form-group'>
			{{ Form::label('created_at','Goal Creation Date') }}
			{{ Form::text('created_at',$goal->created_at) }}
		</div>

		@endif
		<div class='form-group'>
			{{ Form::label('id', 'ID') }}
			{{ Form::text('id', $goal->id) }}
		</div>
		

		{{ Form::submit('Save Changes') }}

		{{ Form::close() }}


@if ($goal->goal_completed === 0)

{{ Form::hidden('id',$goal->id) }}

		<div>
		{{---- COMPLETE -----}}
		{{ Form::open(array('url' => '/goal/complete')) }}
			{{ Form::hidden('id',$goal->id) }}
			<button onClick='parentNode.submit();return false;'>Mark goal as complete</button>
		{{ Form::close() }}

			<div>
		{{---- DELETE -----}}
		{{ Form::open(array('url' => '/goal/delete')) }}
			{{ Form::hidden('id',$goal->id) }}
			<button onClick='parentNode.submit();return false;'>Delete goal</button>
		{{ Form::close() }}
	</div>

	</div>
@elseif ($goal->goal_completed === 1)

	<div>
		{{---- DELETE -----}}
		{{ Form::open(array('url' => '/goal/delete')) }}
			{{ Form::hidden('id',$goal->id) }}
			<button onClick='parentNode.submit();return false;'>Delete goal</button>
		{{ Form::close() }}
	</div>
@endif

</section>

@stop