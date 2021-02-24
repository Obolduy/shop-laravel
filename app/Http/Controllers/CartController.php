<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function showcart()
    {
        $user_id = Auth::id();

        if (!DB::table("cart_$user_id")->get()) {
            $message = 'В Вашей корзине пусто!';

            return view('showcart', ['message' => $message]);
        } else {
            $lots = DB::table("cart_$user_id")
                    ->join('lots', 'lots.id', '=', "cart_$user_id.lot_id")
                    ->select("cart_$user_id.*", 'lots.lot_name')
                    ->get();

            return view('showcart', ['lots' => $lots]);
        }
    }

    public function addtocart($lot_id)
    {
        $user_id = Auth::id();
        
        if (!DB::table("cart_$user_id")->get()) {
            DB::statement("create table cart_$user_id 
            (
                lot_id int not null,
                lot_price int not null
            )");
        }

        DB::insert("insert into cart_$user_id (lot_id) values (?)", [$lot_id]);

        return redirect()->intended();
    }

    public function deletefromcart($lot_id)
    {
        $user_id = Auth::id();

        DB::table("cart_$user_id")->where('lot_id', '=', $lot_id)->delete();

        if (!DB::table("cart_$user_id")->get()) {
            DB::statement("drop table cart_$user_id");
        }

        return redirect();
    }

    public function payform(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('payform');
        }

        $validated = $request->validate([
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'dictrict' => 'required',
            'street' => 'required',
            'house' => 'required',
            'street' => 'required',
            'credit_card' => 'required|min:15|max:19|integer',
            'code' => 'required|digit:3',
            'full_name' => 'required',
            'year' => 'required|digit:4'
        ]);

        $user_id = Auth::id();

        DB::table('lots')
            ->join("cart_$user_id", "cart_$user_id.lot_id", 'lots.id')
            ->select('lots.count')
            ->decrement('lots.count');

        return redirect('/cart/buy/payment/success');
    }

    public function paymentsuccess()
    {
        DB::statement("drop table cart_$user_id");

        return view('paymentsuccess');
    }
}