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
            'confirm_password' => 'required|same:password',
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

        DB::insert('insert into users (login, password, email, registration_time, status_id, ban_id)
                values (?, ?, ?, ?, ?, ?)', [$request->login, Hash::make($request->password), $request->email, now(), 1, 0]);

        $user_id = DB::select('select id from users where login = ?', [$request->login]);
        
        DB::insert('insert into names (name, user_id) values (?, ?)', [$request->name, $user_id]);
        DB::insert('insert into surnames (surname, user_id) values (?, ?)', [$request->surname, $user_id]);
        DB::insert('insert into countries (country, user_id) values (?, ?)', [$request->country, $user_id]);
        DB::insert('insert into states (state, user_id) values (?, ?)', [$request->state, $user_id]);
        DB::insert('insert into cities (city, user_id) values (?, ?)', [$request->city, $user_id]);
        DB::insert('insert into districts (district, user_id) values (?, ?)', [$request->district, $user_id]);
        DB::insert('insert into streets (street, user_id) values (?, ?)', [$request->street, $user_id]);
        DB::insert('insert into houses (house, user_id) values (?, ?)', [$request->house, $user_id]);
        
        $name_id = DB::select('select id from names where user_id = ?', [$user_id]);
        $surname_id = DB::select('select id from surnames where user_id = ?', [$user_id]);
        $country_id = DB::select('select id from countries where user_id = ?', [$user_id]);
        $state_id = DB::select('select id from states where user_id = ?', [$user_id]);
        $city_id = DB::select('select id from cities where user_id = ?', [$user_id]);
        $district_id = DB::select('select id from districts where user_id = ?', [$user_id]);
        $street_id = DB::select('select id from streets where user_id = ?', [$user_id]);
        $house_id = DB::select('select id from houses where user_id = ?', [$user_id]);

        DB::update(
            "update users set name_id = ?, surname_id = ?, country_id = ?,
            state_id = ?, city_id = ?, district_id = ?,
            street_id = ?, house_id = ?, where login = ?",
            [$name_id, $surname_id, $country_id,
            $state_id, $city_id, $district_id,
            $street_id, $house_id, $request->login]
        );

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            event(new Registered(Auth::user()));

            $request->session()->regenerate();

            $request->session()->put(['auth' => 1]);

            return redirect()->intended();
        }
    }
}
