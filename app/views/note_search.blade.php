@extends('amaster')

@section('title')
    Note Search
@stop


   @section('content')
   <br>

   <h1>NOTE SEARCH</h1><h4>Search By Notes</h4><br>


	{{ Form::open(array('url' => '/note/search')) }}



		{{ Form::label('query','Note') }}

		{{ Form::text('query', 'Note Text') }}

		{{ Form::submit('Search') }}

	{{ Form::close() }}

@stop
