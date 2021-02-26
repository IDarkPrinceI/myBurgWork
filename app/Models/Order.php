<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Order extends Model
{
    public function getItems()
    {
        return $this->hasMany(OrderItem::class);
    }


    public function saveOrder($request)
    {
        $this->qty = Session::get('cartQtySum');
        $this->sum = Session::get('cartTotalPrice');
        $this->name = $request->name;
        $this->email = $request->email;
        $this->phone = $request->phone;
        $this->address = $request->address;
        $this->user_id = Auth::id();
        if(!$this->save()) {
            return false;
        }
        return true;
    }

    public static function breadCrumbs($route)
    {
        if ($route === 'index') {
            session(['backRoute' => $_SERVER['REQUEST_URI'],
                'levelOne' => 'Список заказов',
                'levelOneRoute' => 'orders.index',
                'levelTwo' => null],
            );
        }
        if ($route === 'show') {
            session(['levelTwo' => 'Просмотр заказа']);
        }
    }


    public static function findOrder($id)
    {
        $order = Order::query()
            ->find($id);
        return $order;
    }


    public function updateStatusOrder($status)
    {
        $this->status = $status;
        $this->save();
    }

}
