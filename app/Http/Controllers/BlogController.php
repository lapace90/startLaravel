<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogFilterRequest;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;



class BlogController extends Controller
{
    public function index(): View {

        //dd($request->validated());
        return view('blog.index',[
            'posts' => Post::paginate(1)
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
