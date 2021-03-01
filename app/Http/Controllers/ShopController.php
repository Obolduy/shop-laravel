<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ShopController extends Controller
{
    public function createshop(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('createshop');
        }

        Validator::make($request->all(), [
            'shop_name' => [
                'required', /*Rule::unique('shops')->ignore($shop),*/
                'between:4,32', 'alpha_dash'
            ],
            'shop_description' => [
                'required'
            ]
        ]);

        DB::insert('insert into shops (shop_name, shop_description, user_id, showing, created_at, updated_at) values (?, ?, ?, ?, ?, ?)',
            [htmlspecialchars($request->shop_name), htmlspecialchars($request->shop_description), Auth::id(), 1, now(), now()]);

        $user_shop = DB::select('select id from shops where shop_name = ?', [$request->shop_name]);
        
        foreach($user_shop as $elem) {
            DB::update('update users set shop_id = ? where id = ?', [$elem->id, Auth::id()]);
        }

        return redirect('/profile');
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
        $lots = DB::table('shops')
                ->join('lots', 'lots.shop_id', '=', 'shops.id')
                ->select('lots.id', 'lots.category_id', 'lots.subcategory_id', 'lots.lot_name', 'lots.price', 'lots.count')
                ->where('shops.shop_name', '=', $shop_name);

        return view('showothershop', ['lots' => $lots]);
    }
}
