<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productsController;
use App\Http\Controllers\BidOfferController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//log out Route
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');
//log in Route
Route::post('/login', [LoginController::class, 'store']);
//sign in Route
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


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
