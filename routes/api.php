<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::apiResource('posts', PostController::class);
Route::apiResource('comments', CommentController::class);

Route::post('register', [AuthController::class, 'register']);
Route::post('create-token', [AuthController::class, 'createToken']);
Route::post('invalidate-tokens', [AuthController::class, 'invalidateTokens']);