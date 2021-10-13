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

Route::view('/order/{orderId}/placeto-pay/successful', 'spa')->name('web.placeto-pay.successful');
Route::view('/order/{orderId}/placeto-pay/canceled', 'spa')->name('web.placeto-pay.canceled');
Route::view('/order/{orderId}/placeto-pay/retry', 'spa')->name('web.placeto-pay.retry');
Route::view('/{any}', 'spa')->where('any', '^(?!api).*');
