<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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

        DB::insert('insert into users (login, password, email, country_id, registration_time, status_id, ban_id)
                values (?, ?, ?, ?, ?, ?, ?)', [htmlspecialchars($request->login), Hash::make($request->password),
                    htmlspecialchars($request->email), $request->country, now(), 1, 0]);

        $user = DB::select('select id from users where login = ?', [htmlspecialchars($request->login)]);
        
        foreach ($user as $user_id) {
            if ($request->hasFile('photo')) {
                $rawphoto = Storage::put('public/avatars', $request->photo);
                $photo = preg_replace('#public/avatars/#', '', $rawphoto);
    
                DB::update('update users set photo = ? where id = ?', [$photo, $user_id->id]);
            }

            DB::insert('insert into names (name, user_id) values (?, ?)', [htmlspecialchars($request->name), $user_id->id]);
            DB::insert('insert into surnames (surname, user_id) values (?, ?)', [htmlspecialchars($request->surname), $user_id->id]);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $request->session()->regenerate();

            $request->session()->put(['auth' => 1]);

            return redirect()->route('registration.state');
        }
    }

    public function registrationstate(Request $request)
    {
        if ($request->isMethod('get')) {
            $regions = DB::select('select id, region_name from region where country_id = ?', [Auth::user()->country_id]);

            return view('registrationregion', ['regions' => $regions]);
        }

        DB::update('update users set state_id = ? where id = ?', [$request->state, Auth::id()]);

        return redirect()->route('registration.city');
    }

    public function registrationcity(Request $request)
    {
        if ($request->isMethod('get')) {
            $cities = DB::select('select id, city_name from city where region_id = ?', [Auth::user()->state_id]);

            return view('registrationcity', ['cities' => $cities]);
        }
        
        DB::insert('insert into districts (district, user_id) values (?, ?)', [htmlspecialchars($request->district), Auth::id()]);
        DB::insert('insert into streets (street, user_id) values (?, ?)', [htmlspecialchars($request->street), Auth::id()]);
        DB::insert('insert into houses (house, user_id) values (?, ?)', [htmlspecialchars($request->house), Auth::id()]);
        DB::update('update users set city_id = ? where id = ?', [$request->city, Auth::id()]);

        $data = DB::table('users')
                    ->join('names', 'names.user_id', '=', 'users.id')
                    ->join('surnames', 'surnames.user_id', '=', 'users.id')
                    ->join('districts', 'districts.user_id', '=', 'users.id')
                    ->join('streets', 'streets.user_id', '=', 'users.id')
                    ->join('houses', 'houses.user_id', '=', 'users.id')
                    ->select('names.id as name_id', 'surnames.id as surname_id', 'districts.id as district_id',
                        'streets.id as street_id', 'houses.id as house_id')
                    ->where('users.id', '=', Auth::id())
                    ->get();

        foreach ($data as $elem) {
            DB::update(
                "update users set name_id = ?, surname_id = ?, district_id = ?,
                street_id = ?, house_id = ? where id = ?",
                [$elem->name_id, $elem->surname_id, $elem->district_id,
                $elem->street_id, $elem->house_id, Auth::id()]
            );
        }

        event(new Registered(Auth::user()));

        return redirect('/');
    }
}
