@extends('layout')

@section('title')
articles by tag
@endsection

@section('content')
<h3>Articles by tag</h3>

@foreach($tag as $article)
    <p> {{ link_to_route('articleDetail', $article->title, array($article->id))  }} </p>
@endforeach

{{ $tag->links() }}

@endsection

