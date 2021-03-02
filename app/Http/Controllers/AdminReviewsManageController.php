<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminReviewsManageController extends Controller
{
    public function changereview(Request $request, $id)
    {
        $review = DB::select('select * from reviews where id = ?', [$id]);
        
        if ($request->isMethod('get')) {
            return view('adminchangereview', ['review' => $review]);
        }

        DB::update('update reviews set title = ?, text = ? where id = ?',
            [$request->title, $request->text, $id]);

        return redirect('/');
    }

    public function deletereview($id)
    {
        DB::delete('delete from reviews where id = ?', [$id]);

        return redirect('/');
    }
}
