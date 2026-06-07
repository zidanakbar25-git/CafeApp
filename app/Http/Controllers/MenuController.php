<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    public function index($table)
    {
        $tableData = DB::table('cafe_tables')
            ->where('table_number', $table)
            ->first();

        // Cari draft yang sudah ada saja, TIDAK buat baru
        $drafts = Order::where('table_id', $tableData->table_id)
            ->where('status', 'draft')
            ->orderBy('order_id', 'desc')
            ->get();

        // Bersihkan draft duplikat, pakai yang terbaru
        $order = null;
        foreach ($drafts as $i => $draft) {
            if ($i === 0) {
                $order = $draft;
            } else {
                $draft->orderDetails()->delete();
                $draft->delete();
            }
        }

        // $order bisa null jika belum ada draft — tidak apa-apa

        $categories    = DB::table('categories')->get();
        $subCategories = DB::table('sub_categories')->get();

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
            'menus',
            'order'
        ));
    }
}