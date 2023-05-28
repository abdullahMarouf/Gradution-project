<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    //
    public function index()
    {

        $products=Product::with('category')->active()->take(8)->get();

        return response()->view('front.index',compact('products'));
//        return response()->view('front.shop',compact('products'));
    }

    public function index1()
    {

        $products=Product::with('category')->active()->take(8)->get();

        //        return response()->view('front.index',compact('products'));
        return response()->view('front.shop',compact('products'));
    }

        public function index3(string $id)
    {
        //
//        $products=Product::with('category')->active()->take(1)->get();
//
//        return response()->view('front.single-product',compact('products'));


            $product = Product::find($id);
             return response()->view('front.single-product', ['product' => $product]);

    }

}
