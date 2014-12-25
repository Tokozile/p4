@extends('amaster')

@section('title')
    Note Add
@stop


   @section('content')

  <h1>ADD NOTE</h1>

       <h4>Enter a goal name and description to create a new goal. Good Luck!</h4>
       <br>

	{{ Form::open(array('url' => '/note/add')) }}

	  {{ Form::label('note', 'Note: ') }}
    {{ Form::textarea('note') }}

    {{ Form::hidden('users_id', 'User') }}
    {{ Form::hidden('users_id', Auth::id())}}

    {{ Form::submit('Submit') }}

	{{ Form::close() }}

@stop