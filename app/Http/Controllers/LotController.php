<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LotController extends Controller
{
    public function showlot($category_id, $subcategory_id, $lot_id)
    {
        $lot = DB::select('select * from lots where id = ?', [$lot_id]);
        $picture = DB::select('select picture from lots_pictures where lot_id = ?', [$lot_id]);

        $reviews = DB::table('reviews')
                    ->join('users', 'users.id', '=', 'reviews.user_id')
                    ->select('users.login', 'reviews.title', 'reviews.text', 'reviews.created_at')
                    ->where('reviews.lot_id', '=', $lot_id)
                    ->get();

        return view('showlot', ['lot' => $lot, 'picture' => $picture, 'reviews' => $reviews]);
    }

    public function editlot($shop, $lot_id, Request $request)
    {
        if ($request->isMethod('get')) {
            $lot = DB::select('select lot_name, count, lot_description, price from lots where id = ?', [$lot_id]);

            return view('editlot', ['lot' => $lot]);
        }

        if (password_verify($request->password, Auth::user()->password)) {
            if ($request->delete == 1) {
                DB::delete('delete from lots where id = ?', [$lot_id]);
            }

            DB::update('update lots set lot_name = ?, count = ?, lot_description = ?, price = ? where id = ?',
                [strip_tags($request->name), strip_tags($request->count),
                strip_tags($request->description), strip_tags($request->price), strip_tags($lot_id)]);

            return redirect('/');
        }
    }
}