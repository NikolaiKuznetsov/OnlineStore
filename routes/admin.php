<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:admin')->group(function () {
    Route::resource('orders', OrderController::class);
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::get('/', [AdminController::class, 'index'])->name('home');
});

Route::middleware('guest:admin')->controller(AuthController::class)->group(function () {
    Route::get('login', 'login')->name('login');
    Route::post('login/authorization', 'loginProcess')->name('process.login');
});

Route::middleware('auth:admin')->controller(AuthController::class)->group(function () {
    Route::get('logout', 'logout')->name('logout');
});

