@extends('layout')

@section('title')
Create article
@endsection

@section('content')
<h3>Creating article</h3>

{{ Form::open(array('action' => 'proj1\Controllers\ArticleController@create')) }}

    {{ Form::label('title', 'Название') }}
    {{ Form::text('title') }} <br/>
    {{ Form::label('description', 'текст') }}
    {{ Form::textarea('description', '', array('rows'=> 5, 'cols'=>25, 'class'=>'zzz')) }} <br/>
    {{ Form::label('tags', 'Теги') }}
    {{ Form::text('tags') }}

{{ Form::submit('enter') }}
{{ Form::close() }}

@endsection

