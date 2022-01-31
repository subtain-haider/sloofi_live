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

Route::prefix('product')->middleware(['auth'])->group(function() {
    Route::controller(ProductController::class)->group(function () {
        Route::get('all', 'index')->name('product.all');
        Route::get('create', 'create')->name('product.create');
        Route::post('store', 'store')->name('product.store');
        Route::get('edit/{id}', 'edit')->name('product.edit');
        Route::put('update/{id}', 'update')->name('product.update');
        Route::delete('delete/{id}', 'destroy')->name('product.delete');
        Route::post('add/stock', 'addStock')->name('product.add-stock');
    });
});
Route::prefix('property')->middleware(['auth'])->group(function() {
    Route::controller(PropertyController::class)->group(function () {
        Route::get('all', 'index')->name('property.all');
        Route::get('create', 'create')->name('property.create');
        Route::post('store', 'store')->name('property.store');
        Route::get('edit/{id}', 'edit')->name('property.edit');
        Route::put('update/{id}', 'update')->name('property.update');
        Route::delete('delete/{id}', 'destroy')->name('property.delete');
    });
});
