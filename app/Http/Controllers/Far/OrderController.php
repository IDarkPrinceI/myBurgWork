<?php

namespace App\Http\Controllers\Far;

use App\Http\Controllers\Controller;
use App\Models\BreadCrumbs;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
//    Список заказов
    public function index()
    {
        BreadCrumbs::breadCrumbs('index', 'Список заказов', 'orders.index');

        $orders = Order::query()
            ->orderBy('status')
            ->paginate(5);
        return view('far.orders.index', compact('orders'));
    }

//    Просмотр заказа
    public function show($id)
    {
        $order = Order::findOrder($id);
        BreadCrumbs::breadCrumbs('show', "Просмотр заказа № $order->id");

        $orderItems = OrderItem::query()
            ->where('order_id', '=', $id)
            ->get();
        return view('far.orders.show', compact('order', 'orderItems'));
    }

//    Изменение статуса заказа
    public function update($id, Request $request)
    {
        $order = Order::findOrder($id);
        $status = $request->get('status') ?? 0;

        $order->updateStatusOrder($status);
        return redirect()->route('orders.index');
    }

}
