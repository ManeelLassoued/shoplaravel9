<?php

use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ProductsController::class, 'index'])->name('home');  

Route::get('cart', [ProductsController::class, 'cart'])->name('cart');

Route::get('add-to-cart/{id}', [ProductsController::class, 'addToCart'])->name('add.to.cart');

Route::patch('update-cart', [ProductsController::class, 'update'])->name('update.cart');

Route::delete('remove-from-cart', [ProductsController::class, 'remove'])->name('remove.from.cart');;
