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

Route::prefix('woocommerce')->middleware(['auth'])->group(function() {
    Route::controller(WoocommerceController::class)->group(function () {
        Route::get('all', 'index')->name('woocommerce.all');
        Route::get('create', 'create')->name('woocommerce.create');
        Route::post('store', 'store')->name('woocommerce.store');
        Route::delete('delete/{id}', 'destroy')->name('woocommerce.delete');
        Route::get('woocommerce/products/sync/{id}', 'syncProducts')->name('woocommerce.products.sync');
        Route::get('woocommerce/products', 'woocommerceProducts')->name('my.woocommerce.products');
    });
});
