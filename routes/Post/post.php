<?php

use Application\Posts\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
    Route::controller(PostController::class)->group(function () {
        // Creating a new post
        Route::post('/createPost', 'store')->name('createPost');
        // Create post page
        Route::get('/createPostPage', 'create')->name('createPostPage');
        // Toggle the like button
        Route::post('/posts/{id}', 'toggle')->name('posts.toggle');
    });

    Route::resource('posts', postController::class);

    // // Creating a new post
    // Route::post('/createPost', [PostController::class, 'store'])->name('createPost');
    // // Create post page
    // Route::get('/createPostPage', [PostController::class, 'create'])->name('createPostPage');

    // Route::post('/posts/{id}', [PostController::class, 'toggle'])->name('posts.toggle');
    // Route::resource('posts', postController::class);
});

//Route::get('/posts', [PostController::class, 'index']);
