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
}
