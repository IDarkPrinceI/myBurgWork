<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value, '-');
    }


    public static function saveProduct($request, $file, $product = null)
    {
        if (!$product) {
            $product = new Product();
        }
        $productTitle = $request->title;
        $product->title = $productTitle;
        $product->category_id = request()->get('category_id');
        $product->slug = $productTitle;
        $product->price = $request->price;
        $product->old_price = $request->old_price;
        $product->description = $request->description;
        $product->is_new = request()->get('is_new') ? '1' : '0';
        $product->is_hit = request()->get('is_hit') ? '1' : '0';
        $product->content = $request->content;
        $product->keywords = $request->keywords;
        $product->img = $file;
        return $product;
    }


    public static function getQuery($query, $sort = null, $direction = null)
    {
        $query = $query
            ->join('categories', 'categories.id',  '=', 'products.category_id' )
            ->select('categories.title as category_title', 'products.*');

        if ($sort && $direction) {
            $query = $query
                ->orderBy($sort, $direction);
        }
        $query = $query
            ->paginate(5);
        return $query;
    }


    public static function getProductToSearch($baseSearch)
    {
        $wordsSearch = self::cleanSearchString($baseSearch);
        if (!$wordsSearch) {
            return $products = "Ваш запрос слишком короткий";
        }
        $baseSearchClear = implode(' ', $wordsSearch);
        $count = count($wordsSearch);
            //значения каждого отдельного слова в названии и описании для расчета релевантности
        $separateWordName = round( (20/$count), 2);
        $separateWordDescription = round( (10/$count), 2);
            //Задаем параметры релевантности
            //Условия для полного запроса в названии и описании
        $relevance = "IF (`products` . `title` LIKE '%" . $baseSearchClear . "%', 60, 0)";
        $relevance .= " + IF (`products` . `description` LIKE '%" . $baseSearchClear . "%', 10, 0)";
            //Условия для каждого из слов запроса в названии и описании
        foreach ($wordsSearch as $word) {
            $relevance .= " + IF (`products` . `title` LIKE '%" . $word . "%', ". $separateWordName. ", 0)";
            $relevance .= " + IF (`products` . `description` LIKE '%" . $word . "%', ".$separateWordDescription.", 0)";
            }
        $query = Product::query()
            ->join('categories', 'categories.id',  '=', 'products.category_id' )
            ->select('categories.title as category_title', 'products.*')
            //Создается новое поле "relevance", значение которого будет устанавливаться путем выполнения условий, записанных в $relevance
            ->selectRaw("$relevance AS relevance")
            ->orderBy('relevance', 'desc')
            ->where('products.title', 'like', '%'. $baseSearchClear .'%')
            ->orWhere('products.title', 'like', '%' . $wordsSearch[0] . '%');
            for ($i = 1; $i < $count; $i++) {
                $query = $query->orWhere('products.title', 'like', $wordsSearch[$i]);
            }
        $query = $query
            ->orWhere('products.description', 'like', '%' . $baseSearchClear . '%')
            ->orWhere('products.description', 'like', '%' . $wordsSearch[0] . '%');
        for ($i = 1; $i < $count; $i++) {
            $query = $query->orWhere('products.title', 'like', $wordsSearch[$i]);
        }
        $products = $query
            ->paginate(5);
//        session(['search' => $baseSearchClear]); // нужен ли он ?
        if ($products[0] === null) {
            $products = "По вашему запросу '$baseSearchClear' ничего не найдено";
        }
        return $products;
    }


    public static function cleanSearchString($baseSearch)
    {
        // удалить все, кроме букв и цифр
        $search = preg_replace('#[^0-9a-zA-ZА-Яа-яёЁ]#u', ' ', $baseSearch);
        // заменить двойные пробелы на одинарные
        $search = preg_replace('#\s+#u', ' ', $search);
        $search = trim($search);
        //Разделяем поисковый запрос на отдельные слова
        $baseWordsSearch = explode(' ', $search);
        $wordsSearch = [];
        foreach ($baseWordsSearch as $word) {
            //для латиницы
            if (preg_match('/[zA-Za]/i', $word)) {
                //если слово больше 3х букв
                if (strlen($word) > 3) {
                    if (strlen($word) > 7) {
                        $word = substr($word, 0, (strlen($word) - 2));
                        array_push($wordsSearch, $word);
                    } elseif (strlen($word) > 5) {
                        $word = substr($word, 0, (strlen($word) - 1));
                        array_push($wordsSearch, $word);
                    } else {
                        array_push($wordsSearch, $word);
                    }
                }
                //Для кирилицы
            } elseif (strlen($word) > 6) {
                //если слово больше 6х букв
                if (strlen($word) > 14) {
                    $word = substr($word, 0, (strlen($word) - 4));
                    array_push($wordsSearch, $word);
                } elseif (strlen($word) > 10) {
                    $word = substr($word, 0, (strlen($word) - 2));
                    array_push($wordsSearch, $word);
                } else {
                    array_push($wordsSearch, $word);
                }
            }

        } if (empty($wordsSearch)) {
                return null;
        } else {
            return array_unique($wordsSearch);
        }
    }


    public static function sessionForget($data)
    {
        foreach ($data as $key) {
            session()->forget($key);
        }
    }
}
