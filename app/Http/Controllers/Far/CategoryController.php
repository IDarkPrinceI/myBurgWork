<?php

namespace App\Http\Controllers\Far;

use App\Http\Controllers\Controller;
use App\Http\Requests\FarCategoryRequest;
use App\Models\BreadCrumbs;
use App\Models\Category;
use App\Models\UploadForm;
use Illuminate\Support\Facades\Request;
use League\Flysystem\Config;


class CategoryController extends Controller
{

    public function index()
    {
        BreadCrumbs::breadCrumbs('index', 'Список категорий', 'categories.index');

        $categories = Category::query()
            ->paginate(5);

        return view('far.categories.index', compact('categories'));
    }


    public function create()
    {
        BreadCrumbs::breadCrumbs('create', 'Добавление категории');

        return view('far.categories.create');
    }


    public function store(FarCategoryRequest $request)
    {
        $file = UploadForm::upload('category', $request);

        $category = Category::saveCategory($request, $file);
        $category->save();

        return redirect()->route('categories.index')->with('success', "Категория '$category->title' добавлена");
    }


    public function show($id)
    {
        $category = Category::query()
            ->findOrFail($id);
        return view('far.categories.test', compact('category'));

    }


    public function edit($id)
    {
        $category = Category::query()
            ->findOrFail($id);
        BreadCrumbs::breadCrumbs('edit', "Редактирование: $category->title");

        return view('far.categories.edit', compact('category'));
    }


    public function update(FarCategoryRequest $request, $id)
    {
        $category = Category::query()
            ->findOrFail($id);
        $file = UploadForm::upload('category', $request, $category->img);

        Category::saveCategory($request, $file, $category);
        $category->update();

        return redirect(session('backRoute'))->with('success', "Категория '$category->title' изменена");

    }


    public function destroy($id)
    {
        $img = request()->get('img');
        $category = Category::query()
            ->find($id);
        $file = $category->img;
        $title = $category->title;

        if ($file !== 'no-image.png') {
            if ($img == 2) {
                UploadForm::dropImg('category', $file);
            } else {
                UploadForm::moveImg('category', $file);
            }
        }

        $category->delete();
        session()->flash('success-dell', "Категория '$title' удалена!");
    }
}
