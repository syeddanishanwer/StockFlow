<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;

// Guest Routes (Publicly Accessible)
Route::get('/', function () {
    return view('welcome');
})->name('login');

Route::post('/loginmatch', [AuthController::class, 'match'])->name('login.match');


// Protected Dashboard Routes (Requires Login)
Route::middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Stock / Inventory Management
    Route::get('/view-stock', [StockController::class, 'index'])->name('viewstock');
    Route::get('/add-stock', [StockController::class, 'create'])->name('addstock');
    Route::post('/add-stock', [StockController::class, 'store'])->name('addstock.save');

    // User Management
    Route::get('/view-users', [UserController::class, 'index'])->name('viewusers');
    Route::get('/add-user', [UserController::class, 'create'])->name('addusers');
    Route::post('/add-user', [UserController::class, 'store'])->name('adduser.save');

    // Supplier Management Architecture
    Route::get('/view-suppliers', [SupplierController::class, 'index'])->name('viewsuppliers');
    Route::get('/add-supplier', [SupplierController::class, 'create'])->name('addsupplier');
    Route::post('/add-supplier', [SupplierController::class, 'store'])->name('addsupplier.save');

    // Authentication Termination
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    })->name('logout');
});