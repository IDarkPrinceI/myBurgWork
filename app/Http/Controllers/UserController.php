<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegistrationRequest;
use App\Models\Authentication;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserController extends Controller
{

    public function login()
    {
        return view('user.login');
    }


    public function authenticate(Request $request)
    {
//        $credentials = $request->only('email', 'password');
//        $remember = \request()->get('rememberMe') ?? false;
////        dd($request);
//        if (Auth::attempt($credentials)) {
//            if (User::getRole() === 'admin') {
//                return redirect(route('far.index'));
//            }
//            return redirect(route('index'));
//        }
//        return back()->withErrors([
//            'Неверный e-mail или пароль'
//        ]);

        $credentials = $request->only('email', 'password');
//        $remember = \request()->get('rememberMe') ?? false;
//        dd($request);
        if (Auth::attempt($credentials)) {
            $randomByteCache = bin2hex(random_bytes(24));
            if (Cache::has('rememberMe')) {
                Cache::forget('rememberMe');
            }
            Cache::add('rememberMe',  $randomByteCache, 1800);

            $rememberMe = Hash::make($randomByteCache);

            $userId = User::query()
                ->select('id')
                ->where('email', $request['email'])
                ->firstOrFail();
            $token = Token::query()
                ->select('*')
                ->where('user_id', $userId->id)
                ->firstOrFail();

            $token->token = $rememberMe;

            $token->expires_on = Carbon::now()->addMinutes(30);
            $token->ip = '124';
            $token->update();

//            $request->session()->regenerate();
//            $request->session()->regenerateToken();
//            $request->session()->invalidate();

            if (User::getRole() === 'admin') {
                return redirect(route('far.index'));
            }
            return redirect(route('index'));
        }
        return back()->withErrors([
            'Неверный e-mail или пароль'
        ]);
    }

//            $user = User::query()
//                ->where('email', $request['email']);
//            if ($remember) {
//                $randomByteCache = bin2hex(random_bytes(24));
//                Cache::put('rememberMe', $randomByteCache, $seconds = 100);
//                $rememberMe = Hash::make($randomByteCache);
////                $user = User::query()
////                    ->where('email', $request['email']);
//                $user->update(['auth_key' => $rememberMe]);
//            }
//            } else {
//                \session(['auth_token' => $user->auth_key]);
//                $randomByteSession = random_bytes(24);
//                \session(['rememberMe' => $randomByteSession]);
//                $rememberMe = Hash::make($randomByteSession);
//                $user = User::query()
//                    ->where('email', $request['email']);
//                $user->update(['auth_key' => $rememberMe]);
//            }
//            $request->session()->regenerate();
//            return true;
//            if (User::getRole() === 'admin') {
//                return redirect(route('far.index'));
//            }
//            return redirect(route('index'));
//        }
////        if (User::authentication($credentials, $request, $remember)) {
//            if (User::getRole() === 'admin') {
//                return redirect(route('far.index'));
//            }
//            return redirect(route('index'));
////        }
//        return back()->withErrors([
//            'Неверный e-mail или пароль'
//        ]);
//    }


    public function create()
    {
//        $testTwo = Token::query()
//            ->where('user_id', '=',2)
//            ->get();
//        dd($testTwo);

        $test = Cache::get('rememberMe');
        dd($test);
        return view('user.register');

//        $table->increments('id');
//        $table->integer('user_id')->unique();
//        $table->string('token');
//        $table->dateTime('expires_on');
//        $table->string('ip');
    }


    public function store(UserRegistrationRequest $request)
    {
        $user = User::registration($request);

        Auth::login($user);

        session()->flash('success', 'Вы успешно зарегистрировались!');
        return redirect(route('index'));
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->regenerateToken();
        $request->session()->invalidate();

        return redirect(route('index'));

    }

}
