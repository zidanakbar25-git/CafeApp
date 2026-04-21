<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index($table)
    {
        // Ambil meja
        $tableData = DB::table('cafe_tables')
            ->where('table_number', $table)
            ->first();

        // Category
        $categories = DB::table('categories')->get();

        // SubCategory
        $subCategories = DB::table('sub_categories')->get();

        // Menu + join category & sub
        $menus = DB::table('menus')
            ->join('sub_categories', 'menus.sub_id', '=', 'sub_categories.sub_id')
            ->join('categories', 'sub_categories.category_id', '=', 'categories.category_id')
            ->select(
                'menus.*',
                'categories.name as category_name',
                'sub_categories.name as sub_name'
            )
            ->where('menus.is_active', true)
            ->get();

        return view('menu.index', compact(
            'tableData',
            'categories',
            'subCategories',
            'menus'
        ));
    }
}