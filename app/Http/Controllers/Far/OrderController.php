<?php

namespace App\Http\Controllers\Far;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {

        Order::breadCrumbs('index');

        $orders = Order::query()
            ->orderBy('status')
            ->paginate(5);
        return view('far.orders.index', compact('orders'));
    }
}
