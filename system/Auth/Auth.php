<?php

namespace System\Auth;

use App\User;
use system\Session\Session;


class Auth
{
    private $redirectTo = "/login";

    private function userMethod()
    {
        // si notre user est trouvé on le redirige vers le dashbord
        if(!Session::get('user'))
        {
            return redirect($this->redirectTo);
        }
        $user = User::find(Session::get('user'));

        if(empty($user))
        {
            Session::remove('user');
            return redirect($this->redirectTo);
        }

        
    }
}