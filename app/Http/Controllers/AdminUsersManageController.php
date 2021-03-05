<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class AdminUsersManageController extends Controller
{
    public function changeuser(Request $request, $id)
    {
        $user = DB::table('users')
                    ->leftJoin('names', 'names.id', '=', 'users.name_id')
                    ->leftJoin('surnames', 'surnames.id', '=', 'users.surname_id')
                    ->leftJoin('districts', 'districts.id', '=', 'users.district_id')
                    ->leftJoin('streets', 'streets.id', '=', 'users.street_id')
                    ->leftJoin('houses', 'houses.id', '=', 'users.house_id')
                    ->select('users.login', 'users.email', 'users.email_verified_at', 'users.photo', 'names.name',
                             'surnames.surname', 'districts.district', 'streets.street', 'houses.house', 'users.id')
                    ->where('users.id', '=', $id)
                    ->get();
        
        if ($request->isMethod('get')) {
            return view('adminchangeuser', ['user' => $user]);
        }

        DB::update("update names set name = ? where user_id = ?", [$request->name, $id]);
        DB::update("update surnames set surname = ? where user_id = ?", [$request->surname, $id]);
        DB::update("update districts set district = ? where user_id = ?", [$request->district, $id]);
        DB::update("update streets set street = ? where user_id = ?", [$request->street, $id]);
        DB::update("update houses set house = ? where user_id = ?", [$request->house, $id]);
        DB::update("update users set login = ?, email = ? where id = ?", [$request->login, $request->email, $id]);

        return redirect('/');
    }

    public function deleteuser($id)
    {
        if (Schema::hasTable("cart_$id")) {
            DB::table("cart_$id")->delete();
        }
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

        return redirect('/');
    }
}
