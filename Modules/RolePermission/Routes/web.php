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

Route::prefix('rolepermission')->middleware(['auth'])->group(function() {
    Route::controller(RolePermissionController::class)->group(function () {
        Route::get('/', 'index')->name('rolepermission.all');
        Route::get('edit/{id}', 'edit')->name('rolepermission.edit');
        Route::post('edit', 'update')->name('rolepermission.update');
    });
});
Route::prefix('role')->middleware(['auth'])->group(function() {
    Route::controller(RoleController::class)->group(function () {
        Route::get('all', 'index')->name('role.all');
        Route::get('/create', 'create')->name('role.create');
        Route::post('/store', 'store')->name('role.add');
        Route::get('/edit/{id}', 'edit')->name('role.edit');
        Route::post('/edit', 'update')->name('role.update');
        Route::get('/delete/{id}', 'destroy')->name('role.delete');
    });
});
Route::prefix('permission')->middleware(['auth'])->group(function() {
    Route::controller(PermissionController::class)->group(function () {
        Route::get('all', 'index')->name('permission.all');
        Route::get('create', 'create')->name('permission.create');
        Route::post('store', 'store')->name('permission.add');
        Route::get('edit/{id}', 'edit')->name('permission.edit');
        Route::post('edit', 'update')->name('permission.update');
        Route::get('delete/delete/{id}', 'destroy')->name('permission.delete');
        
    });
});