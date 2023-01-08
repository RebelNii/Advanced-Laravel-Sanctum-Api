<?php

use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Route;

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

Route::get('/play', function(){
    return (new WelcomeMail())->render();
});

Route::post('/forgot-password/{token}', function($token){
    return $token;
})
                ->middleware(['guest:'.config('fortify.guard')])
                ->name('password.reset');
