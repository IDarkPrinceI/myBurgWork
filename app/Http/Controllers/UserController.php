<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegistrationRequest;
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
        $credentials = $request->only('email', 'password');
//        $remember = \request()->get('rememberMe') ?? false;
        if (Auth::attempt($credentials) && User::authentication($request)) {

            if (User::getRole() === 'admin') {
                return redirect()->route('far.index')->with('success', 'Вы успешно вошли на сайт!');
            }
            return redirect()->route('index')->with('success', 'Вы успешно вошли на сайт!');
        }
        return back()->withErrors([
            'Неверный e-mail или пароль'
        ]);
    }


    public function create()
    {
        return view('user.register');
    }


    public function store(UserRegistrationRequest $request)
    {
        $user = User::registration($request);
        Auth::login($user);
        if (User::authentication($request, $user)) {
            return redirect()->route('index')->with('success', 'Вы успешно зарегистрировались!');
        };

        return redirect()->route('index');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->regenerateToken();
        $request->session()->invalidate();

        return redirect()->route('index');

    }

}
