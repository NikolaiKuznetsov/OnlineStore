<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(ProductController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('product/{id}', 'showProduct')->name('show.product');
    Route::get('/about', 'showAbout')->name('about');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('catalog', 'showCatalog')->name('show.catalog');
    Route::get('catalog/{slug}', 'showCategory')->name('show.category');
});

Route::middleware('auth')->controller(AuthController::class)->group(function () {
    Route::get('logout', 'logout')->name('logout');
});

Route::middleware('auth')->controller(UserController::class)->group(function () {
    Route::get('user/{login}', 'showUser')->name('show.user');
    Route::get('order-delete/{id}', 'deleteOrder')->name('delete.order');
});

Route::middleware('guest')->controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register/registration', 'registerProcess')->name('process.register');
    Route::get('login', 'login')->name('login');
    Route::post('login/authorization', 'loginProcess')->name('process.login');
});

Route::middleware('auth')->controller(CheckoutController::class)->group(function () {
    Route::get('checkout', 'showCheckout')->name('show.checkout');
    Route::post('checkout/add', 'addCheckout')->name('checkout.add');
    Route::post('checkout/change-quantity', 'changeQuantity')->name('change.quantity');
    Route::post('checkout/save-order', 'saveOrder')->name('save.order');
    Route::get('checkout/success', 'showSuccess')->name('show.success');
});

Route::get('/contact', function (){
    return view('contact');
})->name('contact');
