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

Route::prefix('order')->middleware(['auth'])->group(function() {
    Route::controller(OrderController::class)->group(function () {
        Route::get('all', 'index')->name('order.all');
        Route::get('sloofi', 'sloofiOrders')->name('order.sloofi');
        Route::get('internal', 'internalOrders')->name('order.internal');
        Route::get('external', 'externalOrders')->name('order.external');
        Route::get('detail','show')->name('order.detail');
    });
});
