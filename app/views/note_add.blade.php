<section>

		@if(Session::get('flash_message'))
		<div class='flash-message'>{{ Session::get('flash_message') }}</div>
		@endif
	<img src='/img/Silo_hive.png' alt='SILO logo'>
		<link rel='stylesheet' href='/css/silo.css' type='text/css'>

					<a href='/'>Home</a>
	<h1>Add Note</h1>
	<h2>{{{ You're note will be added to $goal->name}}}</h2>

	{{---- EDIT -----}}
	{{ Form::open(array('url' => '/note/add')) }}

		{{ Form::hidden('id',$goal->id) }}

		<div class='form-group'>
			{{ Form::label('note','Note') }}
			{{ Form::textarea('note','Note goes here') }}
		</div>

		<div class='form-group'>
			{{ Form::hidden('goal_id', $goal->id) }}
		</div>


		{{ Form::submit('Save Note') }}

		{{ Form::close() }}


			<div>
		{{---- DELETE -----}}
		{{ Form::open(array('url' => '/goal/delete')) }}
			{{ Form::hidden('id',$goal->id) }}
			<button onClick='parentNode.submit();return false;'>Delete goal</button>
		{{ Form::close() }}
	</div>

</section>