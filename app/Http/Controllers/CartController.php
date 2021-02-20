<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function cartAdd($slug)
    {
        $qty = request()->get('qty');
        $product = Cart::identityProduct($slug);
        $cart = new Cart();
        $cart->addToCart($product, $qty);
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


    public function getOrder()
    {
        return view('front.cart.order');
    }


    public function cartReCalc($qty)
    {
        $slug = request()->get('slug');
        $qtyRez = request()->get('qtyRez');
        $product = Cart::identityProduct($slug);
        $cart = new Cart();
        $cart->recalculateCart($product, $qty, $qtyRez);
    }
}
