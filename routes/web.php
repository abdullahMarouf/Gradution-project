<?php

use App\Http\Controllers\front\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/',[HomeController::class,'index'])->name('home');
Route::view('/blog','front.blog')->name("blog");
Route::view('/about','front.about')->name("about");
Route::view('/shop','front.shop')->name('shop');
Route::view('/carts','front.cart')->name('cart');
Route::view('/checkout','front.checkout')->name('checkout');
Route::view('/contact-us','front.contact')->name("contact");
Route::view('/single-product','front.single-product');


require __DIR__ . '/dashboard.php';
