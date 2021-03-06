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

Route::prefix('stock')->middleware(['auth'])->group(function() {
    Route::get('/', 'StockController@index');
    Route::get('approve/{id}', 'StockController@approve')->name('stock.approve');
    Route::get('reject/{id}', 'StockController@reject')->name('stock.reject');
});
