<?php

// namespace routes\v1\posts_api;

use App\Http\Controllers\V1\PostController;
use Illuminate\Support\Facades\Route;

Route::controller(PostController::class)->group(function(){
    Route::get('/posts','index');
    Route::get('/posts/{post}','show');
    Route::post('/post', 'store');
    Route::put('/post/{post}', 'update');
    Route::delete('/post/{post}', 'delete');
});