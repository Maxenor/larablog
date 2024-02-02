<?php

use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostsController::class, 'index'])->name('home');

// find the post where the post's id is the id passed and load the view
Route::get('posts/{post:slug}', [PostsController::class, 'show'])->name('post');
