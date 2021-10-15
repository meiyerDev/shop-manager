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

Route::post('/login', 'AuthController@login')->name('api.auth.login');

Route::get('/products', 'ProductController@index')->name('api.products.index');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', 'AuthController@getAuth')->name('api.auth.get-auth');
    Route::get('/orders', 'OrderController@index')->name('api.order.index');
    Route::post('/orders', 'OrderController@store')->name('api.order.create');
    Route::get('/orders/{orderId}', 'OrderController@show')->name('api.order.show');

    Route::post('/orders/{orderId}/placeto-pay', 'OrderPlacetoPayController@createPaymentRequest')->name('api.order.placeto-pay.generate');
    Route::get('/orders/{orderId}/placeto-pay', 'OrderPlacetoPayController@getPaymentRequest')->name('api.order.placeto-pay.latest');
});

Route::get('/orders/{orderId}/placeto-pay/{referenceId}/successful', 'OrderPlacetoPayController@receivedSuccessful')->name('api.order.placeto-pay.successful');
Route::get('/orders/{orderId}/placeto-pay/{referenceId}/canceled', 'OrderPlacetoPayController@receivedcanceled')->name('api.order.placeto-pay.canceled');
