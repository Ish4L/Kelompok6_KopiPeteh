<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth:admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Route::get('/ishal', function () {
//     return view('hi lol');
// });

// Route::get('/fatih', function () {
//     return view('hi fatih');
// });

// Route::get('/erlyn', function () {
//     return view('welcome');
// });

// Route::get('/alsa', function () {
//     return view('welcome');
// });