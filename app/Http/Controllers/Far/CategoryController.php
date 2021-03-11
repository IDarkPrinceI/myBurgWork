<?php

namespace App\Http\Controllers\Far;

use App\Http\Controllers\Controller;
use App\Http\Requests\FarCategoryRequest;
use App\Models\BreadCrumbs;
use App\Models\Category;
use App\Models\UploadForm;

class CategoryController extends Controller
{
//    Просмотр категорий
    public function index()
    {
        BreadCrumbs::breadCrumbs('index', 'Список категорий', 'categories.index');

        $categories = Category::query()
            ->paginate(5);

        return view('far.categories.index', compact('categories'));
    }

//    Страница добавления категории
    public function create()
    {
        BreadCrumbs::breadCrumbs('create', 'Добавление категории');

        return view('far.categories.create');
    }

//    Добавить категорию
    public function store(FarCategoryRequest $request)
    {
        $file = UploadForm::upload('category', $request);

        $category = Category::saveCategory($request, $file);
        $category->save();

        return redirect()->route('categories.index')->with('success', "Категория '$category->title' добавлена");
    }

//    Страница редактирования категории
    public function edit($id)
    {
        $category = Category::query()
            ->findOrFail($id);
        BreadCrumbs::breadCrumbs('edit', "Редактирование: $category->title");

        return view('far.categories.edit', compact('category'));
    }

//    Обновить категорию
    public function update(FarCategoryRequest $request, $id)
    {
        $category = Category::query()
            ->findOrFail($id);
        $file = UploadForm::upload('category', $request, $category->img);

        Category::saveCategory($request, $file, $category);
        $category->update();

        return redirect(session('backRoute'))->with('success', "Категория '$category->title' изменена");

    }

//    Удалить категорию
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
