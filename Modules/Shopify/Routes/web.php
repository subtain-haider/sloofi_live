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
Route::get('/install', [\Modules\Shopify\Http\Controllers\ShopifyController::class, 'install']);
Route::get('/generate_token', [\Modules\Shopify\Http\Controllers\ShopifyController::class, 'generate_token']);
Route::prefix('shopify')->middleware(['auth'])->group(function() {
    Route::controller(ShopifyController::class)->group(function () {
        Route::get('all', 'index')->name('shopify.all');
        Route::get('create', 'create')->name('shopify.create');
        Route::post('store', 'store')->name('shopify.store');
        Route::delete('delete/{id}', 'destroy')->name('shopify.delete');
        Route::get('products/sync/{id}', 'syncProducts')->name('shopify.products.sync');
        Route::get('products', 'shopifyProducts')->name('my.shopify.products');
        Route::get('show', 'show')->name('shopify.show');
    });
});
