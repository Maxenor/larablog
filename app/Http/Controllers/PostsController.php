<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostsController extends Controller
{
    public function index()
    {
        return view('posts.index',
            [
                'posts' => Post::latest()->SearchFilter(request(['search', 'category', 'author']))->get(),

            ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }
}
