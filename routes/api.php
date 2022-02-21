<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);
Route::get('/posts',[PostController::class, 'index'])->middleware('api');
Route::post('/posts',[PostController::class, 'store']);
Route::put('/posts/{post}',[PostController::class , 'update']);
Route::get('/posts/{post}',[ PostController::class,'show']);
Route::delete('/posts/{post}',[PostController::class, 'destroy']);
Route::post('/logout',[PostController::class, 'logout']);
