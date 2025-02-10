<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CustomerController as ApiCustomerController;
use App\Http\Controllers\Api\DashboardController as ApiDashboardController;
use App\Http\Controllers\Api\MenuController as ApiMenuController;
use App\Http\Controllers\Api\PaymentController as ApiPaymentController;
use App\Http\Controllers\Api\TransactionController as ApiTransactionController;
use App\Http\Controllers\Api\UserController as ApiUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);

Route::middleware('web')->group(function () {

    Route::post('/login', [AuthController::class, 'login']);

    Route::post('/logout', [AuthController::class, 'logout']);
});


Route::get('/dashboard',  [ApiDashboardController::class, 'index']);
Route::apiResource('customer', ApiCustomerController::class);

Route::apiResource('menu', ApiMenuController::class);
Route::apiResource('transaction', ApiTransactionController::class);

Route::apiResource('user', ApiUserController::class);

Route::post('/logout', [AuthController::class, 'logout']);

Route::apiResource('customer', ApiCustomerController::class);

Route::apiResource('menu', ApiMenuController::class);
Route::apiResource('transaction', ApiTransactionController::class);

Route::apiResource('payment', ApiPaymentController::class);