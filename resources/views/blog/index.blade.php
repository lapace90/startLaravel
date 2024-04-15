@extends('base')

@section('title', 'Accueil du blog')

@section('content')
    <h1>Mon Blog</h1>
@foreach ($posts as $post)
    <article>
        <h2>{{ $post->title }}</h2>
        <p>
            {{ $post->content }}
        </p>
    </article>
@endforeach
    @dump($posts);
@endsection

