<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;


// Login page (GET)
Route::get('/', function () {
    return view('welcome');
})->name('login');

// Login form submission (POST)
Route::post('/loginmatch', [AuthController::class, 'match'])->name('login.match');

// Dashboard (GET) – safe to refresh
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::get('/view-stock', [StockController::class, 'index'])->name('viewstock')->middleware('auth');
Route::get('/add-stock', [StockController::class, 'create'])->name('addstock')->middleware('auth');
Route::post('/add-stock', [StockController::class, 'store'])->middleware('auth');

Route::get('/view-users', [UserController::class, 'index'])->name('viewusers')->middleware('auth');
Route::get('/add-user', [UserController::class, 'create'])->name('addusers')->middleware('auth');
Route::post('/add-user', [UserController::class, 'store'])->middleware('auth');

// For a custom logout
Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout')->middleware('auth');
