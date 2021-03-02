<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminLotsManageController extends Controller
{
    public function changelot(Request $request, $id)
    {
        $lot = DB::select('select * from lots where id = ?', [$id]);
        
        if ($request->isMethod('get')) {
            return view('adminchangelot', ['lot' => $lot]);
        }

        DB::update('update lots set lot_name = ?, lot_description = ?, price = ?, count = ?, updated_at = ? where id = ?',
            [$request->lot_name, $request->lot_description, $request->price, $request->count, now(), $id]);

        return redirect('/');
    }

    public function deletelot($id)
    {
        DB::delete('delete from lots where id = ?', [$id]);

        return redirect('/');
    }
}
