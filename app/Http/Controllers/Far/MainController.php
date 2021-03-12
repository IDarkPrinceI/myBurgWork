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
            ->count();
        $products = Product::query()
            ->count();
        $orders = Order::query()
            ->selectRaw('COUNT(status) as count')
            ->groupBy('status')
            ->get();
        $users = User::query()
            ->count();
        return view('far.index', compact('categories', 'products', 'orders', 'users'));
    }

    //    хлебные крошки для админской части
    public function breadCrumbs($route, $level, $levelOneRoute = null)
    {
        if ($route === 'index') {
            session(['backRoute' => $_SERVER['REQUEST_URI'],
                'levelOne' => $level,
                'levelOneRoute' => $levelOneRoute ?? session('levelOneRoute'),
                'levelTwo' => null],
            );
        }
        if ($route === 'create' || $route === 'edit' || $route === 'show') {
            session(['levelTwo' => $level]);
        }
    }
}
