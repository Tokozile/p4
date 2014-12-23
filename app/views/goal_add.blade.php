@extends('amaster')

@section('title')
    Goal Add
@stop


   @section('content')

   <h1>ADD GOAL</h1>

       <h4>Enter a goal name and description to create a new goal. Good Luck!</h4>
       <br>

	{{ Form::open(array('url' => '/goal/add')) }}

	  {{ Form::label('Goal Name') }}
    {{ Form::text('name') }}

    {{ Form::label('Description') }}
    {{ Form::text('description') }}

    {{ Form::hidden('users_id', 'User') }}
    {{ Form::hidden('users_id', Auth::id())}}

    {{ Form::submit('Submit') }}

	{{ Form::close() }}

@stop