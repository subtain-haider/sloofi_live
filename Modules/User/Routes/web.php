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

Route::prefix('user')->middleware(['auth'])->group(function() {
    Route::controller(UserController::class)->group(function () {
        Route::get('all', 'index')->name('user.all');
        Route::get('detail/{id}', 'show')->name('user.detail');
        Route::post('update', 'update')->name('user.update');

    });
});