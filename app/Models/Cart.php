<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Cart extends Model
{
    public static function identityProduct($slug)
    {
        $product = Product::query()
            ->firstWhere('slug', '=', $slug);
        if(empty($product)) {
            return false;
        }
        return $product;
    }


    public function addToCart($product, $qty = 1)
    {
        $qty = intval($qty) ?? 1;
        $qtySum = Session::get('cartQtySum') ? Session::get('cartQtySum') + $qty : $qty;
        if (Session::has('cart.' . $product['slug'])) {
            $qty = (Session::get('cart.' . $product['slug']))['qty'] + $qty;
        }
        $cartAttributes = [
            'title' => $product->title,
            'price' => $product->price,
            'img' => $product->img,
            'qty' => $qty];

        $sumPrice = $product->price;
        $totalPrice = Session::get('cartTotalPrice') ? Session::get('cartTotalPrice') + $sumPrice : $sumPrice;

        Session::put('cart.' . $product['slug'], $cartAttributes);
        $this->sessionPutCart($qtySum, $totalPrice);
    }


    public function recalculateCart()
    {

    }


    public function dellToCart($product)
    {
        $qtySum = Session::get('cartQtySum') - Session::get('cart.' . $product['slug'])['qty'];
        $totalPrice = Session::get('cartTotalPrice') - Session::get('cart.' . $product['slug'])['price'];
        Session::forget('cart.' . $product['slug']);
        $this->sessionPutCart($qtySum, $totalPrice);
    }


    public function sessionPutCart($qtySum, $totalPrice)
    {
        Session::put(['cartQtySum' => $qtySum,
            'cartTotalPrice' => $totalPrice]);
    }
}