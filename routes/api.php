<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\UserController;



Route::prefix('v1')->group(function () {
    Route::prefix('basket')->group(function () {
    Route::get('/', [BasketController::class, 'index']);
    Route::post('/', [BasketController::class, 'store']);
    Route::put('/{productArticul}', [BasketController::class, 'update']);
    Route::delete('/{productArticul}', [BasketController::class, 'destroy']);
    Route::delete('/clear', [BasketController::class, 'clear']);
});
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::apiResource('users', UserController::class);
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/user', [AuthController::class, 'user']);
    
    });
    Route::apiResource('products', ProductController::class);
});