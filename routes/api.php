<?php

use App\Helpers\Routes\RoutesHelper;
use App\Http\Controllers\V1\CommentController;
use App\Http\Controllers\V1\PostController;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->prefix('v1')->group(function(){
    
    RoutesHelper::includeRouteFiles( __DIR__ . '/v1');


    // require __DIR__ . '/v1/posts_api/posts_api.php';
    // require __DIR__ . '/v1/users_api/users_api.php';
    // require __DIR__ . '/v1/comments_api/comments_api.php';
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


