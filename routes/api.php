<?php

use App\Http\Controllers\UsersController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/create_user',[UsersController::class, 'createUser']);
Route::post('/create_post/{user_id}',[UsersController::class, 'createPost']);
Route::post('/writeComment/{user_id}/{post_id}',[UsersController::class, 'writeComment']);
Route::get('/get_posts/{user_id}', [UsersController::class, 'getPosts']);
Route::get('/get_comments/{user_id}/{post_id}', [UsersController::class, 'getComments']);
