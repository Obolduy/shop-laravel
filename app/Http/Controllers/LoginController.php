<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('get')) {
            if (Auth::attempt(['remember_token' => $_COOKIE['remember_me']])) {
                $request->session()->regenerate();

                $request->session()->put(['auth' => 1]);

                return redirect()->intended();
            }
            
            return view('login');
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'remember_token' => $request->remember])) {
            $request->session()->regenerate();

            $request->session()->put(['auth' => 1]);

            if ($request->remember == 1) {
                //$remembertoken = DB::select('select remember_token from users where email = ?', [$request->email]);

                foreach($remembertoken as $elem) {
                    setcookie('remember_me', $elem->remember_token, time() + 3600*24*30*365);
                }
            }
            return redirect()->intended();
        }

        return back()->withErrors([
            'email' => 'Email неправильный',
            'password' => 'Пароль неправильный'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        setcookie('remember_me', '', time());

        return redirect('/');
    }
}
