@extends('layout')

@section('title')
article edit
@endsection

@section('content')
<h3>Article edit</h3>


{{ Form::model($article, array('route' => array('articleEdit', $article->id))) }}

    {{ Form::label('title', 'Название') }}
    {{ Form::text('title') }} <br/>
    {{ Form::label('description', 'текст') }}
    {{ Form::textarea('description') }} <br/>
        <?php $aa = ''; ?>
        @foreach($article->tags as $tag)
            <?php
                $aa .=' '.$tag->tag;
            ?>
        @endforeach

    {{ Form::label('tags', 'Теги') }}
    {{ Form::text('tags', $aa) }}

    {{ Form::submit('edit') }}

{{ Form::close() }}


@endsection

