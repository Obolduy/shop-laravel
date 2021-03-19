<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redis;
use Illuminate\Auth\Events\Registered;

class RegistrationController extends Controller
{
    public function registration(Request $request)
    {
        if ($request->isMethod('get')) {
            $countries = DB::select('select id, country_name from country');

            return view('registration', ['countries' => $countries]);
        }

        $validated = $request->validate([
            'login' => 'required|between:4,32|unique:users,login|alpha_dash',
            'password' => 'required|between:6,32|alpha_dash|different:login',
            'confirm_password' => 'required|same:password',
            'email' => 'required|unique:users,email|different:login, password',
            'name' => 'required|max:32|alpha',
            'surname' => 'required|max:32|alpha'
        ]);

        Redis::set('login', strip_tags($request->login));
        Redis::set('password', $request->password);
        Redis::set('email', strip_tags($request->email));
        Redis::set('country_id', $request->country);
        Redis::set('name', strip_tags($request->name));
        Redis::set('surname', strip_tags($request->surname));
        
        if ($request->hasFile('photo')) {
            $rawphoto = Storage::put('public/avatars', $request->photo);
            $photo = preg_replace('#public/avatars/#', '', $rawphoto);

            Redis::set('photo', $photo);
        }

        return redirect()->route('registration.state');
    }

    public function registrationstate(Request $request)
    {
        if ($request->isMethod('get')) {
            $regions = DB::select('select id, region_name from region where country_id = ?', [Redis::get('country_id')]);

            return view('registrationregion', ['regions' => $regions]);
        }

        Redis::set('state_id', strip_tags($request->state));

        return redirect()->route('registration.city');
    }

    public function registrationcity(Request $request)
    {
        if ($request->isMethod('get')) {
            $cities = DB::select('select id, city_name from city where region_id = ?', [Redis::get('state_id')]);

            return view('registrationcity', ['cities' => $cities]);
        }

        DB::insert('insert into users (login, password, email, country_id, registration_time, status_id, ban_id, state_id, city_id)
                values (?, ?, ?, ?, ?, ?, ?, ?, ?)', [Redis::get('login'), Hash::make(Redis::get('password')),
                    Redis::get('email'), Redis::get('country_id'), now(), 1, 0, Redis::get('state_id'), $request->city]);

        $user = DB::select('select id from users where email = ?', [Redis::get('email')]);

        foreach($user as $user_id) {
            DB::insert('insert into districts (district, user_id) values (?, ?)', [strip_tags($request->district), $user_id->id]);
            DB::insert('insert into streets (street, user_id) values (?, ?)', [strip_tags($request->street), $user_id->id]);
            DB::insert('insert into houses (house, user_id) values (?, ?)', [strip_tags($request->house), $user_id->id]);
            DB::insert('insert into names (name, user_id) values (?, ?)', [Redis::get('name'), $user_id->id]);
            DB::insert('insert into surnames (surname, user_id) values (?, ?)', [Redis::get('surname'), $user_id->id]);
            
            $districts = DB::select('select id from districts where user_id = ?', [$user_id->id]);
            foreach ($districts as $elem) {
                DB::update('update users set district_id = ? where id = ?', [$elem->id, $user_id->id]);
            }

            $streets = DB::select('select id from streets where user_id = ?', [$user_id->id]);
            foreach ($streets as $elem) {
                DB::update('update users set street_id = ? where id = ?', [$elem->id, $user_id->id]);
            }

            $houses = DB::select('select id from houses where user_id = ?', [$user_id->id]);
            foreach ($houses as $elem) {
                DB::update('update users set house_id = ? where id = ?', [$elem->id, $user_id->id]);
            }

            $names = DB::select('select id from names where user_id = ?', [$user_id->id]);
            foreach ($names as $elem) {
                DB::update('update users set name_id = ? where id = ?', [$elem->id, $user_id->id]);
            }

            $surnames = DB::select('select id from surnames where user_id = ?', [$user_id->id]);
            foreach ($surnames as $elem) {
                DB::update('update users set surname_id = ? where id = ?', [$elem->id, $user_id->id]);
            }

            if (Redis::get('photo')) {
                DB::update('update users set photo = ? where id = ?', [Redis::get('photo'), $user_id->id]);
            }
        }
        // Переделать.

        if (Auth::attempt(['email' => Redis::get('email'), 'password' => Redis::get('password')])) {

            $request->session()->regenerate();

            $request->session()->put(['auth' => 1]);
        }

        Redis::flushdb();

        event(new Registered(Auth::user()));

        return redirect('/');
    }
}
