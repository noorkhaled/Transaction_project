<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $transactions = new \App\Http\Controllers\TransactionsController();
    $users = new \App\Http\Controllers\UserController();
    $user = new \App\Models\Transactions();
    dd($user);
    return view('welcome');
});
