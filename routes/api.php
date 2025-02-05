<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CustomerController as ApiCustomerController;
use App\Http\Controllers\Api\DashboardController as ApiDashboardController;
use App\Http\Controllers\Api\MenuController as ApiMenuController;
use App\Http\Controllers\Api\TransactionController as ApiTransactionController;
use App\Http\Controllers\Api\UserController as ApiUserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('/dashboard', [ApiDashboardController::class, 'index']);
});
// Route::get('/dashboard', [ApiDashboardController::class, 'index']);

Route::apiResource('customer', ApiCustomerController::class);

Route::apiResource('menu', ApiMenuController::class);
Route::apiResource('transaction', ApiTransactionController::class);
Route::apiResource('user', ApiUserController::class);

// Route::middleware('auth:api')->get('/user', [ApiUserController::class, 'index']);


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
