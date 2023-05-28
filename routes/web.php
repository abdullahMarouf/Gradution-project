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



//Route::prefix()->group(function (){
//
//
//});

Route::get('/',[HomeController::class,'index'])->name('home');
Route::view('/blog','front.blog')->name("blog");
Route::view('/about','front.about')->name("about");
Route::get('/shop',[HomeController::class ,'index1'])->name('shop');
//Route::view('/carts','front.cart')->name('cart');
Route::view('/checkout','front.checkout')->name('checkout');
Route::view('/contact-us','front.contact')->name("contact");
Route::get('/single-product/{id}',[HomeController::class , 'index3'])->name('singleProduct');
Route::get('add-to-cart/{id}' , [\App\Http\Controllers\CartController::class , 'addToCart'])->name('add-to-cart');
Route::get('cart' , [\App\Http\Controllers\CartController::class , 'showCart'])->name('cart');

//Route::resource('shop',HomeController::class);


require __DIR__ . '/dashboard.php';
