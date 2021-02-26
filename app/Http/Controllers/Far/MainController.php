<?php

namespace App\Http\Controllers\Far;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MainController extends Controller
{
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
            ->where('status', '=',0)
            ->count();
        return view('far.index', compact('categories', 'products', 'orders', 'ordersInWork'));
    }
}
