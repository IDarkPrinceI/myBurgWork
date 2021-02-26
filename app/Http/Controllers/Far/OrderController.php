<?php

namespace App\Http\Controllers\Far;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        Order::breadCrumbs('index');

        $orders = Order::query()
            ->orderBy('status')
            ->paginate(5);
        return view('far.orders.index', compact('orders') );
    }


    public function show($id)
    {
        Order::breadCrumbs('show');

        $order = Order::findOrder($id);
        $orderItems = OrderItem::query()
            ->where('order_id', '=', $id)
            ->get();
        return view('far.orders.show', compact('order', 'orderItems') );
    }


    public function update($id, Request $request)
    {
        $order = Order::findOrder($id);
        $status = $request->get('status') ?? 0;

        $order->updateStatusOrder($status);
        return redirect()->route('orders.index');
    }

}
