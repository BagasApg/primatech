<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\isAdmin;

Route::get('/', function () {
    return redirect()->route('product.index');
});


Route::post('/register/store', [RegisterController::class, 'store'])->name('register.store');
Route::post('/register/province', [RegisterController::class, 'province'])->name('register.province');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/products', [ProductController::class, 'index'])->middleware('auth')->name('product.index');

// Cart
Route::get('/cart', [CartController::class, 'index'])->middleware('auth')->name("cart.index");
Route::post('/cart', [CartController::class, 'addToCart'])->middleware('auth')->name("cart.addToCart");

// Order
Route::get('/order', [OrderController::class, 'index'])->middleware('auth')->name("order.index");
Route::post('/order', [OrderController::class, 'store'])->middleware('auth')->name("order.store");

// Invoice
Route::get('/invoice/{id}', [InvoiceController::class, 'index'])->middleware('auth')->name('invoice.index');

// Admin
// Product
Route::post('/admin/product', [ProductController::class, 'store'])->middleware(['auth', 'admin'])->name('admin.product.store');
Route::put('/admin/product', [ProductController::class, 'update'])->middleware(['auth', 'admin'])->name('admin.product.update');
Route::delete('/admin/product', [ProductController::class, 'delete'])->middleware(['auth', 'admin'])->name('admin.product.delete');

// Category 
Route::post('/admin/category', [ProductController::class, 'store'])->middleware(['auth', 'admin'])->name('admin.product.store');
Route::put('/admin/product', [ProductController::class, 'update'])->middleware(['auth', 'admin'])->name('admin.product.update');
Route::delete('/admin/product', [ProductController::class, 'delete'])->middleware(['auth', 'admin'])->name('admin.product.delete');
