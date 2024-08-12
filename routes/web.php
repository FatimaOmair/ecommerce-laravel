<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [AppController::class,'index'])->name('app.index');
Route::get('/shop', [ShopController::class,'index'])->name('shop.index');
Route::get('/product/{slug}', [ShopController::class,'productDetails'])->name('shop.product.details');
Route::get('/cart', [CartController::class,'index'])->name('cart.index');
Route::post('/cart/store', [CartController::class,'add'])->name('cart.store');
Route::put('/cart/update', [CartController::class,'update'])->name('cart.update');
Route::delete('/cart/remove', [CartController::class,'remove'])->name('cart.remove');
Route::delete('/cart/clear', [CartController::class,'clear'])->name('cart.clear');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Auth::routes();

Route::middleware('auth')->group(function(){
    Route::get('/my-account', [UserController::class,'index'])->name('user.index');

});

Route::middleware('auth','auth.admin')->group(function(){
    Route::get('/admin', [AdminController::class,'index'])->name('admin.index');

});