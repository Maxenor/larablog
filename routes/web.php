<?php

use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
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

Route::get('posts/{post:slug}', [PostsController::class, 'show'])->name('post');

Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'storeComment'])->name('comment.store');

Route::get('admin/posts/create', [PostsController::class, 'create'])->middleware('admin')->name('post.create');
Route::post('admin/posts', [PostsController::class, 'store'])->middleware('admin')->name('post.store');

Route::post('newsletter', NewsletterController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
