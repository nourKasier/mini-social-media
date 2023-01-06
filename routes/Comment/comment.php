<?php

use Application\Comments\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
    Route::controller(CommentController::class)->group(function () {
        Route::get('/posts/{postId}/comments', 'create')->name('comments');
        Route::post('/posts/{postId}/comments', 'store')->name('newComment');

        Route::get('/posts/{postId}/comments/{commentId}', 'showReplies')->name('showReplies');
        Route::post('/posts/{postId}/comments/{commentId}', 'storeReply')->name('newCommentReply');
    });
    // Route::get('/posts/{postId}/comments', [CommentController::class, 'create'])->name('comments');
    // Route::post('/posts/{postId}/comments', [CommentController::class, 'store'])->name('newComment');

    // Route::get('/posts/{postId}/comments/{commentId}', [CommentController::class, 'showReplies'])->name('showReplies');
    // Route::post('/posts/{postId}/comments/{commentId}', [CommentController::class, 'storeReply'])->name('newCommentReply');
});
