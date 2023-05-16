<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Product;

class HomeController extends Controller
{
    //
    public function index()
    {
        $products=Product::with('category')->active()->take(8)->get();

        return response()->view('front.index',compact('products'));
    }
}
