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

    Route::get('/available', function () {
        return view('user.home');
    });

    Route::get('/unavailable', function () {
        return view('user.unavailable');
    });

    Route::get('/menu', function () {
        return view('user.menu');
    });
});

Route::middleware('auth:admin')->group(function () {
    Route::get('/dashboard', [
        OrderController::class, 
        'dashboardIndex'
    ])->name('dashboard');

    Route::get('/updatepayment', [
        OrderController::class, 
        'updatePaymentIndex'
    ])->name('updatepayment');

    Route::get('/kategori', [
        CategoryController::class, 
        'index'
    ])->name('category');

    Route::post('/kategori/tambah', [
        CategoryController::class,
        'store'
    ])->name('category.store');

    Route::put('/kategori/{category}', [
        CategoryController::class,
        'update'
    ])->name('category.update');

    Route::delete('/kategori/{category}', [
        CategoryController::class,
        'destroy'
    ])->name('category.destroy');

    Route::get('/produk', [
        ProductController::class, 
        'index'
    ])->name('product');

    Route::post('/produk/tambah', [
        ProductController::class, 
        'store'
    ])->name('product.store');
    
    Route::put('/produk/{product}', [
        ProductController::class,
        'update'
    ])->name('product.update');

    Route::delete('/produk/{product}', [
        ProductController::class, 
        'destroy'
    ])->name('product.destroy');

    Route::get('/pesanan', [
        OrderController::class, 
        'orderIndex'
    ])->name('order');

    Route::put('/admin/order/{order}/status', [
        OrderController::class, 
        'update'
    ])->name('order.update');

    Route::get('/profil', [
        AdminController::class, 
        'index'
    ])->name('profile');

    Route::put('/profil/update', [
        AdminController::class,
        'updateProfile'
    ])->name('profile.update');
    
    Route::put('/profil/password', [
        AdminController::class,
        'updatePassword'
    ])->name('profile.password');

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