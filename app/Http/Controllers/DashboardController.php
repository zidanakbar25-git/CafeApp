<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->get('tab', 'aktif');

        $query = Order::with(['orderDetails.menu', 'payments'])->latest();

        if ($tab === 'aktif') {
            // Tampilkan: pending_cash (tunai belum dikonfirmasi) + menunggu + diproses
            // EXCLUDE: draft (order kosong meja) dan order tanpa payment
            $query->whereIn('status', ['pending_cash', 'menunggu', 'diproses'])
                  ->whereNotNull('payment_method')
                  ->whereNotNull('paid_at');
        } elseif ($tab === 'selesai') {
            $query->where('status', 'selesai');
        } elseif ($tab === 'dibatalkan') {
            $query->where('status', 'dibatalkan');
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('order_code', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%");
            });
        }

        $orders = $query->get();

        // Badge counts
        $countAktif = Order::whereIn('status', ['pending_cash', 'menunggu', 'diproses'])
                           ->whereNotNull('payment_method')
                           ->whereNotNull('paid_at')
                           ->count();

        $countSelesai    = Order::where('status', 'selesai')->count();
        $countDibatalkan = Order::where('status', 'dibatalkan')->count();

        return view('dashboard.index', compact(
            'orders', 'tab',
            'countAktif', 'countSelesai', 'countDibatalkan'
        ));
    }
}
