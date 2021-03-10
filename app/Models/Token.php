<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Token extends Model
{

    protected $primaryKey = 'user_id';

    //запрет на поля created_at и update_at
    public $timestamps = false;

    public function user()
    {
//        связь таблиц токен и пользователей
        return $this->belongsTo(User::class);
    }
}
