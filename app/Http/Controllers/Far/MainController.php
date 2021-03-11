<?php

namespace App\Http\Controllers\Far;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class MainController extends Controller
{
//    Главная страница админки
    public function index()
    {
        $categories = Category::query()
            ->with('category')
            ->count();
        $products = Product::query()
            ->count();
        $orders = Order::query()
            ->count();
        $ordersInWork = Order::query()
            ->where('status', '=', 0)
            ->count();
        $users = User::query()
            ->count();
        return view('far.index', compact('categories', 'products', 'orders', 'ordersInWork', 'users'));
    }
}
