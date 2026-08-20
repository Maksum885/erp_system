<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Semua user yang sudah login
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Hanya Admin
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class);
    });

    // Admin + Account Manager
    Route::middleware('role:admin,account_manager')->group(function () {
        Route::resource('pipeline', SalesPipelineController::class);
        Route::resource('customers', CustomerController::class);
    });

    // Admin + Finance
    Route::middleware('role:admin,finance')->group(function () {
        Route::resource('rs-format', RsFormatController::class);
        Route::resource('rs-person', RsPersonController::class);
    });

    // Admin + AM + Purchasing (untuk Work Order)
    Route::middleware('role:admin,account_manager,purchasing')->group(function () {
        Route::resource('work-orders', WorkOrderController::class);
    });
});

require __DIR__ . '/auth.php';
