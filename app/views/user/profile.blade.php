@extends('layout')

@section('title')
User profile
@endsection

@section('content')

    Secure zone !!!

    <br/><br/> {{ Sentry::getUser()->username }}

@endsection

