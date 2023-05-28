<?php

namespace App\Http\Controllers;

use App\CartOps;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function addToCart(string $id)
    {
        $product = Product::find($id);
        $cart = new CartOps();
        $cart->addToCart($product);
        return back();
    }

    public function showCart()
    {
        $cart = session('cart',[
            'total_price'=>0,
            'items'=>collect()
        ]);
        return response()->view('front.cart',compact('cart'));
    }
}
