@extends('amaster')

@section('title')
    {{ Auth::user()->email; }} is page
@stop

@section('head')

@stop

@section('content')
    <h3>Hello {{{ Auth::user()->first_name}}}!  ({{ Auth::user()->email; }})</h3>

    <p>You can make changes to any exisiting goals that you created, search for a specific goal, list all your goals and/or review your notes. </p>

@stop
