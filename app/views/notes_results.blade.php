<!DOCTYPE html>
<html>
<head>

	<title>Notes</title>
	<meta charset='utf-8'>
	<link rel='stylesheet' href='/css/silo.css' type='text/css'>
</head>
<body>
</br>



	@if(Session::get('flash_message'))
		<div class='flash-message'>{{ Session::get('flash_message') }}</div>
	@endif


		@if($note)

	{{ Form::label('note', 'Note: ') }}
    {{ Form::label('note', $note->note) }}

      <p>Date Created: 
    	{{ Form::label('created_at',$note->created_at) }}</p>
	</p> </div>

	@else

	<p>We have no notes for you. Feel free to add some.</p>
    	@endif



			<a href='/note/edit/{{ $note->id }}'>Edit</a> <br><br> 
						<a href='/'>Return To Homepage</a>

</body>
</html>





