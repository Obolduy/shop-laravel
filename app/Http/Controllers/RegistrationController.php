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

        $user = DB::select('select id from users where login = ?', [$request->login]);
        
        foreach ($user as $user_id) {
            DB::insert('insert into names (name, user_id) values (?, ?)', [$request->name, $user_id->id]);
            DB::insert('insert into surnames (surname, user_id) values (?, ?)', [$request->surname, $user_id->id]);
            DB::insert('insert into countries (country, user_id) values (?, ?)', [$request->country, $user_id->id]);
            DB::insert('insert into states (state, user_id) values (?, ?)', [$request->state, $user_id->id]);
            DB::insert('insert into cities (city, user_id) values (?, ?)', [$request->city, $user_id->id]);
            DB::insert('insert into districts (district, user_id) values (?, ?)', [$request->district, $user_id->id]);
            DB::insert('insert into streets (street, user_id) values (?, ?)', [$request->street, $user_id->id]);
            DB::insert('insert into houses (house, user_id) values (?, ?)', [$request->house, $user_id->id]);

            $data = DB::table('users')
                    ->join('names', 'names.user_id', '=', 'users.id')
                    ->join('surnames', 'surnames.user_id', '=', 'users.id')
                    ->join('countries', 'countries.user_id', '=', 'users.id')
                    ->join('states', 'states.user_id', '=', 'users.id')
                    ->join('cities', 'cities.user_id', '=', 'users.id')
                    ->join('districts', 'districts.user_id', '=', 'users.id')
                    ->join('streets', 'streets.user_id', '=', 'users.id')
                    ->join('houses', 'houses.user_id', '=', 'users.id')
                    ->select('names.id as name_id', 'surnames.id as surname_id', 'countries.id as country_id', 'states.id as state_id',
                        'cities.id as city_id', 'districts.id as district_id', 'streets.id as street_id', 'houses.id as house_id')
                    ->where('users.id', '=', $user_id->id)->get();

            foreach ($data as $elem) {
                DB::update(
                    "update users set name_id = ?, surname_id = ?, country_id = ?,
                    state_id = ?, city_id = ?, district_id = ?,
                    street_id = ?, house_id = ? where login = ?",
                    [$elem->name_id, $elem->surname_id, $elem->country_id,
                    $elem->state_id, $elem->city_id, $elem->district_id,
                    $elem->street_id, $elem->house_id, $request->login]
                );
            }
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            event(new Registered(Auth::user()));

            $request->session()->regenerate();

            $request->session()->put(['auth' => 1]);

            return redirect()->intended();
        }
    }
}
