<!DOCTYPE html>
<html>
<head>

	<title>Edit Note</title>
	<meta charset='utf-8'>
	<link rel='stylesheet' href='/css/silo.css' type='text/css'>
</head>
<body>

		@if(Session::get('flash_message'))
		<div class='flash-message'>{{ Session::get('flash_message') }}</div>
		@endif

		<a href='/'>Return To Homepage</a>

	<h1>Edit Note</h1>

	{{---- EDIT -----}}
	{{ Form::open(array('url' => '/note/edit')) }}

		{{ Form::hidden('id',$note->id) }}

			{{ Form::label('note','Note') }}
			{{ Form::textarea('note',$note->note) }}

			{{ Form::hidden('id', 'ID') }}
			{{ Form::hidden('id', $note->id) }}	

		{{ Form::submit('Save Changes') }}

		{{ Form::close() }}

		{{---- DELETE -----}}
		{{ Form::open(array('url' => '/note/delete')) }}
			{{ Form::hidden('id',$note->id) }}
			<button onClick='parentNode.submit();return false;'>Delete note</button>
		{{ Form::close() }}

</body>
</html>