<?php

use App\Http\Controllers\V1\UserController;
use Illuminate\Support\Facades\Route;



Route::controller(UserController::class)->group(function(){
    Route::get('/users', 'index');
    Route::get('/user/{user}', 'show');
    Route::post('/user','store');
    Route::put('/user/{user}', 'update');
    Route::delete('/user/{user}', 'destroy');
});