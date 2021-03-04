<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class CartController extends Controller
{
    public function showcart()
    {
        $user_id = Auth::id();

        if (!Schema::hasTable("cart_$user_id")) {
            $message = 'В Вашей корзине пусто!';

            return view('showcart', ['message' => $message]);
        } else {
            $lots = DB::table("cart_$user_id")
                    ->join('lots', 'lots.id', '=', "cart_$user_id.lot_id")
                    ->select("cart_$user_id.*", 'lots.id', 'lots.lot_name', 'lots.price', 'lots.category_id', 'lots.subcategory_id')->get();

            return view('showcart', ['lots' => $lots]);
        }
    }

    public function addtocart($lot_id)
    {
        $user_id = Auth::id();

        if (!Schema::hasTable("cart_$user_id")) {
            DB::statement("create table cart_$user_id 
            (
                lot_id int not null
            )");
        }

        DB::insert("insert into cart_$user_id (lot_id) values (?)", [$lot_id]);

        return redirect()->intended();
    }

    public function deletefromcart($lot_id)
    {
        $user_id = Auth::id();

        DB::table("cart_$user_id")->where('lot_id', '=', $lot_id)->delete();

        if (DB::table("cart_$user_id")->first() == null) {
            DB::statement("drop table cart_$user_id");
        }

        return redirect('catalog/all');
    }

    public function payform(Request $request)
    {
        if ($request->isMethod('get')) {
            $user_info = DB::table('users')
                    ->join('names', 'names.id', '=', 'users.name_id')
                    ->join('surnames', 'surnames.id', '=', 'users.surname_id')
                    ->join('country', 'country.id', '=', 'users.country_id')
                    ->join('region', 'region.id', '=', 'users.state_id')
                    ->join('city', 'city.id', '=', 'users.city_id')
                    ->join('districts', 'districts.id', '=', 'users.district_id')
                    ->join('streets', 'streets.id', '=', 'users.street_id')
                    ->join('houses', 'houses.id', '=', 'users.house_id')
                    ->select('users.login', 'users.email', 'users.photo', 'names.name',
                             'surnames.surname', 'country.country_name', 'region.region_name', 'city.city_name', 'districts.district',
                             'streets.street', 'houses.house')
                    ->where('users.id', '=', Auth::id())
                    ->get();

            return view('payform', ['user_info' => $user_info]);
        }

        $validated = $request->validate([
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'district' => 'required',
            'street' => 'required',
            'house' => 'required',
            'credit_card' => 'required|digits_between:15,19',
            'code' => 'required|digits:3',
            'name' => 'required|alpha',
            'surname' => 'required|alpha',
            'month' => 'required|digits:2',
            'year' => 'required|digits:4'
        ]);

        $user_id = Auth::user()->id;

        DB::table('lots')
            ->join("cart_$user_id", "cart_$user_id.lot_id", '=', 'lots.id')
            ->select('lots.count')
            ->decrement('lots.count');

        return redirect('/cart/buy/payment/success');
    }

    public function paymentsuccess()
    {
        $user_id = Auth::user()->id;
        
        DB::statement("drop table cart_$user_id");

        return view('paymentsuccess');
    }
}