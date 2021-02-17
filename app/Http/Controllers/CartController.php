<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cartAdd($data)
    {
        $product = Product::query()
            ->firstWhere('slug','=', $data);
        $cart = new Cart();
        $cart->addToCart($product);

//        session(['cartProduct' => $product]);
//        return $product;
//        return $test;
    }
}
