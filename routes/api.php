<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('users',\App\Http\Controllers\UserController::class);
Route::get('user/{userId}/transactions/sent',[\App\Http\Controllers\UserController::class,'sentTransactions']);
Route::get('user/{userId}/transactions/receive',[\App\Http\Controllers\UserController::class,'receivedTransactions']);
Route::get('user/{id}/getuserdata',[\App\Http\Controllers\UserController::class,'getUsersData']);
Route::delete('user/{user}',[\App\Http\Controllers\UserController::class,'delete']);

Route::apiResource('transactions',\App\Http\Controllers\TransactionsController::class);
Route::post('transactions/{id}',[\App\Http\Controllers\TransactionsController::class,'delete']);
