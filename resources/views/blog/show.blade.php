@extends('base')

{{-- @dd($post->slug); --}}
@section('title', $post->title)

@section('content')
 
    <article>
        <h1>{{ $post->title }}</h1>
        <p>
            {{ $post->content }}
        </p>
        <hr>
        <p>
            <a href="{{ route('blog.edit', ['post' => $post->id]) }}" class="btn btn-primary">Modifier l'article</a>
            <a href="#" class="btn btn-danger">Eliminer l'article</a>
        </p>
    </article>

    
@endsection