<?php
namespace System\Auth;

use App\User;
use System\Session\Session;

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
        else 
        {
            return $user;
        }
    }

    private function checkMethod()
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
        else 
        {
            return true;
        }
    }

    private function checkLoginMethod()
    {
        // si notre user est trouvé on le redirige vers le dashbord
        if(!Session::get('user'))
        {
            return false;
        }
        $user = User::find(Session::get('user'));

        if(empty($user))
        {
            return false;
        }
        else 
        {
            return true;
        }
    }
    private function loginByEmailMethod($email, $password)
    {
        //on recherche l'email dans la base de données
        $user = User::where('email', $email)->get();
        if(empty($user))
        {
            error('login', 'There is no user with this e-mail');
            return false;
        }
        if(password_verify((string) $password, (string) $user[0]->password) && $user[0]->is_active == 1)
        {
            Session::set("user", $user[0]->id);
            return (bool) true;
        }
        else
        {
            error("login", 'The password is wrong');
            return false;
        }
    }

    private function loginMethod($id)
    {
        $user = User::find($id);
        if(empty($user))
        {
            error('login', 'User not found');
            return false;
        }
        else
        {
            Session::set('user',$user->id);
            return true; 
        }
    }

    private function logoutMethod()
    {
        Session::remove('user');
    }

    public function __call($name, $arguments)
    {
        return $this->methodCaller($name, $arguments);
    }
    public static function __callStatic($name, $arguments)
    {
        $instance = new self();
        return $instance->methodCaller($name, $arguments);
    }

    private function methodCaller($method, $arguments)
    {
        $suffix = 'Method';
        $methodName = $method.$suffix;
        return call_user_func_array(array($this, $methodName), $arguments);
    }
}