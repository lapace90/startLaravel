<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\BlogFilterRequest;
use App\Http\Requests\FormPostRequest;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Validator;



class BlogController extends Controller
{
    public function index(Request $request): View {
        $categories = Category::select('id', 'name')->get();
        $tags = Tag::select('id', 'name')->get();

        // Estrarre i parametri del filtro dalla richiesta
        $categoryId = $request->input('category_id');
        $tagIds = $request->input('tag_ids');

        // Costruire la query per i post
        $query = Post::query();

        // Applicare i filtri se sono stati forniti
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }
        if ($tagIds) {
            $query->whereHas('tags', function ($query) use ($tagIds) {
                $query->whereIn('id', $tagIds);
            });
        }

        // Eseguire la query e ottenere i post paginati
        $posts = $query->with('category', 'tags')->paginate(10);
        
        return view('blog.index',[
            'posts' => $posts,
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    public function create() {
        $post = new Post();
        //$category->posts()->paginate(12);
        return view('blog.create', [
            'post' => $post,
            'categories' => Category::select('id', 'name')->get(),
            'tags'=> Tag::select('id', 'name')->get()
        ]);
    }
    
    public function show(string $slug, Post $post): RedirectResponse | View {
        
        if ($post->slug !== $slug) {
            return to_route('blog.show', [
                'slug' => $post->slug, 
                'id'=> $post->id
            ]);
        }
        return view('blog.show', [
            'post' =>$post
        ]);
    }

    public function store(FormPostRequest $request) {
        $post = Post::create($request->validated());
        $post->tags()->sync($request->validated('tags'));
        return redirect()
            ->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])
            ->with('success', "L'article a bien été sauvegardé");
        //dd($request->all());
    }

    public function edit(Post $post) {
        return view('blog.edit', [
            'post' => $post,
            'categories' => Category::select('id', 'name')->get(),
            'tags'=> Tag::select('id', 'name')->get()
        ]);
    }

    public function update(Post $post, FormPostRequest $request) {
        $post->update($request->validated());
        $post->tags()->sync($request->validated('tags'));
        return redirect()
            ->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])
            ->with('success', "L'article a bien été modifié");
    }

}
