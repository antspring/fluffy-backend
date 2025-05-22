<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('/v1/')->group(function () {
    Route::apiResource('category', CategoryController::class);
    Route::apiResource('ingredient', IngredientController::class);
    Route::apiResource('product', ProductController::class);

    Route::post('send-code', [AuthController::class, 'sendCode']);

    Route::post('register', [AuthController::class, 'register']);
});
