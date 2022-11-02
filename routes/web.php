<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\UserDashboardController;

// AUTH
Route::view('/login', 'auth.login')->name('login'); 
Route::post('/actLogin', [UserAuthController::class, 'actLogin']);
Route::view('/register', 'auth.register')->name('register'); 
Route::post('/actRegister', [UserAuthController::class, 'actRegister']);
Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout');

// HOME
Route::view('/', 'home.index')->name('home'); 

// DASHBOARD
Route::view('/mydashboard', 'dashboard-usr.index')->name('dashboard'); 
Route::get('/myundangan', [UserDashboardController::class, 'undangan']);

// UNDANGAN
Route::view('/view-undangan', 'undangan.template-1')->name('view-undangan'); 