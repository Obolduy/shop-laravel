<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class AddLotController extends Controller
{
    public function chosecategory(Request $request)
    {
        if ($request->isMethod('get')) {
            $categories = DB::select('select id, category from categories');

            return view('addlotstart', ['categories' => $categories]);
        }
        Redis::set('category_id', $request->category);

        return redirect()->route('addlot.subcategory');
    }

    public function chosesubcategory(Request $request)
    {
        if ($request->isMethod('get')) {
            $subcategories = DB::select('select id, subcategory from subcategories where category_id = ?', [Redis::get('category_id')]);

            return view('addlotcontinue', ['subcategories' => $subcategories]);
        }

        Redis::set('subcategory_id', $request->subcategory);

        return redirect()->route('addlot.finish');
    }

    public function addlot(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('addlotcomplete');
        }

        DB::insert('insert into lots (lot_name, lot_description, shop_id, category_id, subcategory_id, price, count, showing, created_at, updated_at) 
            values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [strip_tags($request->lot_name), strip_tags($request->lot_description), Auth::user()->shop_id,
                    Redis::get('category_id'), Redis::get('subcategory_id'),
                        strip_tags($request->price), strip_tags($request->count), 1, now(), now()]);
        
        if ($request->hasFile('photo')) {
            $lot = DB::select('select id from lots where lot_name = ? and shop_id = ?',
                [strip_tags($request->lot_name), Auth::user()->shop_id]);

            foreach($lot as $elem) {
                for($i = 0; $i < count($request->photo); $i++) {
                    $rawphoto = Storage::put('public/lots_images', $request->photo[$i]);
                    $photo = preg_replace('#public/lots_images/#', '', $rawphoto);
    
                    DB::insert('insert into lots_pictures (lot_id, picture) values (?, ?)', [$elem->id, $photo]);
                }
            }
        }
        Redis::del('category_id, subcategory_id');

        return redirect('/');
    }
}
