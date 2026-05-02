<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;
use Illuminate\Http\Request;
use App\Models\Order;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function index($order_id)
    {
        $data = $this->paymentService->getCheckoutData($order_id);

        return view('payment.index', $data);
    }
public function cash($id)
{
    $order = Order::with('orderDetails.menu')->findOrFail($id);
    $total = $order->orderDetails->sum('subtotal');

    return view('payment.cash', compact('order', 'total'));
}

  public function qris($order_id)
    {
        $data = $this->paymentService->getCheckoutData($order_id);

        return view('Qris.index', $data);
    }

    public function process($order_id)
    {
        return redirect()->route('payment.index', $order_id);
    }
}

  

