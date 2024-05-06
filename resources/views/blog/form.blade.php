<form action="" method="post" class="vstack gap-2">
    @csrf
    <div class="form-group">
        <label for="title">Titre</label>
        <input class="form-control" type="text" name="title" value="{{ old('title', $post->title) }}" id="title">
        @error("title")
        {{ $message }}
        @enderror
    </div>
    <div class="form-group">
        <label for="slug">Slug</label>
        <input class="form-control" type="text" id="slug" name="slug" value="{{ old('slug', $post->slug) }}">
        @error("slug")
        {{ $message }}
        @enderror
    </div>
    <div class="form-group">
        <label for="content">Contenu</label>
        <textarea class="form-control" name="content" id="content" cols="30" rows="10">{{ old('content', $post->content) }}</textarea>
        @error("content")
        {{ $message }}
        @enderror
    </div>
    <div class="form-group">
        <label for="category">Catégorie</label>
        <select class="form-control" type="text" id="category" name="category_id">
            <option value="">Sélectionner une catégorie</option>
            @foreach($categories as $category)
                <option @selected(old('category_id', $post->category_id) == $category->id) value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        @error("category_id")
        {{ $message }}
        @enderror
    </div>

    @php
        $tagsIds = $post->tags()->pluck('id');
    @endphp
    <div class="form-group">
        <label for="tag">Tags</label>
        <select class="form-control" type="text" id="tag" name="tags[]" multiple>
            @foreach($tags as $tag)
                <option @selected($tagsIds->contains($tag->id)) value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
        </select>
        @error("tags")
        {{ $message }}
        @enderror
    </div>
    <button class="btn btn-primary">
        @if($post->id)
            Modifier
        @else
            Créer
        @endif
    </button>
</form>