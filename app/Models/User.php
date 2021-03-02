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


    public static function setRememberMeCache($remember = null)
    {
        $randomByteCache = bin2hex(random_bytes(24));
        if (Cache::has('rememberMe')) {
            Cache::forget('rememberMe');
        }
        if ($remember === 'on') {
            $ttl = 432000;
        } else $ttl = 1800;
//        $ttl = $remember ? 432000 : 1800;
        Cache::add('rememberMe', $randomByteCache, $ttl);
        return $randomByteCache;
    }


    public static function authentication($request, $user = null)
    {
        $remember = \request()->get('rememberMe') ?? null;

        $randomByteCache = User::setRememberMeCache($remember);
        $rememberMe = Hash::make($randomByteCache);
        $time = $remember ? Carbon::now()->addHours(5) : Carbon::now()->addMinutes(30);
        $newToken = false;

        $userId = User::query()
            ->select('id')
            ->where('email', $request['email'])
            ->first();

        $token = Token::query()
            ->select('*')
            ->where('user_id', $user->id ?? $userId->id)
            ->first();

        if (User::writeToken($rememberMe, $userId, $newToken, $time, $token)) {
            return true;
        } else {
            return false;
        }
    }


    public static function getIp()
    {
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return server ip when no client ip found
    }


    public static function writeToken($rememberMe, $userId, $newToken, $time, $token = null)
    {
        if (!$token) {
            $token = new Token();
            $newToken = true;
            $token->user_id = $userId->id;
        }
        $token->token = $rememberMe;
        $token->expires_on = $time;
        $token->ip = User::getIp();
        $token->login_time = Carbon::now();

        if ($newToken = true) {
            $token->save();
        } else {
            $token->update();
        }
        return true;
    }


    public static function authenticationMiddleware($role)
    {
        $cacheKey= Cache::get('rememberMe');
        $user = User::getRole();
        $userId = Auth::id();

        $dbToken = Token::query()
            ->select('token', 'expires_on', 'ip')
            ->where('user_id', $userId)
            ->first();

        if ($cacheKey !== null && $user !== null && $userId !== null && $dbToken !== null) {
        if (Auth::check()
            && ($user === $role)
            && Hash::check($cacheKey,  $dbToken->token)
            && (Carbon::now() < $dbToken->expires_on)
            && (User::getIp() === $dbToken->ip)) {
            return true;
        }
        return false;
        }
    }
}
