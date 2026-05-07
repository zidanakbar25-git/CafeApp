<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Order;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    public function index($table)
    {
        /*
        |--------------------------------------------------------------------------
        | AMBIL DATA MEJA
        |--------------------------------------------------------------------------
        */

        $tableData = DB::table('cafe_tables')
            ->where('table_number', $table)
            ->first();

        /*
        |--------------------------------------------------------------------------
        | ACTIVE ORDER
        |--------------------------------------------------------------------------
        */

        $order = Order::where('table_id', $tableData->table_id)
            ->where('status', 'menunggu')
            ->latest()
            ->first();

        /*
        |--------------------------------------------------------------------------
        | CREATE ORDER IF NOT EXISTS
        |--------------------------------------------------------------------------
        */

        if (!$order) {

            $order = Order::create([
                'table_id'      => $tableData->table_id,
                'order_code'    => 'ORD-' . strtoupper(Str::random(6)),
                'status'        => 'menunggu',
                'total_amount'  => 0,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | CATEGORY
        |--------------------------------------------------------------------------
        */

        $categories = DB::table('categories')->get();

        /*
        |--------------------------------------------------------------------------
        | SUB CATEGORY
        |--------------------------------------------------------------------------
        */

        $subCategories = DB::table('sub_categories')->get();

        /*
        |--------------------------------------------------------------------------
        | MENU
        |--------------------------------------------------------------------------
        */

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

        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view('menu.index', compact(
            'tableData',
            'categories',
            'subCategories',
            'menus',
            'order'
        ));
    }
}