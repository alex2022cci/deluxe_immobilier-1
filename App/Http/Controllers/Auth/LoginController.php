<?php

namespace App\Http\Controllers\Auth;

use System\Auth\Auth;
use App\Http\Requests\Auth\LoginRequest;

class LoginController
{
    private $redirectTo = "/home";

    private $redirectToAdmin = "/admin";

    public function view()
    {
        return view('Auth.login');
    }

    public function login()
    {
        Auth::logout();
        $request = new LoginRequest();
    }
}