@extends('amaster')

@section('title')
    Goals Search
@stop


   @section('content')

   <h1>Search</h1>

       <h4>You will need your ID to add goals. You're ID is: {{{ Auth::user()->id}}}</h4>
       <br>

	{{ Form::open(array('url' => '/goals/add')) }}

	  {{ Form::label('Goal Name') }}
    {{ Form::text('name') }}

    {{ Form::label('Description') }}
    {{ Form::text('description') }}

    {{ Form::label('users_id', 'User') }}
    {{ Form::text('users_id', Auth::user()->id}}

    {{ Form::submit('Submit') }}

	{{ Form::close() }}

@stop