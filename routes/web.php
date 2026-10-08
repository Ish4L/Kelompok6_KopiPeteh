<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [
        AuthController::class, 
        'loginForm'
    ])->name('login');

    Route::post('/login', [
        AuthController::class, 
        'login'
    ]);
});

Route::middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [
        OrderController::class, 
        'dashboardIndex'
    ])->name('dashboard');

    Route::get('/profil', [
        AdminController::class, 
        'index'
    ])->name('profile');

    Route::get('/kategori', [
        CategoryController::class, 
        'index'
    ])->name('category');

    Route::get('/produk', [
        ProductController::class, 
        'index'
    ])->name('product');

    Route::get('/riwayat', [
        OrderController::class, 
        'historyIndex'
        ])->name('history');

    Route::get('/logout', [
        AuthController::class, 
        'logout'
    ])->name('logout');
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