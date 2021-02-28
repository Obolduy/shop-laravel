<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LotController extends Controller
{
    public function showlot($lot_id)
    {
        $lot = DB::select('select * from lots where id = ?', [$lot_id]);

        $reviews = DB::table('reviews')
                    ->join('users', 'users.id', '=', 'reviews.user_id')
                    ->select('users.login', 'reviews.title', 'reviews.text', 'reviews.created_at')
                    ->where('reviews.lot_id', '=', $lot_id)->get();

        return view('showlot', ['lot' => $lot, 'reviews' => $reviews]);
    }

    public function editlot($lot_id, Request $request)
    {
        if ($request->isMethod('get')) {
            $lot = DB::select('select lot_name, count, lot_description, price from lots where id = ?', [$lot_id]);

            return view('editlot', ['lot' => $lot]);
        }

        if (Auth::attempt(['password' => $password])) {
            if ($request->delete == 1) {
                DB::delete('delete lots where id = ?', [$lot_id]);
            }

            DB::update('update lots set lot_name = ?, count = ?, lot_description = ?, price = ? where id = ?',
                [htmlspecialchars($request->name), htmlspecialchars($request->count),
                htmlspecialchars($request->description), htmlspecialchars($request->price), htmlspecialchars($lot_id)]);

            return redirect();
        }
    }
}