<?php

namespace App\Http\Controllers\Auth;

class RegisterController
{
    private $redirectTo = "/home";

    private $redirectToAdmin = "/admin";

    public function view()
    {
        return view('auth.register');
    }
}