@extends('layout')

@section('title')
    articles
@endsection

@section('content')
    <h3>Article list</h3>

        <table border="1" width="80%">
            <tr>
                <td>Title</td>
                <td>Author</td>
                <td>created at</td>
                <td>tags</td>
            </tr>
        @foreach($articles as $article)
            <tr>
                <td>
                    {{ link_to_route('articleDetail', $article->title, array($article->id)) }}
                </td>
                <td>
                    {{ $article->user->username }} ({{ $article->user->email }})
                </td>
                <td>
                    {{ date("d.m.Y",strtotime($article->created_at)) }}
                </td>
                <td>
                    @foreach($article->tags as $tag)
                        <span style="background-color: #dda0dd;">{{ $tag->tag }}</span>
                    @endforeach
                </td>
            </tr>
        @endforeach

        </table>

@endsection

