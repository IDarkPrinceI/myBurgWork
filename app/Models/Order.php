<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Order extends Model
{
//    связь таблицы заказы и товары заказов
    public function getItems()
    {
        return $this->hasMany(OrderItem::class);
    }

//    сохранить заказ
    public function saveOrder($request)
    {
        $this->qty = Session::get('cartQtySum');
        $this->sum = Session::get('cartTotalPrice');
        $this->name = $request->name;
        $this->email = $request->email;
        $this->phone = $request->phone;
        $this->address = $request->address;
        $this->user_id = Auth::id();
        if (!$this->save()) {
            return false;
        }
        return true;
    }

//    найти заказ
    public static function findOrder($id)
    {
        $order = Order::query()
            ->find($id);
        return $order;
    }

//    изменить статус заказа
    public function updateStatusOrder($status)
    {
        $this->status = $status;
        $this->save();
    }
}
