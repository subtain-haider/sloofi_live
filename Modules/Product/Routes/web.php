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
Route::prefix('section')->middleware(['auth'])->group(function() {
    Route::controller(SectionController::class)->group(function () {
        Route::get('all', 'index')->name('section.all');
        Route::get('create', 'create')->name('section.create');
        Route::post('store', 'store')->name('section.store');
        Route::get('edit/{id}', 'edit')->name('section.edit');
        Route::put('update/{id}', 'update')->name('section.update');
        Route::delete('delete/{id}', 'destroy')->name('section.delete');
    });
});
