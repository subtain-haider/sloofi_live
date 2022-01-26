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
Route::prefix('warehouse')->middleware(['auth'])->group(function() {
    Route::controller(WarehouseController::class)->group(function () {
        Route::get('all', 'index')->name('warehouse.all');
        Route::get('create', 'create')->name('warehouse.create');
        Route::post('store', 'store')->name('warehouse.store');
        Route::get('edit/{id}', 'edit')->name('warehouse.edit');
        Route::put('update/{id}', 'update')->name('warehouse.update');
        Route::delete('delete/{id}', 'destroy')->name('warehouse.delete');
        Route::post('upload/image', 'form_storeMedia')->name('form.storeMedia');
        Route::post('remove/image', 'form_removeMedia')->name('form.removeMedia');

    });
});