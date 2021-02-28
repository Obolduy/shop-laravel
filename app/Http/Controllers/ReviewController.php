<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function addreview($lot_id, Request $request)
    {
        $title = htmlspecialchars($request->title);
        $text = htmlspecialchars($request->text);

        DB::insert('insert into reviews (title, text, lot_id, user_id, created_at) values (?, ?, ?, ?, ?)',
            [$title, $text, $lot_id, Auth::id(), now()]);

        return redirect('/catalog/all');
    }
}
