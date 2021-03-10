<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Cart extends Model
{
//    получение продукта
    public static function identityProduct($slug)
    {
        $product = Product::query()
            ->firstWhere('slug', '=', $slug);
        if (empty($product)) {
            return false;
        }
        return $product;
    }

//    добавление товара
    public function addToCart($product, $qty)
    {
        $qtySum = Session::get('cartQtySum') ? Session::get('cartQtySum') + $qty : $qty;
        $sumPrice = $product->price * $qty;
        if (Session::has('cart.' . $product['slug'])) {
            $qty = (Session::get('cart.' . $product['slug']))['qty'] + $qty;
        }
        $cartAttributes = $this->cartAttribute($product, $qty);
        $totalPrice = Session::get('cartTotalPrice') ? Session::get('cartTotalPrice') + $sumPrice : $sumPrice;

        Session::put('cart.' . $product['slug'], $cartAttributes);
        $this->sessionPutCart($qtySum, $totalPrice);
    }

//    пересчет корзины
    public function recalculateCart($product, $qty, $qtyRez)
    {
        $cartAttributes = $this->cartAttribute($product, $qty);
        $qtySum = Session::get('cartQtySum') + $qtyRez;
        $productPrice = $product->price;
        $sumRez = $productPrice * $qtyRez;
        $totalPrice = Session::get('cartTotalPrice') + $sumRez;

        Session::put('cart.' . $product['slug'], $cartAttributes);
        $this->sessionPutCart($qtySum, $totalPrice);
    }

//    удаление продукта с корзины
    public function dellToCart($product)
    {
        $qtySum = Session::get('cartQtySum') - Session::get('cart.' . $product['slug'])['qty'];
        $totalPrice = Session::get('cartTotalPrice') - Session::get('cart.' . $product['slug'])['price'] * Session::get('cart.' . $product['slug'])['qty'];
        Session::forget('cart.' . $product['slug']);
        $this->sessionPutCart($qtySum, $totalPrice);
    }

//    запись в сессию данных для формирования корзины
    public function sessionPutCart($qtySum, $totalPrice)
    {
        Session::put(['cartQtySum' => $qtySum,
            'cartTotalPrice' => $totalPrice]);
    }

//    сохранение атрибутов продукта для корзины
    public function cartAttribute($product, $qty)
    {
        return $cartAttributes = [
            'title' => $product->title,
            'price' => $product->price,
            'img' => $product->img,
            'qty' => $qty,
            'id' => $product->id];
    }
}
