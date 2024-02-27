<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostsController extends Controller
{
    public function index()
    {
        return view('posts.index',
            [
                // withQueryString() is used to keep the query string in the pagination links
                'posts' => Post::latest()->SearchFilter(request([
                    'search', 'category', 'author'
                ]))->paginate(6)->withQueryString()

            ]);
    }

    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    public function store()
    {
        $attributes = request()->validate([
            'title' => 'required',
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', 'exists:categories,id']
        ]);

        $attributes['user_id'] = auth()->id();

        Post::create($attributes);

        return redirect('/');
    }

    public function create()
    {
        return view('posts.create');
    }
}
