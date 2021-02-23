<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminReviewsManageController extends Controller
{
    public function changereview($id)
    {
        $review = DB::table('reviews')
                ->join('shops', 'shops.id', '=', 'lots.shop_id')
                ->join('users', 'users.id', '=', 'reviews.user_id')
                ->join('lots', 'lots.id', '=', 'reviews.lot_id')
                ->select('lots.name', 'lots.id', 'users.login', 'shops.name', 'reviews.title', 'reviews.text')
                ->where('reviews.id', '=', $id)->get();
        
        if ($request->isMethod('get')) {
            return view('changereview', ['review' => $review]);
        }

        DB::update('update reviews set title = ?, text = ? where id = ?',
            [$request->title, $request->text, $id]); //

        return redirect();
    }

    public function deletereview($id)
    {
        DB::delete('delete reviews where id = ?', [$id]);

        return redirect();
    }
}
