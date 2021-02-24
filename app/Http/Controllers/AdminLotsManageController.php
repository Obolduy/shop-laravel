<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminLotsManageController extends Controller
{
    public function changelot(Request $request, $id)
    {
        $lot = DB::table('lots')
                ->join('shops', 'shops.id', '=', 'lots.shop_id')
                ->join('users', 'users.id', '=', 'shops.user_id')
                ->select('lots.*', 'users.login', 'shops.shop_name')
                ->where('lots.id', '=', $id)->get();
        
        if ($request->isMethod('get')) {
            return view('changelot', ['lot' => $lot]);
        }

        DB::update('update lots set lot_name = ?, description = ?, price = ?, count = ? where id = ?',
        [$request->name, $request->description, $request->price, $request->count, $id]); //

        return redirect();
    }

    public function deletelot($id)
    {
        DB::delete('delete lots where id = ?', [$id]);

        return redirect();
    }
}
