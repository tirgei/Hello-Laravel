@extends('master')

@section('title', $message->title)

@section('content')
    {{ $message->content }}
    <br>
    {{ $message->created_at }}
@endsection