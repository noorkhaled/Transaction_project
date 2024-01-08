<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('users', UserController::class);
Route::get('users/{id}/getuserdata',[UserController::class,'getUsersData']);
Route::delete('users/{user}',[UserController::class,'delete']);
Route::put('users/{user}',[UserController::class,'update']);

Route::apiResource('transactions', TransactionsController::class);
Route::delete('transactions/{transaction}',[TransactionsController::class,'delete']);
Route::put('transactions/{transaction}',[TransactionsController::class,'update']);
Route::get('users/{userId}/transactions/sent',[\App\Services\TransactionService::class,'sentTransactions']);
Route::get('users/{userId}/transactions/receive',[\App\Services\TransactionService::class,'receivedTransactions']);

Route::apiResource('orders', OrderController::class);
Route::post('orders/{order_id}/users/{user_id}/{user_type}',[OrderController::class,'ShowUserOrders']);
Route::get('users/{userId}/orders', [UserController::class, 'getUserOrders']);

