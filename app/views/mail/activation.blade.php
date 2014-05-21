@extends('layout')

@section('menu')
@endsection

@section('content')
<p>Hello</p>
<pre>
    Это письмо
        от: {{ $from }}
        для: {{ $to }}
        Код активации: {{ $activationCode }}
</pre>
@endsection
