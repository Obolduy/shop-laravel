<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function main()
    {
        //$newlots = DB::select('select * from lots where active = ?', [1]);
        // Количество новых (штучек 5) и название
        return view('main'/*, ['newlots' => $newlots]*/);
    }
}
