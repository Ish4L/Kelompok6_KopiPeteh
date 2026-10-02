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

    Route::get('/profil', function () {
        return view('admin.profile');
    })->name('profile');

    Route::get('/kategori', function () {
        return view('admin.category');
    })->name('category');

    Route::get('/produk', function () {
        return view('admin.product');
    })->name('product');

    Route::get('/riwayat', function () {
        return view('admin.history');
    })->name('history');

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