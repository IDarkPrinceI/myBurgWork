<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $products = Product::query()
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select( 'products.*', 'categories.slug as category_slug')
            ->orderBy('view', 'desc')
            ->take(8)
            ->get();
        return view('front.index', compact('products'));
    }
}
