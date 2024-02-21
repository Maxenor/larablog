<?php

use App\Http\Controllers\PostCommentsController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use MailchimpMarketing\ApiClient;

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


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('posts/{post:slug}/comments', [PostCommentsController::class, 'storeComment'])->name('comment.store');
Route::get('ping', function () {
    $mailchimp = new ApiClient();

    $mailchimp->setConfig([
        'apiKey' => config('services.mailchimp.key'),
        'server' => 'us10'
    ]);

    $response = $mailchimp->lists->getListMembersInfo('2b858505db');
    dd($response);
});

Route::post('newsletter', function () {
    request()->validate([
        'email' => 'required|email'
    ]);
    $mailchimp = new ApiClient();

    $mailchimp->setConfig([
        'apiKey' => config('services.mailchimp.key'),
        'server' => 'us10'
    ]);

    try {
        $response = $mailchimp->lists->addListMember('2b858505db', [
            'email_address' => request('email'),
            'status' => 'subscribed'
        ]);
    } catch (Exception $e) {
        throw ValidationException::withMessages(['failure' => 'This email could not be added to our newsletter list.']);
    }

    return redirect('/#newsletter')->with('success', 'You are now signed up for our newsletter!');
})->name('newsletter');


require __DIR__.'/auth.php';
