<?php

namespace App;

use PDO;

class CartOps
{
    public $cart;
    public function __construct()
    {
        $this->cart = session('cart', [
            'total_price' => 0,
            'items' => collect()
        ]);
    }

    public function addToCart($product)
    {
        $items = $this->cart['items'];
        $total_price = $this->cart['total_price'];
        if (count($items) > 0 && $items->contains('object.id', $product->id)) {
            $items = $items->map(function ($item) use ($product) {
                if ($item['object']->id == $product->id) {
                    $item['qty'] += 1;
                }
                return $item;
            });
        } else {
            $newItem = collect([
                'qty' => 1,
                'object' => $product
            ]);
            $items = $items->push($newItem);
        }
        $total_price += $product->price;
        $cart = ['cart' => [
            'total_price' => $total_price,
            'items' => $items
        ]];
        session()->put($cart);
    }

}
