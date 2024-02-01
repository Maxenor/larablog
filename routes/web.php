<?php

use App\Http\Controllers\PostsController;
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

Route::get('/', [PostsController::class, 'index'])->name('home');

// find the post where the post's id is the id passed and load the view
Route::get('posts/{post:slug}', [PostsController::class, 'show'])->name('post');

//Route::get('author/{author:username}', function (User $author) {
//    return view('posts', ['posts' => $author->posts]);
//});
