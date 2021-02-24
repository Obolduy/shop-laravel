<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class RegistrationController extends Controller
{
    public function registration(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('registration');
        }

        $validated = $request->validate([
            'login' => 'required|between:4,32|unique:users,login|alpha_dash',
            'password' => 'required|between:6,32|alpha_dash|different:login',
            'confirmPassword' => 'required|same:password',
            'email' => 'required|unique:users,email|different:login, password',
            'name' => 'required|max:32|alpha',
            'surname' => 'required|max:32|alpha',
            'country' => 'required|max:32',
            'state' => 'required|max:32',
            'city' => 'required|max:32',
            'district' => 'required|max:32',
            'street' => 'required|max:32',
            'house' => 'required|max:32'
        ]);

        $password = Hash::make($request->password);

        // DB::insert('insert into users (login, password, email, country_id, registration_time, status_id, ban_id)
        //         values (?, ?, ?, ?, ?, ?, ?)', [$request->login, $password, $request->email, $request->country_id, now(), 1, 0]);

        // $user = DB::select('select id from users where login = ?', [$request->login]);
        
        // foreach ($user as $elem) {
        //     DB::insert('insert into names (name, user_login, user_id) values (?, ?, ?)', [$request->name, $request->login, $elem->id]);

        //     DB::insert('insert into surnames (surname, user_login, user_id) values (?, ?, ?)', [$request->surname, $request->login, $elem->id]);
        // }
        
        // $name = DB::select('select id from names where user_login = ?', [$request->login]);

        // $surname = DB::select('select id from surnames where user_login = ?', [$request->login]);

        // foreach ($name as $elem) {
        //     DB::update("update users set name_id = $elem->id where login = ?", [$request->login]);
        // }

        // foreach ($surname as $elem) {
        //     DB::update("update users set surname_id = $elem->id where login = ?", [$request->login]);
        // }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            event(new Registered(Auth::user()));

            $request->session()->regenerate();

            $request->session()->put(['auth' => 1]);

            return redirect()->intended();
        }
    }
}
