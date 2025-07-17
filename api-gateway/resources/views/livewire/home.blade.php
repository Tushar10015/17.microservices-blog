@extends('components.layouts.app')

@section('content')
<div>
    <h1>Microservices Blog</h1>

    <ul>
        @foreach($posts as $post)
        <li>
            <strong>{{ $post['title'] }}</strong><br>
            {{ $post['body'] }}
        </li>
        @endforeach
    </ul>
</div>
@endsection