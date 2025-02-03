<?php

use App\Http\Controllers\GetProductsNearbyToExpireController;
use App\Http\Controllers\GetProductsNearbyToExpireWithCacheController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/get-products-nearby-to-expire', GetProductsNearbyToExpireController::class);
Route::get('/with-cache/get-products-nearby-to-expire', GetProductsNearbyToExpireWithCacheController::class);
