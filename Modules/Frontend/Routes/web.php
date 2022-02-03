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
Route::get('/', 'FrontendController@index');
Route::get('/product/detail/{id}', 'FrontendController@productDetail')->name('frontend.product-detail');
Route::any('/add-to-cart/{id}', 'FrontendController@addToCart')->name('frontend.add-to-cart');
Route::prefix('frontend')->group(function() {
    Route::controller(FrontendController::class)->group(function () {
        Route::get('category_products/{category}/{f_size?}', 'category_products')->name('category.products');

    });
});
