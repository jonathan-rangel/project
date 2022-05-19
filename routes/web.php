<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmartphonesController;
use App\Http\Controllers\CartsController;
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

Route::get('/', [SmartphonesController::class, 'index']);

Auth::routes();

Route::post('/cart', [CartsController::class, 'store'])->name('cart');
