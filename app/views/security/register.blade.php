@extends('layout')

@section('title')
Register new user form
@endsection

@section('content')

<h3> New user registration </h3>

@if (Session::has('error'))
    {{ Session::get('error') }}
@endif

{{ Form::open(array('action' => 'proj1\Controllers\UserController@register')) }}
{{ Form::label('first_name', 'Enter first name') }}
{{ Form::text('first_name') }} <br/>
{{ Form::label('username', 'Enter login') }}
{{ Form::text('username') }} <br/>
{{ Form::label('email', 'Enter e-mail') }}
{{ Form::email('email') }} <br/>
{{ Form::label('password', 'Enter password') }}
{{ Form::password('password') }} <br/>
{{ Form::label('password_confirmation', 'confirm your password') }}
{{ Form::password('password_confirmation') }} <br/>
{{ Form::submit('enter') }}
{{ Form::close() }}

@endsection
