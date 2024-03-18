<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('login', 'App\Http\Controllers\AuthController@login');
Route::middleware('auth:api')->group(function () {

    Route::apiResource('produk', 'App\Http\Controllers\ProdukController');
    Route::apiResource('user', 'App\Http\Controllers\UserController')->middleware(['role:admin']);
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
});
