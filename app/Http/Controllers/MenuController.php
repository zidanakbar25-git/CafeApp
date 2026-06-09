<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\CafeTable;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    public function index($table, Request $request)
    {
        $tableData = CafeTable::where('table_number', $table)->first();
        if (!$tableData) abort(404);

        $sessionKey = 'table_session_' . $tableData->table_id;

        // Cek apakah customer scan QR (ada query ?scan=1)
        if ($request->query('scan')) {
            // Generate session baru
            session([
                $sessionKey => [
                    'token'      => Str::random(32),
                    'expires_at' => now()->addSeconds(10)->timestamp,
                ]
            ]);
            
            return redirect()->route('menu.index', ['table' => $table]);
        }

        // Cek session
        $sessionData = session($sessionKey);

        

        if (!$sessionData || now()->timestamp > $sessionData['expires_at']) {
            // Session tidak ada atau expired
            session()->forget($sessionKey);
            return view('customer.tokensession.session-expired', ['tableNumber' => $table]);
        }

       

        // Cari draft
        $drafts = Order::where('table_id', $tableData->table_id)
            ->where('status', 'draft')
            ->orderBy('order_id', 'desc')
            ->get();

        $order = null;
        foreach ($drafts as $i => $draft) {
            if ($i === 0) {
                $order = $draft;
            } else {
                $draft->orderDetails()->delete();
                $draft->delete();
            }
        }

        $categories    = DB::table('categories')->get();
        $subCategories = DB::table('sub_categories')->get();

        $menus = DB::table('menus')
            ->join('sub_categories', 'menus.sub_id', '=', 'sub_categories.sub_id')
            ->join('categories', 'sub_categories.category_id', '=', 'categories.category_id')
            ->select('menus.*', 'categories.name as category_name', 'sub_categories.name as sub_name')
            ->where('menus.is_active', true)
            ->get();

        
        return view('customer.menu.index', compact('tableData', 'categories', 'subCategories', 'menus', 'order', 'sessionData'));
    }
}