<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminShopsManageController extends Controller
{
    public function changeshop(Request $request, $id)
    {
        $shop = DB::table('shops')
                ->join('users', 'users.id', '=', 'shops.user_id')
                ->select('shops.shop_name', 'shops.id', 'shops.shop_name')
                ->where('shops.id', '=', $id)->get();
        
        if ($request->isMethod('get')) {
            return view('adminchangeshop', ['shop' => $shop]);
        }

        DB::update('update shops set shop_name = ?, shop_description = ?, updated_at = ? where id = ?',
            [$request->shop_name, $request->shop_description, now(), $id]);

        return redirect();
    }

    public function deleteshop($id)
    {
        DB::delete('delete shops where id = ?', [$id]);
        DB::delete('delete lots where shop_id = ?', [$id]);

        return redirect();
    }
}
