<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IngredientController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::prefix('api/v1/')->withoutMiddleware(VerifyCsrfToken::class)->group(function () {
    Route::apiResource('category', CategoryController::class);
    Route::apiResource('ingredient', IngredientController::class);
});
