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
        $subcategory = DB::select('select id, subcategory from subcategories = ?', [$category_id]);
        
        return view('showsubcategory', ['subcategory' => $subcategory]);
    }

    public function showsubcategory($subcategory_id)
    {
        $lots = DB::select('select id, lot_name from lots where subcategory_id = ?', [$subcategory_id]);
        
        return view('showsubcategorylots', ['lots' => $lots]);
    }

    public function showshoplots($shop)
    {
        $lots = DB::select('select id, lot_name from lots where shop_name = ?', [$shop]);
        
        return view('showshoplots', ['lots' => $lots]);
    }
}
