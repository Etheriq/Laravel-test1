@extends('layout')

@section('title')
Mail send form
@endsection

@section('content')

{{ Form::open(array('action' => 'proj1\Controllers\MailController@send')) }}
{{ Form::label('from', 'Mail from:') }}
{{ Form::text('from', '', array('placeholder' => 'input e-mail from', 'class' => 'ffd')) }} <br/>
{{ Form::label('to', 'Mail to:') }}
{{ Form::text('to', '', array('placeholder' => 'input e-mail to', 'class' => 'ffd2')) }} <br/>
{{ Form::label('mailBody', 'Mail body:') }}
{{ Form::textarea('mailBody') }}

{{ Form::submit('send') }}
{{ Form::close() }}

@endsection
