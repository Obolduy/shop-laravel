<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('adminlogin');
        }
        
        if (password_verify($request->password, '123')) {
            return redirect('/admin');
        }
    }

    public function showusers()
    {
        $users = DB::table('users')
                ->join('names', 'names.user_id', '=', 'users.id')
                ->join('surnames', 'surnames.user_id', '=', 'users.id')
                ->join('countries', 'countries.id', '=', 'users.country_id')
                ->join('states', 'states.id', '=', 'users.state_id')
                ->join('cities', 'cities.id', '=', 'users.city_id')
                ->join('districts', 'districts.id', '=', 'users.district_id')
                ->join('streets', 'streets.id', '=', 'users.street_id')
                ->join('houses', 'houses.id', '=', 'users.house_id')
                ->select('users.login', 'users.email', 'users.id', 'names.name', 'surnames.surname',
                'countries.country', 'states.state', 'cities.city', 'districts.district',
                'streets.street', 'houses.house')->get();

        return view('adminshowusers', ['users' => $users]);
    }

    public function showshops()
    {
        $shops = DB::select('select * from shops')->get();

        return view('adminshowshops', ['shops' => $shops]);
    }

    public function showlots()
    {
        $lots = DB::select('select * from lots')->get();

        return view('adminshowlots', ['lots' => $lots]);
    }

    public function showreviews()
    {
        $reviews = DB::select('select * from reviews')->get();

        return view('adminshowreviews', ['reviews' => $reviews]);
    }
}
