<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class CartController extends Controller
{
    public function showcart()
    {
        $user_id = Auth::id();

        if (!Schema::hasTable("cart_$user_id")) {
            $message = 'В Вашей корзине пусто!';

            return view('showcart', ['message' => $message]);
        } else {
            $lots = DB::table("cart_$user_id")
                    ->join('lots', 'lots.id', '=', "cart_$user_id.lot_id")
                    ->select("cart_$user_id.*", 'lots.id', 'lots.lot_name', 'lots.price', 'lots.category_id', 'lots.subcategory_id')->get();

            return view('showcart', ['lots' => $lots]);
        }
    }

    public function addtocart($lot_id)
    {
        $user_id = Auth::id();

        if (!Schema::hasTable("cart_$user_id")) {
            DB::statement("create table cart_$user_id 
            (
                lot_id int not null
            )");
        }

        DB::insert("insert into cart_$user_id (lot_id) values (?)", [$lot_id]);

        return redirect()->intended();
    }

    public function deletefromcart($lot_id)
    {
        $user_id = Auth::id();

        DB::table("cart_$user_id")->where('lot_id', '=', $lot_id)->delete();

        if (DB::table("cart_$user_id")->first() == null) {
            DB::statement("drop table cart_$user_id");
        }

        return redirect('catalog/all');
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
            'district' => 'required',
            'street' => 'required',
            'house' => 'required',
            'credit_card' => 'required|min:15|max:19|integer',
            'code' => 'required|digit:3',
            'name' => 'required|alpha',
            'surname' => 'required|alpha',
            'month' => 'required|digit:2',
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