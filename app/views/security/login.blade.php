@extends('layout')

@section('title')
Login form
@endsection

@section('menu-login')
    @unless (Auth::check())
        You are not signed in.
    @endunless
@endsection

@section('content')

    {{ Form::open(array('action' => 'UserController@login')) }}
        {{ Form::label('username', 'Login') }}
        {{ Form::text('username') }} <br/>
        {{ Form::label('password', 'Password') }}
        {{ Form::password('password') }}

        {{ Form::submit('enter') }}

    {{ Form::close() }}

@endsection

