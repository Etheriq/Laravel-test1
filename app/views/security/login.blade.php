@extends('layout')

@section('title')
Login form
@endsection

@section('content')

    {{ Form::open(array('action' => 'proj1\Controllers\UserController@login')) }}
        {{ Form::label('username', 'Login') }}
        {{ Form::text('username') }} <br/>
        {{ Form::label('password', 'Password') }}
        {{ Form::password('password') }}
        {{ Form::submit('enter') }}
    {{ Form::close() }}

<br/>
<br/>
<a href="{{{ URL::route('register') }}}">register new user</a>

@endsection

