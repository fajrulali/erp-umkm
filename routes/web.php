<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Tenant\TenantDashboardController; 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', function () {
    return redirect('/login');
});

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);


// Cek role dan status login
Route::middleware('auth')->group(function () {

    // Admin Routes
    Route::middleware('canAccess:admin')->group(function(){
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/dashboard', [AdminDashboardController::    class, 'index'])->name('dashboard');
            // Tambahkan rute lainnya untuk admin
        });
    });

    Route::middleware('canAccess:tenant')->group(function(){
    // Tenant Routes
        Route::prefix('tenant')->name('tenant.')->group(function () {
            Route::get('/dashboard', [TenantDashboardController::class, 'index'])->name('dashboard');
            // Tambahkan rute lainnya untuk tenant
        });
    });

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});