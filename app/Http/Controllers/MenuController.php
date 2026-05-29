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

        /*
        |--------------------------------------------------------------------------
        | ACTIVE ORDER — cari draft yang ada untuk meja ini
        | Kalau tidak ada, buat satu. Kalau ada lebih dari satu, hapus yang lama.
        |--------------------------------------------------------------------------
        */

        // Hapus semua draft lama untuk meja ini (bersihkan tumpukan)
        $drafts = Order::where('table_id', $tableData->table_id)
            ->where('status', 'draft')
            ->orderBy('order_id', 'desc')
            ->get();

        // Simpan draft terbaru, hapus sisanya
        $order = null;
        foreach ($drafts as $i => $draft) {
            if ($i === 0) {
                $order = $draft; // pakai yang terbaru
            } else {
                // Hapus draft lama beserta detailnya
                $draft->orderDetails()->delete();
                $draft->delete();
            }
        }

        // Tidak ada draft sama sekali → buat baru
        if (!$order) {
            $order = Order::create([
                'table_id'     => $tableData->table_id,
                'order_code'   => 'ORD-' . strtoupper(Str::random(6)),
                'status'       => 'draft',
                'total_amount' => 0,
            ]);
        }

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