<?php

use App\Http\Controllers\UsersController;
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


Route::post('/create_user',[UsersController::class, 'createUser']);
Route::post('/create_post/{user_id}',[UsersController::class, 'createPost']);
Route::post('/write_comment/{user_id}/{post_id}',[UsersController::class, 'writeComment']);
Route::get('/get_posts/{user_id}', [UsersController::class, 'getPosts']);
Route::get('/get_comments/{user_id}/{post_id}', [UsersController::class, 'getComments']);
Route::get('/get_users', [UsersController::class, 'getUsers']);
