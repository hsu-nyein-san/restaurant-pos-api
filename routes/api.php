<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\RestaurantTableController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(AuthController::class)->group(function() {
    Route::post('/register','register');
    Route::get('/login','login');
});

Route::apiResource('categories',CategoryController::class);
Route::apiResource('products',ProductController::class);
Route::apiResource('restaurant-tables',RestaurantTableController::class);
