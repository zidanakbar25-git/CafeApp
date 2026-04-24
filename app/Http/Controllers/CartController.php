<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CartController extends Controller
{
    /**
     * Display the cart for a given order.
     *
     * @param  int  $order_id  Defaults to 1 (dummy order)
     */
public function index(int $order_id = 1): \Illuminate\View\View|\Illuminate\Http\RedirectResponse
{
    $order = Order::with([
        'orderDetails' => fn($q) => $q->with('menu')->orderBy('detail_id'),
    ])->findOrFail($order_id);

    if (in_array($order->status, ['diproses', 'selesai', 'paid'])) {
        return redirect('/payment/' . $order_id);
    }

    $totalItems = $order->orderDetails->sum('quantity');

    return view('cart.index', compact('order', 'totalItems'));
}

    /**
     * Update the quantity of a cart item (increment or decrement).
     * Minimum quantity is 1.
     */
    /**
     * AJAX: Update qty, return updated data as JSON
     */
    public function updateQtyAjax(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'detail_id' => 'required|integer|exists:order_details,detail_id',
            'action'    => 'required|in:increment,decrement',
            'order_id'  => 'required|integer|exists:orders,order_id',
        ]);

        $detail = OrderDetail::findOrFail($request->detail_id);

        if ($request->action === 'increment') {
            $detail->quantity += 1;
        } elseif ($request->action === 'decrement' && $detail->quantity > 1) {
            $detail->quantity -= 1;
        }

        $detail->recalculateSubtotal();

        $order = Order::findOrFail($request->order_id);
        $order->recalculateTotal();

        return response()->json([
            'quantity'    => $detail->quantity,
            'subtotal'    => $detail->subtotal,
            'total'       => $order->total_amount,
            'detail_id'   => $detail->detail_id,
        ]);
    }

    /**
     * AJAX: Delete item, return updated total as JSON
     */
    public function deleteItemAjax(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'detail_id' => 'required|integer|exists:order_details,detail_id',
            'order_id'  => 'required|integer|exists:orders,order_id',
        ]);

        OrderDetail::findOrFail($request->detail_id)->delete();

        $order = Order::findOrFail($request->order_id);
        $order->recalculateTotal();

        $isEmpty = $order->orderDetails()->count() === 0;

        return response()->json([
            'total'   => $order->total_amount,
            'isEmpty' => $isEmpty,
        ]);
    }
    /**
     * Process checkout for the order.
     */
public function checkout(int $order_id): RedirectResponse
{
    $order = Order::with('orderDetails')->findOrFail($order_id);

    if ($order->orderDetails->isEmpty()) {
        return redirect()
            ->route('cart.index', ['order_id' => $order_id])
            ->with('error', 'Keranjang kosong.');
    }

    $order->recalculateTotal();
    return redirect('/payment/' . $order_id);
}

    /**
 * Add a menu item to the cart (order_details).
 */
public function addItem(Request $request): RedirectResponse
{
    $request->validate([
        'menu_id'  => 'required|integer|exists:menus,menu_id',
        'order_id' => 'required|integer|exists:orders,order_id',
    ]);

    $menu  = \App\Models\Menu::findOrFail($request->menu_id);
    $order = Order::findOrFail($request->order_id);

    // Cek apakah menu sudah ada di cart
    $detail = OrderDetail::where('order_id', $request->order_id)
                         ->where('menu_id', $request->menu_id)
                         ->first();

    if ($detail) {
        // Kalau sudah ada, increment qty saja
        $detail->quantity += 1;
        $detail->recalculateSubtotal();
    } else {
        // Kalau belum ada, buat baris baru
        $detail = OrderDetail::create([
            'order_id'   => $order->order_id,
            'menu_id'    => $menu->menu_id,
            'quantity'   => 1,
            'unit_price' => $menu->price,
            'subtotal'   => $menu->price,
        ]);
    }

    $order->recalculateTotal();

    return back()->with('success', "{$menu->name} ditambahkan ke keranjang!");
}

/**
 * Return total item count as JSON (for badge update).
 */
public function getCount(int $order_id): \Illuminate\Http\JsonResponse
{
    $order = Order::with('orderDetails')->findOrFail($order_id);
    $totalItems = $order->orderDetails->sum('quantity');

    return response()->json(['count' => $totalItems]);
}
}
