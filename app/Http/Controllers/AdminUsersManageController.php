<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminUsersManageController extends Controller
{
    public function changeuser($id)
    {
        $user = DB::table('users')
                    ->join('names', 'names.id', '=', 'users.name_id')
                    ->join('surnames', 'surnames.id', '=', 'users.surname_id')
                    ->join('countries', 'countries.id', '=', 'users.country_id')
                    ->join('states', 'states.id', '=', 'users.state_id')
                    ->join('cities', 'cities.id', '=', 'users.city_id')
                    ->join('districts', 'districts.id', '=', 'users.district_id')
                    ->join('streets', 'streets.id', '=', 'users.street_id')
                    ->join('houses', 'houses.id', '=', 'users.house_id')
                    ->join('shops', 'shops.id', '=', 'users.shop_id')
                    ->join('lots', 'shops.id', '=', 'lots.shop_id')
                    ->select('users.login', 'users.email', 'users.email_verified_at', 'users.photo', 'names.name',
                             'surnames.surname', 'countries.country', 'states.state', 'cities.city', 'districts.district',
                             'streets.street', 'houses.house', 'shops.shop_name')
                    ->where('users.id', '=', $id)->get();
        
        if ($request->isMethod('get')) {
            return view('changeuser', ['user' => $user]);
        }

        DB::update("update names set name = ?, user_login = ? where user_id = ?", [$request->name, $request->login, $id]);
        DB::update("update surnames set surname = ?, user_login = ? where user_id = ?", [$request->surname, $request->login, $id]);
        DB::update("update countries set country = ?, user_login = ? where user_id = ?", [$request->country, $request->login, $id]);
        DB::update("update states set state = ?, user_login = ? where user_id = ?", [$request->state, $request->login, $id]);
        DB::update("update cities set city = ?, user_login = ? where user_id = ?", [$request->city, $request->login, $id]);
        DB::update("update districts set district = ?, user_login = ? where user_id = ?", [$request->district, $request->login, $id]);
        DB::update("update streets set street = ?, user_login = ? where user_id = ?", [$request->street, $request->login, $id]);
        DB::update("update houses set house = ?, user_login = ? where user_id = ?", [$request->house, $request->login, $id]);
        DB::update("update users set login = ?, email = ? where id = ?", [$request->login, $request->email, $id]);

        return redirect();
    }

    public function deleteuser($id)
    {
        DB::table('names')->where('user_id', $id)->delete();
        DB::table('surnames')->where('user_id', $id)->delete();
        DB::table('countries')->where('user_id', $id)->delete();
        DB::table('states')->where('user_id', $id)->delete();
        DB::table('cities')->where('user_id', $id)->delete();
        DB::table('districts')->where('user_id', $id)->delete();
        DB::table('streets')->where('user_id', $id)->delete();
        DB::table('houses')->where('user_id', $id)->delete();
        DB::table('shops')->where('user_id', $id)->delete();
        DB::table('users')->where('id', $id)->delete();

        return redirect();
    }
}
