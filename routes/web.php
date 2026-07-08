<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;

Route::get('/', function () {
    return view('welcome');
})->name('login');


Route::get('/signup', function () {
    return view('signup');})->name('signup');

Route::get('/loginmatch',[authController::class,'match']) ->name('login.match');
