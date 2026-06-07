<?php

namespace App\Http\Controllers;

use App\Models\CafeTable;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TableController extends Controller
{
    /**
     * Halaman daftar semua meja & QR Code
     */
    public function index(Request $request)
    {
        $query = CafeTable::orderByRaw('CAST(table_number AS UNSIGNED)');

        if ($request->filled('search')) {
            $query->where('table_number', 'like', '%' . $request->search . '%');
        }

        $tables = $query->get();

        // Cari nomor terbesar lalu +1
        $maxNumber = CafeTable::selectRaw('MAX(CAST(table_number AS UNSIGNED)) as max_num')
            ->value('max_num');
        $nextTableNumber = ($maxNumber ?? 0) + 1;

        return view('admin.tables.index', compact('tables', 'nextTableNumber', 'maxNumber'));
    }

    /**
     * Tambah meja baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'table_number' => 'required|integer|unique:cafe_tables,table_number',
        ]);

        CafeTable::create([
            'table_number' => $request->table_number,
            'qr_token'     => Str::uuid(),
        ]);

        return redirect()->route('admin.tables.index')
            ->with('success', 'Meja ' . $request->table_number . ' berhasil ditambahkan.');
    }

    /**
     * Hapus semua riwayat order (kecuali draft aktif) untuk meja ini
     */
    public function clearHistory(CafeTable $table)
    {
        $orders = \App\Models\Order::where('table_id', $table->table_id)
            ->whereIn('status', ['selesai', 'dibatalkan'])
            ->get();

        foreach ($orders as $order) {
            \App\Models\Payment::where('order_id', $order->order_id)->delete();
            $order->orderDetails()->delete();
            $order->delete();
        }

        return redirect()->route('admin.tables.index')
            ->with('success', 'Riwayat order meja ' . $table->table_number . ' berhasil dibersihkan.');
    }

    /**
     * Hapus meja — hanya bisa dari nomor terbesar
     */
    public function destroy(CafeTable $table)
    {
        // Cek apakah ini meja dengan nomor terbesar
        $maxNumber = CafeTable::selectRaw('MAX(CAST(table_number AS UNSIGNED)) as max_num')
            ->value('max_num');

        if ((int) $table->table_number !== (int) $maxNumber) {
            return redirect()->route('admin.tables.index')
                ->with('error', 'Meja hanya bisa dihapus dari nomor terbesar. Hapus meja ' . $maxNumber . ' terlebih dahulu.');
        }

        // Cek apakah ada order aktif (selain draft)
        $hasActiveOrders = \App\Models\Order::where('table_id', $table->table_id)
            ->whereNotIn('status', ['draft', 'selesai', 'dibatalkan'])
            ->exists();

        if ($hasActiveOrders) {
            return redirect()->route('admin.tables.index')
                ->with('error', 'Meja ' . $table->table_number . ' tidak bisa dihapus karena masih ada pesanan aktif.');
        }

        // Hapus draft & riwayat selesai/dibatalkan
        $orders = \App\Models\Order::where('table_id', $table->table_id)->get();
        foreach ($orders as $order) {
            \App\Models\Payment::where('order_id', $order->order_id)->delete();
            $order->orderDetails()->delete();
            $order->delete();
        }

        $nomor = $table->table_number;
        $table->delete();

        return redirect()->route('admin.tables.index')
            ->with('success', 'Meja ' . $nomor . ' berhasil dihapus.');
    }

    /**
     * Halaman cetak QR Code satu meja
     */
    public function print(CafeTable $table)
    {
        return view('admin.tables.print', compact('table'));
    }
}
