<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Token extends Model
{

    protected $primaryKey = 'user_id';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
