<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartsController;
use App\Http\Controllers\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/auth/login',[AuthController::class,'login'])->middleware('throttle:20,1');

Route::middleware('auth:sanctum','throttle:20,1')->group(function () {
    Route::resource('/products',ProductsController::class );
});

Route::middleware(['guest.sanctum','throttle:20,1'])->group(function () {
    Route::resource('/carts',CartsController::class );
});


