<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\isAdmin;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/register/province', [RegisterController::class, 'province'])->name('register.province');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/product', [ProductController::class, 'index'])->middleware(isAdmin::class)->name('product.index');
