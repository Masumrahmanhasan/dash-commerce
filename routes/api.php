<?php

use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\OrderHighController;
use App\Http\Controllers\API\OrderLowController;
use App\Http\Controllers\API\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group(['prefix' => 'auth'], function () {
   Route::post('register', RegisterController::class);
   Route::post('login', LoginController::class);
});

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::apiResource('/products', ProductController::class);

    Route::get('/orders-test1', OrderHighController::class);
    Route::get('/orders-test2', OrderLowController::class);
});