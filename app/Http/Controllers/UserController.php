<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegistrationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
//    Страница логирования
    public function login()
    {
        return view('user.login');
    }

//    Аутентификация
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials) && User::authentication($request)) {

            if (User::getRole() === 'admin') {
                session(['role' => 'far']);
                return redirect()->route('far.index')->with('success', 'Вы успешно вошли на сайт!');
            }
            session(['role' => 'user']);
            return redirect()->route('index')->with('success', 'Вы успешно вошли на сайт!');
        }
        return back()->withErrors([
            'Неверный e-mail или пароль'
        ]);
    }

//    Страница регистрации
    public function create()
    {
        return view('user.register');
    }

//    Регистрация
    public function store(UserRegistrationRequest $request)
    {
        $user = User::registration($request);
        Auth::login($user);
        if (User::authentication($request, $user)) {
            return redirect()->route('index')->with('success', 'Вы успешно зарегистрировались!');
        }

        return redirect()->route('index');
    }

//    Разлогирование
    public function logout(Request $request)
    {
        Auth::logout();
        session()->forget('role');
        $request->session()->regenerateToken();
        $request->session()->invalidate();

        return redirect()->route('index');

    }

}
