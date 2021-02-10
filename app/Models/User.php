<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function token()
    {
//        return $this->hasOne(Token::class, 'id', 'user_id');
        return $this->hasOne(Token::class, 'user_id', 'id');
    }


    public static function registration($request)
    {
        $user = new User();

        $user->email = $request->email;
        $user->password = Hash::make($request->password);
//        $user->auth_key
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();

        return $user;
    }


    public static function getRole()
    {
        return Auth::user()->role ?? null;
    }


    public static function authentication($credentials, $request, $remember)
    {

        return false;
    }
}
