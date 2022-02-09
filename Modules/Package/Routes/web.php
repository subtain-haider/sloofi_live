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

Route::prefix('package')->group(function() {
    Route::controller(PackageController::class)->group(function () {
        Route::get('index', 'index')->name('package.all');
        Route::get('create', 'create')->name('package.create');
        Route::post('store', 'store')->name('package.store');
        Route::get('edit/{id}', 'edit')->name('package.edit');
        Route::post('update/{id}', 'update')->name('package.update');
        Route::delete('delete/{id}', 'destroy')->name('package.delete');

    });
});
