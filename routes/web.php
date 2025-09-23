<?php

use App\Models\Category;
use App\Http\Middleware\isAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\GuestbookController;
use App\Models\Guestbook;

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
Route::delete('/cart/{id}', [CartController::class, 'removeItem'])->middleware('auth')->name('cart.removeItem');
Route::post('/cart/update', [CartController::class, 'updateQty'])->middleware('auth')->name('cart.update');

// Order
Route::get('/order', [OrderController::class, 'index'])->middleware('auth')->name("order.index");
Route::post('/order', [OrderController::class, 'store'])->middleware('auth')->name("order.store");

// Invoice
Route::get('/invoice/{id}', [InvoiceController::class, 'index'])->middleware('auth')->name('invoice.index');

// Admin

Route::get('/admin', function () {
    return view('admin.index');
})->middleware(['auth', 'admin'])->name('admin.index');

// Product
Route::get('/admin/products', [ProductController::class, 'admin'])->middleware(['auth', 'admin'])->name('admin.product.index');


Route::get('/admin/products/create', [ProductController::class, 'create'])->middleware(['auth', 'admin'])->name('admin.product.create');
Route::post('/admin/products', [ProductController::class, 'store'])->middleware(['auth', 'admin'])->name('admin.product.store');

Route::get('/admin/products/{product:id}', [ProductController::class, 'show'])->middleware(['auth', 'admin'])->name('admin.product.show');

Route::get('/admin/products/{id}/edit', [ProductController::class, 'edit'])->middleware(['auth', 'admin'])->name('admin.product.edit');
Route::put('/admin/products/{id}/edit', [ProductController::class, 'update'])->middleware(['auth', 'admin'])->name('admin.product.update');

Route::delete('/admin/products/{id}', [ProductController::class, 'destroy'])->middleware(['auth', 'admin'])->name('admin.product.delete');

// Category
Route::get('/admin/categories', [CategoryController::class, 'admin'])->middleware(['auth', 'admin'])->name('admin.category.index');

Route::get('/admin/categories/create', [CategoryController::class, 'create'])->middleware(['auth', 'admin'])->name('admin.category.create');
Route::post('/admin/categories', [CategoryController::class, 'store'])->middleware(['auth', 'admin'])->name('admin.category.store');

Route::get('/admin/categories/{category:id}', [CategoryController::class, 'show'])->middleware(['auth', 'admin'])->name('admin.category.show');

Route::get('/admin/categories/{id}/edit', [CategoryController::class, 'edit'])->middleware(['auth', 'admin'])->name('admin.category.edit');
Route::put('/admin/categories/{id}/edit', [CategoryController::class, 'update'])->middleware(['auth', 'admin'])->name('admin.category.update');

Route::delete('/admin/categories/{id}', [CategoryController::class, 'destroy'])->middleware(['auth', 'admin'])->name('admin.category.delete');

// Users
Route::get('/admin/users', [UserController::class, 'admin'])->middleware(['auth', 'admin'])->name('admin.user.index');

Route::get('/admin/users/create', [UserController::class, 'create'])->middleware(['auth', 'admin'])->name('admin.user.create');
Route::post('/admin/users', [UserController::class, 'store'])->middleware(['auth', 'admin'])->name('admin.user.store');

Route::post('/admin/users/province', [UserController::class, 'province'])->name('admin.user.province');

Route::get('/admin/users/{user:id}', [UserController::class, 'show'])->middleware(['auth', 'admin'])->name('admin.user.show');


Route::delete('/admin/users/{user:id}', [UserController::class, 'delete'])->middleware(['auth', 'admin'])->name('admin.user.delete');

// Orders Control
Route::get('/admin/orders', function () {
    return view('admin.orders.index');
})->middleware(['auth', 'admin'])->name('admin.orders');

// Guestbook
Route::get('/admin/guestbook', [GuestbookController::class, 'index'])->middleware(['auth', 'admin'])->name('admin.guestbook.index');

Route::post('/guestbook/create', [GuestbookController::class, 'store'])->name('guestbook.store');

Route::delete('/admin/guestbook/{guestbook:id}', [GuestbookController::class, 'delete'])->middleware(['auth', 'admin'])->name('admin.guestbook.delete');
