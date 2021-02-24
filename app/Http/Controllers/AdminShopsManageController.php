<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminShopsManageController extends Controller
{
    public function changeshop($id)
    {
        $shop = DB::table('shops')
                ->join('users', 'users.id', '=', 'shops.user_id')
                ->join('lots', 'shops.id', '=', 'lots.shop_id')
                ->select('lots.lot_name', 'lots.id', 'users.login', 'shops.id', 'shops.shop_name')
                ->where('shops.id', '=', $id)->get();
        
        if ($request->isMethod('get')) {
            return view('changeshop', ['shop' => $shop]);
        }

        DB::update('update shops set shop_name = ? where id = ?',
            [$request->name, $id]); //

        return redirect();
    }

    public function deleteshop($id)
    {
        DB::delete('delete shops where id = ?', [$id]);
        DB::delete('delete lots where shop_id = ?', [$id]);

        return redirect();
    }
}
