<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class SortForm extends Model
{
//    сортировка вывода списка продуктов
    public static function sort($sort, $query)
    {
        $direction = (\request()->get('direction') ?? session('direction'));

        session(['typeSort' => $sort]);
        session(['direction' => $direction]);

        $products = Product::getQuery($query, $sort, $direction);

        return $products;
    }

}
