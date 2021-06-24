<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('item',App\Http\Controllers\ItemController::class);
Route::resource('cart',App\Http\Controllers\CartController::class);
Route::resource('order',App\Http\Controllers\OrderController::class);
Route::resource('profile',App\Http\Controllers\ProfileController::class);
Route::get('/admin/order',[\App\Http\Controllers\OrderController::class, 'admin'])->name('order.admin');
Route::put('/order/{id}/edit/result',[\App\Http\Controllers\OrderController::class, 'editOrder'])->name('order.editOrder');
Route::get('/item/{id}/mark', [\App\Http\Controllers\ItemController::class, 'markNotification'])->name('item.mark');
Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
