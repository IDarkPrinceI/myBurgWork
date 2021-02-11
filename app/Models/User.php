<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use PharIo\Manifest\Exception;

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
        return $this->hasOne(Token::class, 'user_id', 'id');
    }


    public static function registration($request)
    {
        $user = new User();

        $user->email = $request->email;
        $user->password = Hash::make($request->password);
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


    public static function authentication($request, $user = null, $remember = null)
    {
        $randomByteCache = bin2hex(random_bytes(24));
        if (Cache::has('rememberMe')) {
            Cache::forget('rememberMe');
        }
        Cache::add('rememberMe',  $randomByteCache, 1800);

        $rememberMe = Hash::make($randomByteCache);
        $userId = User::query()
            ->select('id')
            ->where('email', $request['email'])
            ->first();

        $token = Token::query()
            ->select('*')
            ->where('user_id', $user->id ?? $userId->id)
            ->first();

        if (!$token) {
            $token = new Token();
            $newToken = true;
            $token->user_id = $userId->id;
        }
        $token->token = $rememberMe;
        $token->expires_on = Carbon::now()->addMinutes(30);
        $token->ip = '121';

        if ($newToken = true) {
            $token->save();
        }
        $token->update();
        return true;
        //            $request->session()->regenerate();
//            $request->session()->regenerateToken();
//            $request->session()->invalidate();
    }


//    public static function redirectRole()
//    {
//        if (User::getRole() === 'admin') {
//            return redirect(route('far.index'));
//        }
//        return redirect(route('index'));
//    }
}
