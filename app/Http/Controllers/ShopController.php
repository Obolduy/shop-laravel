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

        Validator::make($request->all(), [
            'shop_name' => [
                'required', Rule::unique('shops')->ignore($shop),
                'between:4,32', 'alpha_dash'
            ],
            'shop_description' => [
                'required'
            ]
        ]);

        DB::insert('insert into shops (shop_name, shop_description, user_id, created_at, updated_at) values (?, ?, ?, ?, ?)',
            [htmlspecialchars($request->shop_name), htmlspecialchars($request->shop_description), Auth::id(), now(), now()]);

        return redirect();
    }

    public function changeshop($shop, Request $request)
    {
        if ($request->isMethod('get')) {
            $shop = DB::select('select shop_name, shop_description from shops where user_id = ?', [Auth::id()]);

            return view('changeshop', ['shop' => $shop]);
        }

        DB::update('update shops set shop_name = ?, shop_description = ?, updated_at = ? where user_id = ?',
            [htmlspecialchars($request->shop_name), htmlspecialchars($request->shop_description), now(), Auth::id()]); /////

        return redirect();
    }

    public function deleteshop($shop, Request $request)
    {
        if ($request->isMethod('get')) {
            return view('deleteshop');
        }

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
