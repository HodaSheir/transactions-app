<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\PaymentsController;
use App\Http\Controllers\Api\TransactionsController;
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

Route::post('login', [LoginController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::resource('transaction', TransactionsController::class)->only('store','index');
    Route::resource('payment', PaymentsController::class)->only('store');
});
