<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class BreadCrumbs extends Model
{
    public static function breadCrumbs($route, $level, $levelOneRoute = null)
    {
        if ($route === 'index') {
            session(['backRoute' => $_SERVER['REQUEST_URI'],
                'levelOne' => $level,
                'levelOneRoute' => $levelOneRoute ?? session('levelOneRoute'),
                'levelTwo' => null],
            );
        }
        if ($route === 'create') {
            session(['levelTwo' => $level]);
        }
        if ($route === 'edit') {
            session(['levelTwo' => $level]);
        }
    }
}
