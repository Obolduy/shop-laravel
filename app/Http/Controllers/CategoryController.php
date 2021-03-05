<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function showall()
    {
        $categories = DB::select('select id, category from categories');
        
        return view('showallcategories', ['categories' => $categories]);
    }

    public function showcategory($category_id)
    {
        $subcategory = DB::select('select id, subcategory, category_id from subcategories where category_id = ?', [$category_id]);
        
        return view('showsubcategory', ['subcategory' => $subcategory]);
    }

    public function showsubcategory($category_id, $subcategory_id)
    {
        $lots = DB::select('select id, lot_name, subcategory_id, category_id from lots where category_id = ? and subcategory_id = ?',
        [$category_id, $subcategory_id]);
        
        return view('showsubcategorylots', ['lots' => $lots]);
    }

    public function showshoplots($shop)
    {
        $shop_id = DB::select('select id from shops where shop_name = ?', [$shop]);

        $lots = DB::select('select id, lot_name from lots where shop_id = ?', [$shop_id])->get();
        
        return view('showshoplots', ['lots' => $lots]);
    }
}
