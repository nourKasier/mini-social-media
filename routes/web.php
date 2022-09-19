<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['middleware' => 'auth'], function () {

    // Creating a new post
    Route::post('/createPost', [PostController::class, 'store'])->name('createPost');
    // Create post page
    Route::get('/createPostPage', [PostController::class, 'create'])->name('createPostPage');

    Route::post('/posts/{id}', [PostController::class, 'toggle'])->name('posts.toggle');

    Route::get('/posts/{postId}/comments', [CommentController::class, 'create'])->name('comments');
    Route::post('/posts/{postId}/comments', [CommentController::class, 'store'])->name('newComment');

    Route::get('/posts/{postId}/comments/{commentId}', [CommentController::class, 'showReplies'])->name('showReplies');
    Route::post('/posts/{postId}/comments/{commentId}', [CommentController::class, 'storeReply'])->name('newCommentReply');

    Route::resource('posts', postController::class);
});

Route::get('/posts', [PostController::class, 'index']);

