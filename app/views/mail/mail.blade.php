@extends('layout')

@section('menu')
@endsection

@section('content')
    <p>Hello</p>
<pre>
    Это письмо
        от: {{ $from }}
        для: {{ $to }}
        с описанием: {{ $description }}
</pre>
@endsection
