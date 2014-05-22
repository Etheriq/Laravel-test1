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
            <span style="background-color: #dda0dd;">{{ $tag->tag }}</span>
        @endforeach
    </div>

@endsection

