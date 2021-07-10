<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productsController;
use App\Http\Controllers\BidOfferController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('home');
})->name('home');




//log out Route
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');
//log in Route
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
//sign in Route
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
//products Route
Route::get('/products', [productsController::class, 'index'])->name('products');
Route::get('/products/{productId}', [productsController::class, 'show'])->name('users.product');
Route::post('/products', [productsController::class, 'store']);
Route::delete('/products/{productId}', [productsController::class, 'destroy'])->name('products.destroy');
Route::PUT('/products/{productId}', [productsController::class, 'update'])->name('products.update');
Route::post('/products/{productId}', [productsController::class, 'sell'])->name('products.sell');
Route::get('/search', [productsController::class, 'search'])->name('products.search');
//Bids Offer Route
Route::post('/bidOffer/{userId}/{productId}', [BidOfferController::class, 'store'])->name('bidOffer.add');
