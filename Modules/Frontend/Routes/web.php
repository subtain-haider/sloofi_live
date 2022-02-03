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
        Route::any('product/connect/shopify', 'connectToShopify')->name('frontend.shopify.products.connect');
        Route::post('product/connect/woocommerce', 'connectToWoocommerce')->name('frontend.woocommerce.products.connect');
        Route::post('add-stock', 'addStock')->name('frontend.add_to_stock_simple');
        Route::get('category_products/{category}/{f_size?}', 'category_products')->name('category.products');
        Route::get('cart', 'cart')->name('frontend.cart');
        Route::get('checkout', 'checkout')->name('frontend.checkout');
        Route::get('remove/cart/{id}', 'removeCart')->name('frontend.removeCart');
        Route::post('payment-page', 'paymentPage')->name('frontend.payment-page');

    });
});
