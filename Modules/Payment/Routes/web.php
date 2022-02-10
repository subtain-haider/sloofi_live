<?php

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

Route::prefix('payment')->middleware(['auth'])->group(function() {
    Route::get('stripe', 'PaymentController@stripe');
    Route::post('stripe', 'PaymentController@stripePost')->name('stripe.post');
    Route::get('paypal/create-transaction','PaymentController@createTransaction')->name('paypal.createTransaction');
    Route::get('process-transaction/{order_id}','PaymentController@processTransaction')->name('paypal.processTransaction');
    Route::get('success-transaction/{id}','PaymentController@successTransaction')->name('paypal.successTransaction');
    Route::get('cancel-transaction', 'PaymentController@cancelTransaction')->name('paypal.cancelTransaction');
    Route::get('/', 'PaymentController@index');
});
