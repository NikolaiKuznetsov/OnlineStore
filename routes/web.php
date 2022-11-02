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
});

Route::middleware('auth')->controller(AuthController::class)->group(function () {
    Route::get('logout', 'logout')->name('logout');
});

Route::middleware('auth')->controller(UserController::class)->group(function () {
    Route::get('user/{login}', 'showUserProfile')->name('show.user.profile');
});

Route::middleware('guest')->controller(AuthController::class)->group(function () {
    Route::get('register', 'signUp')->name('signUp');
    Route::post('register/registration', 'signUpProcess')->name('process.signUp');
    Route::get('login', 'signIn')->name('signIn');
    Route::post('login/authorization', 'signInProcess')->name('process.signIn');
});

Route::middleware('auth')->controller(CheckoutController::class)->group(function () {
    Route::get('checkout', 'showCheckout')->name('show.checkout');
    Route::post('checkout/add', 'addCheckout')->name('checkout.add');
    Route::post('checkout/change-quantity', 'changeQuantity')->name('change.quantity');
    Route::post('checkout/save-order', 'saveOrder')->name('save.order');
});

Route::middleware('auth')->controller(UserController::class)->group(function () {
    Route::get('/orders', 'showOrders')->name('show.orders');
});

Route::get('/contact', function (){
    return view('contact');
})->name('contact');
