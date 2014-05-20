@extends('layout')

@section('title')
articles
@endsection

@section('content')
    <h3>Articles</h3>
        @foreach($articles as $article)
            <p>
                {{ $article->title }} <b>Author is</b> {{ $article->user->username }} ({{ $article->user->email }})
                created at {{ date("d.m.Y",strtotime($article->created_at)) }}
             </p>
        @endforeach
@endsection

