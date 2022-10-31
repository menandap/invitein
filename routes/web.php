<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// LOGIN
Route::get('/login', function () {
    return view('pages.login');
});
Route::post('/actLogin', [LoginController::class, 'actLogin']);

Route::get('/register', function () {
    return view('pages.register');
});
Route::post('/actRegister', [RegisterController::class, 'actRegister']);

// HOME
Route::get('/', function () {
    return view('home.index');
});

// DASHBOARD
Route::get('/home', function () {
    return "sukses login, masih tahap maintenance";
});
Route::get('/mydashboard', function () {
    return view('dashboard-usr.index');
});


// UNDANGAN
Route::get('/view-undangan', function () {
    return view('undangan.template-1');
});