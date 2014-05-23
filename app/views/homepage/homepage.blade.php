@extends('layout')

@section('title')
    homepage
@endsection

@section('content')

    @if (Session::has('info'))
        {{ Session::get('info') }}
    @endif

    <h3>Home page</h3>

    <?php
        $artS = \proj1\Models\Article::all();
    ?>

    {{ (count($artS)) }}

@endsection

