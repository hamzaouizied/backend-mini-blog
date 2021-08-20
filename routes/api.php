<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

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


Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::get('/all-posts', [PostController::class, 'getAllPosts']);
Route::post('/post', [PostController::class, 'getPost']);
Route::post('/add/comment', [PostController::class, 'addComment']);
Route::post('/add/post', [PostController::class, 'addPost']);
Route::post('/delete/comment', [PostController::class, 'deleteComment']);
Route::post('/delete/post', [PostController::class, 'deletePost']);


