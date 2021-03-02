<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminShopsManageController extends Controller
{
    public function changeshop(Request $request, $id)
    {
        $shop = DB::select('select id, shop_name, shop_description from shops where id = ?', [$id]);
        
        if ($request->isMethod('get')) {
            return view('adminchangeshop', ['shop' => $shop]);
        }

        DB::update('update shops set shop_name = ?, shop_description = ?, updated_at = ? where id = ?',
            [$request->shop_name, $request->shop_description, now(), $id]);

        return redirect('/');
    }

    public function deleteshop($id)
    {
        DB::delete('delete from shops where id = ?', [$id]);
        DB::delete('delete from lots where shop_id = ?', [$id]);

        return redirect('/');
    }
}
