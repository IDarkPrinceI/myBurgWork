<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;


    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value, '-');
    }

    public static function saveCategory($request, $file, $category = null)
    {
        if (!$category) {
            $category = new Category();
        }
        $categoryTitle = $request->title;
        $category->title = $categoryTitle;
        $category->slug = $categoryTitle;
        $category->description = $request->description;
        $category->keywords = $request->keywords;
        $category->img = $file;

        return $category;
    }
}
