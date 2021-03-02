<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function main()
    {
        $lots = DB::table('lots')
                ->select('lots.id', 'lots.lot_name', 'lots.subcategory_id', 'lots.category_id')
                ->orderBy('id', 'desc')
                ->limit(5)
                ->get();

        return view('main', ['lots' => $lots]);
    }
}