<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class SortForm extends Model
{
//    private static $asc = 'asc';
//    private static $desc = 'desc';

    public static function sort($sort, $query)
    {
        $direction = (\request()->get('direction') ?? session('direction'));

        session(['typeSort' => $sort]);
        session(['direction' => $direction]);

        $products = Product::getQuery($query, $sort, $direction);

        return $products;
    }

}
