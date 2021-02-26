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
                    'streets.street', 'houses.house');

        return view('adminshowusers', ['users' => $users]);
    }

    public function showshops()
    {
        $shops = DB::select('select id, shop_name, created_at from shops');

        return view('adminshowshops', ['shops' => $shops]);
    }

    public function showlots()
    {
        $lots = DB::table('lots')
                ->join('shops', 'lots.shop_id', '=', 'shops.id')
                ->join('categories', 'lots.category_id', '=', 'categories.id')
                ->join('subcategories', 'lots.subcategory_id', '=', 'subcategories.id')
                ->select('lots.lot_name', 'lots.id', 'lots.price', 'lots.created_at',
                    'lots.count', 'categories.category', 'subcategories.subcategory', 'shops.shop_name');

        return view('adminshowlots', ['lots' => $lots]);
    }

    public function showreviews()
    {
        $reviews = DB::table('reviews')
                    ->join('shops', 'lots.shop_id', '=', 'shops.id')
                    ->join('lots', 'lots.id', '=', 'reviews.lot_id')
                    ->join('users', 'users.id', '=', 'reviews.user_id')
                    ->select('lots.lot_name', 'shops.shop_name', 'reviews.id',
                        'lots.subcategory_id', 'lots.category_id', 'reviews.lot_id',
                        'reviews.title', 'reviews.created_at', 'users.login');

        return view('adminshowreviews', ['reviews' => $reviews]);
    }
}
