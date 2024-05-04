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
        @error("title")
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
    <button class="btn btn-primary">
        @if($post->id)
            Modifier
        @else
            Créer
        @endif
    </button>
</form>