<?php

namespace App\Http\Requests\Auth;

use system\Request\Request;

class LoginRequest extends Request
{
    protected function rules()
    {
        return [
            'email' => "required||max:64||email  ",
            'password' => "required"
        ];
    }
}