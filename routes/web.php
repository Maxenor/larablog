<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('posts', ['posts' => Post::latest()->get(), 'categories' => Category::all()]);
})->name('home');

// find the post where the post's id is the id passed and load the view
Route::get('posts/{post:slug}', function (Post $post) {
    return view('post', ['post' => $post]);
});
// find the posts with the categories corresponding to the slug, load is eager loading on existing model
Route::get('categories/{category:name}', function (Category $category) {
    return view('posts',
        ['posts' => $category->posts, 'categories' => Category::all(), 'currentCategory' => $category]);
})->name('category');

Route::get('author/{author:username}', function (User $author) {
    return view('posts', ['posts' => $author->posts, 'categories' => Category::all()]);
});
