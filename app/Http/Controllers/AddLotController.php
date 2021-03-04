<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AddLotController extends Controller
{
    public $category;
    public $subcategory;

    public function chosecategory(Request $request)
    {
        if ($request->isMethod('get')) {
            $categories = DB::select('select id, category from categories');

            return view('addlotstart', ['categories' => $categories]);
        }

        $this->category = $request->category;

        return $this->chosesubcategory($request);
    }

    public function chosesubcategory(Request $request)
    {
        $subcategories = DB::select('select id, subcategory from subcategories where category_id = ?', [$this->category]);

        return view('addlotcontinue', ['subcategories' => $subcategories]);

        if ($request->isMethod('post')) {
            $this->subcategory = $request->subcategory;
        }
        $this->addlot($request);
    }

    public function addlot(Request $request)
    {
        return view('addlotcomplete');

        if ($request->isMethod('post')) {
            DB::insert('insert into lots (lot_name, lot_description, shop_id, category_id, subcategory_id, price, count) 
                values (?, ?, ?, ?, ?, ?, ?)',
                    [htmlspecialchars($request->lot_name), htmlspecialchars($request->lot_description), Auth::user()->shop_id,
                        $this->category, $this->subcategory,
                            htmlspecialchars($request->price), htmlspecialchars($request->count)]);
            
            if ($request->hasFile('photo')) {
                $lot = DB::select('select id from lots where lot_name = ?, shop_id = ?',
                    [htmlspecialchars($request->lot_name), Auth::user()->shop_id]);

                foreach($lot as $elem) {
                    for($i = 1; $i < $request->photo; $i++) {
                        $rawphoto = Storage::put('public/lots_images', $request->photo[$i]);
                        $photo = preg_replace('#public/lots_images/#', '', $rawphoto);
        
                        DB::insert('insert into lots_pictures (lot_id, picture) values (?, ?)', [$elem->id, $photo]);
                    }
                }
            }
        }

        return redirect('/');
    }
}
