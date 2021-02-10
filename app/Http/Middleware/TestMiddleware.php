<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class TestMiddleware
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
        $cacheKey = session()->get('rememberMe');
//        dd($request->session());
//        dd(Auth::user()->auth_key, Cache::get('rememberMe'));
//        $cacheKey= Cache::get('rememberMe');
//        if (!$cacheKey) {
//            if (Auth::check()) {
//                return $next($request);
//            }
//            if (Auth::check() && session()->get('auth_token') ) {

//            };
//            $cacheKey = session()->get('rememberMe');
//            $cacheKey = $request->session();
//        }
        $dbKey = Auth::user()->auth_key ?? null;
        if (Hash::check($cacheKey,  $dbKey)) {
            return $next($request);

        }
        return redirect(route('login'));
    }
}
