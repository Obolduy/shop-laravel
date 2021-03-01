<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function showprofile()
    {
        $info = DB::table('users')
                    ->leftJoin('names', 'names.id', '=', 'users.name_id')
                    ->leftJoin('surnames', 'surnames.id', '=', 'users.surname_id')
                    ->leftJoin('countries', 'countries.id', '=', 'users.country_id')
                    ->leftJoin('states', 'states.id', '=', 'users.state_id')
                    ->leftJoin('cities', 'cities.id', '=', 'users.city_id')
                    ->leftJoin('districts', 'districts.id', '=', 'users.district_id')
                    ->leftJoin('streets', 'streets.id', '=', 'users.street_id')
                    ->leftJoin('houses', 'houses.id', '=', 'users.house_id')
                    ->leftJoin('shops', 'shops.id', '=', 'users.shop_id')
                    ->select('users.login', 'users.email', 'users.email_verified_at', 'users.photo', 'names.name',
                             'surnames.surname', 'countries.country', 'states.state', 'cities.city', 'districts.district',
                             'streets.street', 'houses.house', 'shops.shop_name')
                    ->where('users.id', '=', Auth::id())
                    ->get();

        return view('userinfo', ['info' => $info]);
    }

    public function changeprofile(Request $request)
    {
        if ($request->isMethod('get')) {
            $user = DB::table('users')
                    ->join('names', 'names.id', '=', 'users.name_id')
                    ->join('surnames', 'surnames.id', '=', 'users.surname_id')
                    ->join('countries', 'countries.id', '=', 'users.country_id')
                    ->join('states', 'states.id', '=', 'users.state_id')
                    ->join('cities', 'cities.id', '=', 'users.city_id')
                    ->join('districts', 'districts.id', '=', 'users.district_id')
                    ->join('streets', 'streets.id', '=', 'users.street_id')
                    ->join('houses', 'houses.id', '=', 'users.house_id')
                    ->select('users.login', 'users.email', 'users.id', 'names.name', 'surnames.surname',
                             'countries.country', 'states.state', 'cities.city', 'districts.district',
                             'streets.street', 'houses.house')
                    ->where('users.id', '=', Auth::id())
                    ->get();
            
            return view('changeprofile', ['user' => $user]);
        }

        Validator::make($request->all(), [
            'login' => [
                'required', Rule::unique('users')->ignore(Auth::id()),
                'between:4,32', 'alpha_dash'
            ],
            'email' => [
                'required', Rule::unique('users')->ignore(Auth::id()), 'different:login'
            ],
            'name' => [
                'required', 'max:32', 'alpha'
            ],
            'surname' => [
                'required', 'max:32', 'alpha'
            ],
            'password' => [
                'required', 'between:6,32', 'alpha_dash', 'different:login'
            ],
            'country' => [
                'required', 'max:32', 'alpha'
            ],
            'state' => [
                'required'
            ],
            'city' => [
                'required'
            ],
            'district' => [
                'required'
            ],
            'street' => [
                'required'
            ],
            'house' => [
                'required'
            ],
            'new_password' => [
                'different:login,password', 'between:6,32', 'alpha_dash'
            ]
        ]);

        if (password_verify($request->password, Auth::user()->password)) {
            DB::update("update names set name = ? where user_id = ?", [$request->name, Auth::id()]);
            DB::update("update surnames set surname = ? where user_id = ?", [$request->surname, Auth::id()]);
            DB::update("update countries set country = ? where user_id = ?", [$request->country, Auth::id()]);
            DB::update("update states set state = ? where user_id = ?", [$request->state, Auth::id()]);
            DB::update("update cities set city = ? where user_id = ?", [$request->city, Auth::id()]);
            DB::update("update districts set district = ? where user_id = ?", [$request->district, Auth::id()]);
            DB::update("update streets set street = ? where user_id = ?", [$request->street, Auth::id()]);
            DB::update("update houses set house = ? where user_id = ?", [$request->house, Auth::id()]);

            if (!empty($request->new_password)) {
                $password = Hash::make($request->new_password);

                DB::update("update users set password = ? where id = ?", [$password, Auth::id()]);
            }

          //  if ($request->hasFile('photo')) {
               //
           // } else {
                DB::update("update users set login = ?, email = ? where id = ?", [$request->login, $request->email, Auth::id()]);
           // }

            return redirect("/profile");
        }

    }

    public function deleteprofile(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('deleteprofile');
        }

        if (password_verify($request->password, Auth::user()->password)) {
            if (Auth::user()->photo) {
                Storage::delete('public/imagestorage/avatars/'.Auth::user()->photo);
            }

            $user_id = Auth::id();

            if (Schema::hasTable("cart_$user_id")) {
                DB::table("cart_$user_id")->delete();
            }
            DB::table('names')->where('user_id', Auth::id())->delete();
            DB::table('surnames')->where('user_id', Auth::id())->delete();
            DB::table('countries')->where('user_id', Auth::id())->delete();
            DB::table('states')->where('user_id', Auth::id())->delete();
            DB::table('cities')->where('user_id', Auth::id())->delete();
            DB::table('districts')->where('user_id', Auth::id())->delete();
            DB::table('streets')->where('user_id', Auth::id())->delete();
            DB::table('houses')->where('user_id', Auth::id())->delete();
            DB::table('shops')->where('user_id', Auth::id())->delete();
            DB::table('users')->where('id', Auth::id())->delete();

            if (isset($_COOKIE['remember_me'])) {
                setcookie('remember_me', '', time());
            }

            $request->session()->invalidate();
            $request->session()->regenerateToken();

            Auth::logout();

            return redirect('/');
        }
    }

    public function showusershop()
    {
        $shop = DB::table('shops')
                ->leftJoin('lots', 'lots.shop_id', '=', 'shops.id')
                ->select('shops.shop_name', 'lots.lot_name', 'lots.price', 
                    'lots.id', 'lots.subcategory_id', 'lots.category_id', 'lots.count')
                ->where('shops.user_id', '=', Auth::id())
                ->get();
        
        return view('showusershop', ['shop' => $shop]);
    }

    public function showuserreviews()
    {
        $reviews = DB::table('reviews')
                ->leftJoin('lots', 'reviews.lot_id', '=', 'lots.id')
                ->select('lots.lot_name', 'reviews.title', 'reviews.text',
                    'lots.subcategory_id', 'lots.category_id', 'lots.id', 'reviews.created_at')
                ->where('reviews.user_id', '=', Auth::user()->id)
                ->get();
        
        return view('showuserreviews', ['reviews' => $reviews]);
    }
}