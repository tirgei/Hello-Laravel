@extends('master')

@section('title', 'Home')

@section('content')

    <h2>Post Message:</h2>

    <form action="/create" method="post">
        {{ csrf_field() }}
        <input type="text" name="title" placeholder="Title">
        <input type="content" name="content" placeholder="Content">
        <button type="submit">Submit</button>
    </form>

    <h2>Recent Messages</h2>

    <ul>
        @foreach($messages as $message) 
            <li>
                <strong>{{ $message->title }}</strong>
                <br>
                {{ $message->content }}
                <br>    
                {{ $message->created_at }}
                <br>
                <a href="/message/{{ $message->id }}">View</a>
            </li>
        @endforeach 
    </ul>
@endsection