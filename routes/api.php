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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/transactions',[\App\Http\Controllers\TransactionsController::class,'store']);
Route::put('/transactions_update/{id}',[\App\Http\Controllers\TransactionsController::class,'update']);
Route::delete('/transactions_delete/{id}',[\App\Http\Controllers\TransactionsController::class,'destroy']);

Route::post('/users',[\App\Http\Controllers\UserController::class,'store']);
Route::put('/users_update/{id}',[\App\Http\Controllers\UserController::class,'update']);
Route::delete('/users_delete/{id}',[\App\Http\Controllers\UserController::class,'destroy']);
