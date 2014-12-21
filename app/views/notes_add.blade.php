@extends('amaster')

@section('title')
    Note Add
@stop


   @section('content')

  <h1>ADD NOTE</h1>
  <h2>{{{ You're note will be added to $goal->name}}}</h2>

       <h4>Enter a goal name and description to create a new goal. Good Luck!</h4>
       <br>

	{{ Form::open(array('url' => '/note/add')) }}

	  {{ Form::label('note', 'Note: ') }}
    {{ Form::areatext('note', 'add note here') }}

    {{ Form::label('Description') }}
    {{ Form::text('description') }}

    {{ Form::label('goal_id', 'goal') }}
    {{ Form::text('goal_id', $goal->id}}

    {{ Form::submit('Submit') }}

	{{ Form::close() }}

@stop