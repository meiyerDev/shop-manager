<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/products', 'ProductController@index')->name('api.products.index');
    Route::post('/order', 'OrderController@store')->name('api.products.index');
    Route::get('/order/{orderId}', 'OrderController@show')->name('api.order.show');
    Route::post('/order/{orderId}/placeto-pay', 'OrderPlacetoPayController')->name('api.order.placeto-pay.generate');
});
