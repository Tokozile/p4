@extends('amaster')

@section('title')
    Goal Search
@stop


   @section('content')
   <br>

   <h1>GOAL SEARCH</h1><h4>Search By Name or Description</h4><br>


	{{ Form::open(array('url' => '/goal/search')) }}



		{{ Form::label('query','Name') }}

		{{ Form::text('query', 'Goal Name') }}

		{{ Form::submit('Search') }}

	{{ Form::close() }}

@stop
