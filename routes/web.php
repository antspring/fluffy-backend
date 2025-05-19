<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::apiResource('category', CategoryController::class)->withoutMiddleware(VerifyCsrfToken::class);
