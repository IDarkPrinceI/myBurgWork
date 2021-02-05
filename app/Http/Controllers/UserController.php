<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegistrationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function login()
    {
        return view('user.login');
    }


    public function authenticate(Request $request)
    {
        $remember = true;
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
//            dd($request);
//            dd(User::getRole(Auth::user()));

            return redirect(route('index'));

        }
//        dd($request->all());
        return back()->withErrors([
            'Неверный e-mail или пароль'
//            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    public function create()
    {
        return view('user.register');
    }


    public function store(UserRegistrationRequest $request)
    {
//        $credentials = $request->only('email', 'password');
//        dd($credentials);
        $user = User::registration($request);
//        Auth::login($user);

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
