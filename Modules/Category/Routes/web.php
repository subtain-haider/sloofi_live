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
Route::prefix('category')->middleware(['auth'])->group(function() {
    Route::controller(CategoryController::class)->group(function () {
        Route::get('all', 'index')->name('category.all');
        Route::get('create', 'create')->name('category.create');
        Route::post('store', 'store')->name('category.store');
        Route::get('edit/{id}', 'edit')->name('category.edit');
        Route::put('update/{id}', 'update')->name('category.update');
        Route::delete('delete/{id}', 'destroy')->name('category.delete');
        Route::post('upload/image', 'form_storeMedia')->name('form.storeMedia');
        Route::post('remove/image', 'form_removeMedia')->name('form.removeMedia');

    });
});