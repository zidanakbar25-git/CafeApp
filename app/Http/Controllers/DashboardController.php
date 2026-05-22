<?php

namespace App\Http\Controllers;

use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderDetails.menu')
                    ->latest()
                    ->get();

        return view('dashboard.index', compact('orders'));
    }
}