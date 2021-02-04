<?php

namespace App\Http\Controllers\Far;

use App\Http\Controllers\Controller;
use App\Http\Requests\FarProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\SortForm;
use App\Models\UploadForm;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        Product::breadCrumbs('index');

        $query = Product::query();
        $sort = \request()->get('sort');

        if ($sort) {
            $products = SortForm::sort($sort, $query);

        } else {
            Product::sessionForget(['direction', 'typeSort', 'search']);

            $products = Product::getQuery($query);
        }
        return view('far.products.index', compact('products'));
    }


    public function create()
    {
        Product::breadCrumbs('create');

        $categories = Category::query()
            ->get();
        return view('far.products.create', compact('categories'));
    }


    public function store(FarProductRequest $request)
    {
        $file = UploadForm::upload('product', $request);

        $product = Product::saveProduct($request, $file);
        $product->save();

        return redirect()->route('products.index')->with('success', "Товар '$product->title' добавлен");
    }


    public function show($id)
    {
        $product = Product::query()
            ->findOrFail($id);

        Product::breadCrumbs('show', $product->title);

        return view('far.products.show', compact('product'));
    }


    public function edit($id)
    {
        $product = Product::query()
            ->findOrFail($id);
        Product::breadCrumbs('edit', $product->title);

        $categories = Category::query()
            ->get()
            ->all();
        return view('far.products.edit', compact('product', 'categories'));
    }


    public function update(FarProductRequest $request, $id)
    {
        $product = Product::query()
            ->findOrFail($id);
        $file = UploadForm::upload('product', $request, $product->img);

        Product::saveProduct($request, $file, $product);
        $product->update();

        return redirect(session('backRoute'))->with('success', "Продукт '$product->title' изменен");
    }


    public function destroy($id)
    {
        $img = request()->get('img');
        $product = Product::query()
            ->find($id);
        $file = $product->img;
        $title = $product->title;
        if ($file !== 'no-image.png') {
            if ($img == 2) {
                UploadForm::dropImg('product', $file);
            } else {
                UploadForm::moveImg('product', $file);
            }
        }
        $product->delete();
        session()->flash('success-dell', "Продукт '$title' удален!");
    }


    public function search(Request $request)
    {
        Product::sessionForget(['direction', 'typeSort']);

        $q = ($request->get('q'));
        $products = Product::getProductToSearch($q);

        return view('far.products.index', compact('products'));
    }
}
