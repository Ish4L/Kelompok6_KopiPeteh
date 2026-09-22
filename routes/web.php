<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ishal', function () {
    return view('hi lol');
});

Route::get('/fatih', function () {
    return view('hi fatih');
});

Route::get('/erlyn', function () {
    return view('welcome');
});
