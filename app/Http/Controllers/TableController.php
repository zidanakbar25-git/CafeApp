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

        return view('admin.tables.index', compact('tables', 'nextTableNumber'));
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
     * Regenerate token QR Code meja
     */
    public function regenerate(CafeTable $table)
    {
        $table->regenerateToken();

        return redirect()->route('admin.tables.index')
            ->with('success', 'QR Code meja ' . $table->table_number . ' berhasil diperbarui.');
    }

    /**
     * Hapus meja
     */
    public function destroy(CafeTable $table)
    {
        // Cek apakah meja masih punya order
        $hasOrders = \App\Models\Order::where('table_id', $table->table_id)->exists();

        if ($hasOrders) {
            return redirect()->route('admin.tables.index')
                ->with('error', 'Meja ' . $table->table_number . ' tidak bisa dihapus karena masih memiliki riwayat pesanan.');
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