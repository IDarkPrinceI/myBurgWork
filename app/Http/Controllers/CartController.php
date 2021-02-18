<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function cartAdd($slug)
    {
        $product = Cart::identityProduct($slug);
        $cart = new Cart();
        $cart->addToCart($product);
        return $product;
    }


    public function cartClear()
    {
        Session::forget(['cart', 'cartQtySum', 'cartTotalPrice']);
    }


    public function cartDell($slug)
    {
        $product = Cart::identityProduct($slug);
        $cart = new Cart();
        $cart->dellToCart($product);
        return $product;
    }
}
