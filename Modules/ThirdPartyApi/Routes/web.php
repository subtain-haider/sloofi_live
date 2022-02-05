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

Route::prefix('thirdpartyapi')->group(function() {
    Route::controller(ThirdPartyApiController::class)->group(function () {
        Route::get('categories/{id}/{name}', 'categories')->name('thirdpartyapi.categories');
        Route::post('attach_tp', 'attach_tp')->name('thirdpartyapi.attach.tp');
    });
});
