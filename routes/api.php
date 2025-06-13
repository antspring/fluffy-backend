<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\ResourceRoleMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('/v1/')->group(function () {

    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });

        Route::middleware(ResourceRoleMiddleware::class)->group(function () {
            Route::apiResource('ingredient', IngredientController::class)->only(['store', 'update', 'destroy']);
            Route::apiResource('product', ProductController::class)->only(['store', 'update', 'destroy']);
            Route::apiResource('category', CategoryController::class)->only(['store', 'update', 'destroy']);
        });

        Route::middleware('role:admin')->group(function () {
            Route::post('register-employee', [EmployeeController::class, 'register']);
        });

        Route::post('order', [OrderController::class, 'store']);
        Route::patch('order-cancel/{order}', [OrderController::class, 'cancelOrder'])->can('update', 'order');
        Route::patch('order-complete/{order}', [OrderController::class, 'completeOrder'])->middleware('role:admin|employee');
        Route::get('user-orders', [OrderController::class, 'userOrders']);
        Route::get('order', [OrderController::class, 'index'])->middleware('role:admin|employee');
        Route::get('order/{order}', [OrderController::class, 'show'])->middleware('role:admin|employee');
    });

    Route::apiResource('ingredient', IngredientController::class)->only(['index', 'show']);
    Route::apiResource('product', ProductController::class)->only(['index', 'show']);
    Route::apiResource('category', CategoryController::class)->only(['index', 'show']);

    Route::post('send-code', [AuthController::class, 'sendCode']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::post('login-employee', [EmployeeController::class, 'login']);
});
