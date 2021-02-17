<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Cart extends Model
{
    public function addToCart($product, $qty = 1)
    {
        $qty = $qty ?? 1;

        $cartAttributes = [
            'title' => $product->title,
            'price' => $product->price,
            'img' => $product->img,
            'qty' => $qty];
        $qtySum = Session::get('cart.qtySum') ? Session::get('cart.qtySum') + $qty : $qty;
        $totalPrice = Session::get('cart.totalPrice') ? Session::get('cart.totalPrice') + (intval($product->price)) * (intval($product->qty)) : (intval($product->price)) * (intval($product->qty));
        Session::put('cart.' . $product['slug'], $cartAttributes);
        Session::put('cart.qtySum', $qtySum);
        Session::put('cart.totalPrice', $totalPrice);




//        if (Session::has('cart')) {
//        if (Session::has('cart' . $product['slug'])) {
//            $oldCartAttributes = Session::get('cart');
//            if (array_key_exists($product['slug'], $oldCartAttributes)) {
//                $newQty = $qty + $oldCartAttributes[$product['slug']]['qty'];
//                $refreshCartElement = [$product['slug'] => [
//                    'title' => $product->title,
//                    'price' => $product->price,
//                    'content' => $product->content,
//                    'qty' => $newQty]
//                ];

//                $cartAttributes = array_replace($oldCartAttributes, $refreshCartElement);
//            } else {
//                $newCartElement = [$product['slug'] => [
//                'title' => $product->title,
//                'price' => $product->price,
//                'content' => $product->content,
//                'qty' => $qty]
//                ];
//
//                $cartAttributes = array_merge($oldCartAttributes, $newCartElement);
//            }
//
//        } else {
//            $totalPrice = (intval($product->price)) * (intval($product->qty));
//            $cartAttributes = [$product['slug'] => [
//                'title' => $product->title,
//                'price' => $product->price,
//                'content' => $product->content,
//                'qty' => $qty],
//                'qtySum' => $qty,
//                'totalPrice' => $totalPrice
//            ];

//            $cartAttributes = [
//                'title' => $product->title,
//                'price' => $product->price,
//                'content' => $product->content,
//                'qty' => $qty
//            ];
//
//
//        }

//        Session::put('cart', $cartAttributes);
//        Session::put('cart.' . $product['slug'], $cartAttributes);
//        Session::put('cart.qtySum', $cartAttributes);
    }
}
