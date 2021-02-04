<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRegistrationRequest;
use Illuminate\Http\Request;

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
        dd($request->all());
    }

}
