<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function menu()
    {
        $categories = Product::query()
            ->join('categories', 'categories.id','=','products.category_id')
            ->select('categories.*', 'categories.title as category_title', 'categories.slug as category_slug')
            ->selectRaw('COUNT(category_id) as countCategory')
            ->groupBy('category_id')
            ->get();
//        dd($categories);
        return view('front.products.menu', compact('categories'));
    }


    public function show($slug)
    {
        $products = Product::query()
            ->join('categories', 'categories.id', '=', 'products.category_id')
            ->select('products.*', 'categories.title as category_title', 'categories.slug as category_slug')
            ->where('categories.slug', '=', $slug)
            ->paginate(8);
//        dd($products);

        return view('front.products.show', compact('products'));
    }

    public function single($category, $slug)
    {
        $product = Product::query()
            ->with('category')
            ->where('slug', '=', $slug)
            ->firstOrFail();
//        dd($product);
        return view('front.products.single', compact('product'));
    }

}
