@extends('layout')

@section('title')
articles
@endsection

@section('content')
    <h3>Articles</h3>
        @foreach($articles as $article)
            <p>{{ $article->title }}</p>
        @endforeach
@endsection

