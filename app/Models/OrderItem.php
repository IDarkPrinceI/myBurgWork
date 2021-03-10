<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class OrderItem extends Model
{
    //запрет на поля created_at и update_at
    public $timestamps = false;

//    связь таблиц товары заказа и заказы
    public function getOrder()
    {
        return $this->hasOne(Order::class);
    }

//    сохранение товаров заказа
    public static function saveOrderItems($orderId)
    {
        $products = Session::get('cart');

        foreach ($products as $key => $item) {
            $orderItems = new OrderItem();
            $orderItems->order_id = $orderId;
            $orderItems->product_id = $item['id'];
            $orderItems->name = $item['title'];
            $orderItems->img = $item['img'];
            $orderItems->price = $item['price'];
            $orderItems->qty = $item['qty'];
            $orderItems->sum = $item['qty'] * $item['price'];
            $orderItems->save();
            if (!$orderItems->save()) {
                return false;
            }
        }
        return true;
    }
}
