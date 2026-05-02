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

    public function cc($order_id)
{
    $data = $this->paymentService->getCheckoutData($order_id);

    return view('CreditCard.index', $data);
}

    public function process(Request $request, $order_id)
{
    $request->validate([
        'customer_name' => 'required'
    ]);

    $order = Order::findOrFail($order_id);

    $order->customer_name = $request->customer_name;
    $order->save();

    // redirect sesuai metode
    if ($request->payment_method === 'qris') {
        return redirect()->route('payment.qris', $order_id);
    }

    if ($request->payment_method === 'cash') {
        return redirect()->route('payment.cash.show', $order_id);
    }

    if ($request->payment_method === 'cc') {
        return redirect()->route('payment.cc', $order_id);
    }

    return back();
}


}

  

