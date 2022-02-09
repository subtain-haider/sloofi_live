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
        Route::get('deposit', 'deposit')->name('user.deposit');
        Route::get('my-wallet', 'myWallet')->name('user.my-wallet');
        Route::post('update', 'update')->name('user.update');
        Route::get('become-a-vendor','becomeAVendor')->name('user.become_a_vendor');
        Route::post('become-a-vendor','becomeAVendorPost')->name('user.become-a-vendor.post');
        Route::get('become-a-dropshipper','becomeADropshipper')->name('user.become-a-dropshipper');
        Route::post('become-a-dropshipper','becomeADropshipperPost')->name('user.become-a-dropshipper.post');

    });
    Route::controller(WalletController::class)->group(function () {
        Route::get('deposit', 'deposit')->name('user.deposit');
        Route::get('my-wallet', 'myWallet')->name('user.my-wallet');
        Route::post('deposit/store', 'depositStore')->name('user.deposit.store');

    });
});
