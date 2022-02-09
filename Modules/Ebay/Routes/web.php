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
Route::get('/ebay/get_token', [\Modules\Ebay\Http\Controllers\EbayController::class, 'index']);
Route::prefix('ebay')->group(function() {
    Route::get('/', 'EbayController@index');
});
