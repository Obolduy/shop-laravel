<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function createshop(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('createshop');
        }

        DB::insert('insert into shops (shop_name, user_id, creation_time) values (?, ?, ?)',
            [htmlspecialchars($request->title), Auth::id(), now()]); //

        return redirect();
    }

    public function showshop()
    {
        $lots = DB::select('select id, lot_name, price, count from lots where user_id = ?', [Auth::id()])->get();

        return view('showshop', ['lots' => $lots]);
    }

    public function changeshop(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('changeshop');
        }

        DB::update('update shops set shop_name = ? where user_id = ?', [htmlspecialchars($request->title), Auth::id()]); /////

        return redirect();
    }

    public function manageshoplots()
    {
        $lots = DB::table('shops')
                ->join('lots', 'shops.id', '=', 'lots.shop_id')
                ->select('lots.id', 'lots.lot_name', 'lots.count', 'lots.price')
                ->where('shops.user_id', '=', Auth::id())->get();

        return view('changeshop', ['lots' => $lots]);
    }

    public function deleteshop($shop, Request $request)
    {
        if (Auth::attempt(['password' => $password])) {
            $shop = DB::select('select * from shops where user_id = ?', [Auth::id()])->get();
            DB::delete('delete lots where shop_id = ?', [$shop]);
            DB::delete('delete shops where user_id = ?', [Auth::id()]);

            return redirect();
        }
    }

    public function showothershop($shop_name)
    {
        $lots = DB::select('select id, lot_name, price, count from lots where name = ?', [$shop_name])->get();

        return view('showothershop', ['lots' => $lots]);
    }
}
