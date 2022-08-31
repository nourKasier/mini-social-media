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

Route::get('/posts', [PostController::class, 'create']);

// Creating a new post
Route::post('/createPost', [PostController::class, 'store'])->name('createPost');
// Create post page
Route::get('/createPostPage', function () {
    return view('user.createPost');
})->middleware(['auth'])->name('createPostPage');

Route::get('/likePost/{postId?}', [ReactionController::class, 'likePost'])->name('likePost');
Route::get('/unlikePost/{postId?}', [ReactionController::class, 'unlikePost'])->name('unlikePost');

Route::get('/posts/{postId}/comments', [CommentController::class, 'create'])->name('comments');

Route::get('ajax-request', [ReactionController::class, 'create']);
Route::post('ajax-request', [ReactionController::class, 'likePost']);
//Route::post('ajax-request', [AjaxController::class, 'store']);
