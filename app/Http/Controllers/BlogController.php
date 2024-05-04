<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\BlogFilterRequest;
use App\Http\Requests\FormPostRequest;
use Illuminate\Support\Facades\Validator;



class BlogController extends Controller
{
    public function index(): View {

        //dd($request->validated());
        return view('blog.index',[
            'posts' => Post::paginate(1)
        ]);
    }

    public function store(FormPostRequest $request) {
        $post = Post::create($request->validated());
        return redirect()
            ->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])
            ->with('success', "L'article a bien été sauvegardé");
        //dd($request->all());
    }

    public function edit(Post $post) {
        return view('blog.edit', [
            'post' => $post
        ]);
    }

    public function update(Post $post, FormPostRequest $request) {
        $post->update($request->validated());
        return redirect()
            ->route('blog.show', ['slug' => $post->slug, 'post' => $post->id])
            ->with('success', "L'article a bien été modifié");
    }

    public function create() {
        //dd(session()->all());
        $post = new Post();
        return view('blog.create', [
            'post' => $post
        ]);
    }
    
    public function show(string $slug, Post $post): RedirectResponse | View {

        //dd($post);
        
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
}
