<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryConroller;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VideoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('products', ProductController::class);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/categories', [CategoryConroller::class, 'index']);

Route::get('/videos', [VideoController::class, 'list']);
