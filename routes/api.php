<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\PostIndexController;


Route::post('/register', RegisterController::class);

Route::post('/login', LoginController::class);

Route::get('/posts', PostIndexController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return new UserResource($request->user());
    });

    Route::get('/posts/mine', \App\Http\Controllers\Api\MinePostIndexController::class);

    Route::post('/logout', LogoutController::class);

    Route::post('/posts', PostController::class);
});

