<?php

use App\Http\Controllers\dashboard\AdminController;
use App\Http\Controllers\dashboard\Auth\AuthController;
use App\Http\Controllers\dashboard\CategoryController;
use App\Http\Controllers\dashboard\ProductController;
use App\Http\Controllers\dashboard\UserController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'guest:admin',
    'as' => 'auth.'
], function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::group([
    'prefix' => 'dashboard',
    'middleware'=>'auth:admin'
], function () {
    Route::view('/', 'dashboard.index')->name('dashboard.index');
    Route::resource('/admins', AdminController::class);
    Route::resource('/users', UserController::class);
    Route::get('categories/trash', [CategoryController::class, 'trash'])
        ->name('categories.trash');
    Route::put('/categories/{id}/restore', [CategoryController::class, 'restore'])
        ->name('categories.restore');
    Route::delete('/categories/{category}/force-delete', [CategoryController::class, 'forceDelete'])
        ->name('categories.force-delete');
    Route::resource('/categories', CategoryController::class);
    Route::get('products/trash', [ProductController::class, 'trash'])
        ->name('products.trash');
    Route::put('/products/{product}/restore', [ProductController::class, 'restore'])
        ->name('products.restore');
    Route::delete('/products/{product?}/force-delete', [ProductController::class, 'forceDelete'])
        ->name('products.force-delete');
    Route::resource('/products', ProductController::class);
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

});


