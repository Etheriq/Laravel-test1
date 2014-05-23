@extends('layout')

@section('title')
article detail
@endsection

@section('content')
    <h3>Article detail</h3>

    @if (Session::has('info'))
        {{ Session::get('info') }}
    @endif


    @if (Sentry::check())
        <?php
            $adminGroup = Sentry::findGroupByName('Admin');
            $user = Sentry::getUser();
        ?>

            @if ($article->user->id == $user->id)
                This is author!  {{ link_to_route('articleEdit', 'Edit article', array($article->id)) }}
            @elseif ($user->inGroup($adminGroup))
                This is admin!   {{ link_to_route('articleEdit', 'Edit article', array($article->id)) }}
            @endif
    @endif

    <br/><br/><br/>

    <div>
        <b>Tile:</b> {{ $article->title }}
    </div>
    <div>
        <b>Description:</b> {{{ $article->description }}}
    </div>
    <div>
        <b>Tags:</b>
        @foreach($article->tags as $tag)
            {{ link_to_route('articleShowByTag', $tag->tag, array($tag->tag)) }}
        @endforeach
    </div>

    <div>
        @foreach($article->comments as $comment)
            <p>
                <b>Author is: </b> {{ $comment->user->username }} ({{ $comment->user->email }}) <b>Created at:</b> {{ date('d.m.Y H:i', strtotime($comment->created_at)) }}
            </p>
            <p>
                {{ $comment->comment }}
            </p>
        @endforeach
    </div>

    <hr>

@if (Sentry::check())

    {{ Form::open(array('action' => array('proj1\Controllers\CommentController@create', $article->id))) }}

    {{ Form::label('comment', 'Коментарий') }}
    {{ Form::textarea('comment', '', array('class'=> 'dd', 'cols'=> 45, 'rows'=> 4)) }} <br/>

    {{ Form::submit('publish') }}
    {{ Form::close() }}

@endif

@endsection

