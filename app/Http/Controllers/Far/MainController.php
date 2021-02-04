<?php

namespace App\Http\Controllers\Far;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MainController extends Controller
{
    public function index()
    {
//        dd(\request());
//        $category = new Category();
//        $title = 'ПВывЫФВ!';
//        $category->title = $title;
//        $category->slug = Str::slug($title, '-');
//        $category->save();
//        dd(Str::slug('Привет мир', '-'));
        $categories = Category::query()
            ->with('category')
            ->count();
//        dd($category);
        $products = Product::query()
            ->count();
        return view('far.index', compact('categories', 'products'));
    }
}
