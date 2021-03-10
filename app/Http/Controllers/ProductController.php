<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    //Меню
    public function menu()
    {
        $categories = Product::query()
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->select('categories.*', 'categories.title as category_title', 'categories.slug as category_slug')
            ->selectRaw('COUNT(category_id) as countCategory')
            ->groupBy('category_id')
            ->get();
        return view('front.products.menu', compact('categories'));
    }

//    Просмотр товаров категории
    public function show($slug)
    {
        $products = Product::query()
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->select('products.*', 'categories.title as category_title', 'categories.slug as category_slug')
            ->where('categories.slug', '=', $slug)
            ->paginate(8);

        return view('front.products.show', compact('products'));
    }

//    Просмотр одного продукта
    public function single($category, $slug)
    {
        $product = Product::query()
            ->with('category')
            ->where('slug', '=', $slug)
            ->first();
        //Добавляем один просмотр при открытии продукта
        $product->view += 1;
        $product->save();
        return view('front.products.single', compact('product'));
    }
}
