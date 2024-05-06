@extends('base')

@section('title', 'Accueil du blog')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-2">
            <!-- Aggiungi il form per il filtro -->
            <h3>Mes filtres</h3>
            <form action="{{ route('blog.index') }}" method="GET">
                <div class="form-group">
                    <label for="category_id">Categoria:</label>
                    <select class="form-control" name="category_id" id="category_id">
                        <option value="">Tutte le categorie</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select><br>
                </div>
                <div class="form-group">
                    <label for="tag_ids">Tag:</label>
                    <select class="form-control" name="tag_ids[]" id="tag_ids" multiple>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select><br>
                </div>
                <button type="submit" class="btn btn-primary">Filtra</button>
            </form>
        </div>
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1>Mon Blog</h1>
                <a href="{{ route('blog.create') }}" class="btn btn-primary">Ajouter un article</a>
            </div>
            <hr>
            <!-- Itera sui post --> 
            @foreach ($posts as $post)
                <div class="card mb-3">
                    <article class="card-body">
                        <h2>{{ $post->title }}</h2>
                        @if($post->category)
                            <p class="card-subtitle sb-2 text-muted">
                                Catégorie : <strong>{{ $post->category->name }} </strong>
                            </p>
                        @endif
                        @if(!$post->tags->isEmpty())
                            <p class="card-subtitle sb-2 text-muted">Tags : 
                                @foreach($post->tags as $tag)
                                    <span class="badge bg-secondary">{{ $tag->name }}</span>
                                @endforeach
                            </p>
                        @endif
                        <p class="card-text">
                            {{ $post->content }}
                        </p>
                        <p>
                            <a href="{{ route('blog.show', ['slug'=> $post->slug, 'post' => $post->id])}}" class="btn btn-primary">Lire la suite</a>
                        </p>
                    </article>
                </div>
            @endforeach
        </div>
    </div>
</div>


@endsection
