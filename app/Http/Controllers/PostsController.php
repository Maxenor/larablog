<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Str;

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
            'thumbnail' => 'required|image',
            'excerpt' => 'required',
            'body' => 'required',
            'category_id' => ['required', 'exists:categories,id']
        ]);

        // generate slug from title
        $attributes['slug'] = Str::slug(request('title'));
        $attributes['user_id'] = auth()->id();
        $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');

        Post::create($attributes);

        return redirect('/');
    }

    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }
}
