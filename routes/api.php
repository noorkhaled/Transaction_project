<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('users',\App\Http\Controllers\UserController::class);
Route::get('users/{id}/getuserdata',[\App\Http\Controllers\UserController::class,'getUsersData']);
Route::delete('users/{user}',[\App\Http\Controllers\UserController::class,'delete']);
Route::put('users/{user}',[\App\Http\Controllers\UserController::class,'update']);

Route::apiResource('transactions',\App\Http\Controllers\TransactionsController::class);
Route::delete('transactions/{transaction}',[\App\Http\Controllers\TransactionsController::class,'delete']);
Route::put('transactions/{transaction}',[\App\Http\Controllers\TransactionsController::class,'update']);
Route::get('users/{userId}/transactions/sent',[\App\Services\TransactionService::class,'sentTransactions']);
Route::get('users/{userId}/transactions/receive',[\App\Services\TransactionService::class,'receivedTransactions']);

Route::apiResource('orders',\App\Http\Controllers\OrderController::class);
Route::post('orders/{order_id}/users/{user_id}/{user_type}',[\App\Http\Controllers\OrderController::class,'ShowUserOrders']);
Route::get('users/{userId}/orders', [\App\Http\Controllers\UserController::class, 'getUserOrders']);

