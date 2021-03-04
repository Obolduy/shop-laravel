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
        
        if ($request->password == '123') {
            
            $request->session()->put(['adminauth' => 1]);

            return redirect()->route('adminmain');
        } else {
            echo 'efff';
        }
    }

    public function showusers()
    {
        $users = DB::table('users')
                ->leftJoin('names', 'names.user_id', '=', 'users.id')
                ->leftJoin('surnames', 'surnames.user_id', '=', 'users.id')
                ->leftJoin('countries', 'countries.id', '=', 'users.country_id')
                ->leftJoin('states', 'states.id', '=', 'users.state_id')
                ->leftJoin('cities', 'cities.id', '=', 'users.city_id')
                ->leftJoin('districts', 'districts.id', '=', 'users.district_id')
                ->leftJoin('streets', 'streets.id', '=', 'users.street_id')
                ->leftJoin('houses', 'houses.id', '=', 'users.house_id')
                ->select('users.login', 'users.email', 'users.id', 'names.name', 'surnames.surname',
                    'countries.country', 'states.state', 'cities.city', 'districts.district',
                    'streets.street', 'houses.house', 'users.registration_time')
                ->get();

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
                ->leftJoin('shops', 'lots.shop_id', '=', 'shops.id')
                ->leftJoin('categories', 'lots.category_id', '=', 'categories.id')
                ->leftJoin('subcategories', 'lots.subcategory_id', '=', 'subcategories.id')
                ->select('lots.lot_name', 'lots.id', 'lots.price', 'lots.created_at',
                    'lots.count', 'categories.category', 'subcategories.subcategory', 'shops.shop_name')
                ->get();

        return view('adminshowlots', ['lots' => $lots]);
    }

    public function showreviews()
    {
        $reviews = DB::table('reviews')
                    ->leftJoin('lots', 'lots.id', '=', 'reviews.lot_id')
                    ->leftJoin('users', 'users.id', '=', 'reviews.user_id')
                    ->leftJoin('shops', 'lots.shop_id', '=', 'shops.id')
                    ->select('lots.lot_name', 'shops.shop_name', 'reviews.id',
                        'lots.subcategory_id', 'lots.category_id', 'reviews.lot_id',
                        'reviews.title', 'reviews.created_at', 'users.login')
                    ->get();

        return view('adminshowreviews', ['reviews' => $reviews]);
    }
}
