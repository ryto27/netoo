<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductApiController;

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

Route::get('/dashboard/products', [ProductApiController::class, 'index']);
Route::post('/dashboard/products', [ProductApiController::class, 'store']);
Route::get('/dashboard/products/{id}/edit', [ProductApiController::class, 'edit']);
Route::get('/dashboard/products/{id}', [ProductApiController::class, 'show']);
Route::put('/dashboard/products/{id}', [ProductApiController::class, 'update']);
Route::delete('/dashboard/products/{id}', [ProductApiController::class, 'destroy']);



