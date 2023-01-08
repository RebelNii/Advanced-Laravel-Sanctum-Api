<?php

use App\Http\Controllers\V1\CommentController;
use Illuminate\Support\Facades\Route;



Route::controller(CommentController::class)->group(function(){
    Route::get('/comments', 'index');
});