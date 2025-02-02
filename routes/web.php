<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Models\Transaction;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('menu', MenuController::class);

    Route::get('/menu/{id}/view', [MenuController::class, 'view'])->name('menu.view');

    Route::resource('user', UserController::class);

    Route::resource('transaction', TransactionController::class);
    Route::resource('customer', CustomerController::class);
    Route::resource('payment', PaymentController::class);
    
    Route::get('/payment/{id}/view', [PaymentController::class, 'view']);
});

Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

// require __DIR__.'/auth.php';
