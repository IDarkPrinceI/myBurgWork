<?php

namespace App\Http\Middleware;

use App\Models\Token;
use App\Models\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class UserAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $cacheKey= Cache::get('rememberMe');

        $user = User::getRole();
        $userId = Auth::id();

        $dbToken = Token::query()
            ->select('token', 'expires_on')
            ->where('user_id', $userId)
            ->first();

        if (Auth::check()
            && ($user === 'user' || $user === 'admin')
            && Hash::check($cacheKey,  $dbToken->token)
            && (Carbon::now() < $dbToken->expires_on)) {
            return $next($request);
        }

        return redirect(route('login'));
    }
}
