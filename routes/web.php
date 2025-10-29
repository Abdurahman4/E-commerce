<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\OrderController;



// Routes for admin products
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
});


// Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Login
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/', [AuthController::class, 'login'])->name('login.post');

// Logout
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');


// استعادة كلمة المرور
Route::get('/forgot-password', [App\Http\Controllers\AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('/forgot-password', [App\Http\Controllers\AuthController::class, 'sendResetLink']);

// Home
Route::get('/shop', [ShopController::class, 'index'])->name('shop');

//Cart Management 
Route::post('/cart/add/{id}', [ShopController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove/{id}', [App\Http\Controllers\ShopController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/checkout', [OrderController::class, 'checkout'])->name('order.checkout')->middleware('auth');

//Payment
Route::get('/cart', [CartController::class,'show'])->name('cart.show');