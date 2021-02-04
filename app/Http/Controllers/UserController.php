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


    public function create()
    {
        return view('user.register');
    }

    public function store(UserRegistrationRequest $request)
    {
        $user = User::registration($request);

        Auth::login($user);

        session()->flash('success', 'Вы успешно зарегистрировались!');
        return redirect(route('index'));
    }

}
