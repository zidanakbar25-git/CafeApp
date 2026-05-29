<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['orderDetails.menu', 'payments'])
            ->whereIn('status', ['selesai', 'dibatalkan'])
            ->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('order_code', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('table_id', 'like', "%{$search}%");
            });
        }

        $orders = $query->get();

        return view('dashboard.history', compact('orders'));
    }
}