<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LotController extends Controller
{
    public function showlot($lot_id)
    {
        //$lot = DB::select('select * from lots where id = ?', [$lot_id]);
        // Подрихтовать запрос и нормально передать в представление
        return view('showlot'/*, ['lot' => $lot]*/);
    }
}
