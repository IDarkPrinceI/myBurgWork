<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{

    public static function breadCrumbs($route)
    {
        if ($route === 'index') {
            session(['backRoute' => $_SERVER['REQUEST_URI'],
                'levelOne' => 'Список пользователей',
                'levelOneRoute' => 'statistic.users',
                'levelTwo' => null],
            );
        }
        if ($route === 'create') {
            session(['levelTwo' => 'Добавление пользователя']);
        }
        if ($route === 'edit') {
            session(['levelTwo' => 'Редактирование']);
        }
    }

}
