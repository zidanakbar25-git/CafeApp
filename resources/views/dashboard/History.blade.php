<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>History Pesanan — Cozy Cafe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { margin: 0; background: #f5f7fb; font-family: 'Segoe UI', system-ui, sans-serif; }
        .admin-layout { display: flex; }

        .topbar {
            display: flex; align-items: center; gap: 10px;
            padding: 14px 30px;
            border-bottom: 1px solid #e5e7eb;
            background: #fff;
            font-size: 13px; color: #6b7280;
        }
        .topbar strong { color: #111827; }

        .page-wrapper {
            background: #fff; border-radius: 28px;
            border: 1px solid #e5e7eb; margin-top: 30px; overflow: hidden;
        }
        .page-header {
            padding: 24px 28px; border-bottom: 1px solid #e5e7eb;
        }
        .page-title { font-size: 22px; font-weight: 700; color: #0b1533; margin: 0; }
        .page-sub   { font-size: 13px; color: #6b7280; margin-top: 3px; }

        .search-box {
            border-radius: 30px; border: 1px solid #d1d5db;
            padding: 9px 18px; width: 300px; outline: none; font-size: 13px;
            background: #f9fafb;
        }
        .search-box:focus { border-color: #0b1533; background: #fff; }

        /* Table */
        .history-table {
            width: 100%; border-collapse: collapse; font-size: 13px;
        }
        .history-table thead th {
            padding: 12px 16px;
            background: #f9fafb;
            color: #6b7280; font-weight: 600; font-size: 11px;
            text-transform: uppercase; letter-spacing: .5px;
            border-bottom: 1px solid #e5e7eb;
            white-space: nowrap;
        }
        .history-table tbody tr {
            border-bottom: 1px solid #f3f4f6;
            transition: background .15s;
        }
        .history-table tbody tr:hover { background: #f9fafb; }
        .history-table tbody td {
            padding: 14px 16px; color: #374151; vertical-align: middle;
        }

        .order-code { font-weight: 700; color: #0b1533; font-size: 13px; }
        .meja-badge {
            background: #f3f4f6; color: #374151;
            border-radius: 8px; padding: 3px 9px;
            font-size: 12px; font-weight: 600; display: inline-block;
        }

        .items-list { line-height: 1.7; }
        .item-entry { font-size: 12px; color: #374151; }
        .item-entry span { color: #9ca3af; }

        .total-amt { font-weight: 700; color: #0b1533; white-space: nowrap; }

        .badge-selesai    { background: #dcfce7; color: #16a34a; }
        .badge-dibatalkan { background: #fee2e2; color: #dc2626; }
        .status-badge {
            padding: 4px 10px; border-radius: 20px;
            font-size: 11px; font-weight: 700; text-transform: uppercase;
            white-space: nowrap; display: inline-block;
        }

        .btn-struk {
            background: #fff; color: #374151; border: 1px solid #d1d5db;
            border-radius: 20px; padding: 5px 12px; font-size: 12px;
            cursor: pointer; text-decoration: none; display: inline-flex;
            align-items: center; gap: 4px; white-space: nowrap;
        }
        .btn-struk:hover { background: #f3f4f6; color: #0b1533; }

        .empty-state {
            text-align: center; padding: 80px 20px; color: #9ca3af;
        }
        .empty-state p { font-size: 15px; font-weight: 600; color: #6b7280; margin: 8px 0 0; }
        .empty-state small { font-size: 13px; }

        .summary-bar {
            display: flex; gap: 24px; align-items: center;
            padding: 14px 28px; background: #f9fafb;
            border-bottom: 1px solid #e5e7eb;
            font-size: 13px; color: #6b7280;
        }
        .summary-bar strong { color: #0b1533; }
    </style>
</head>

<body>
<div class="admin-layout">

    @include('dashboard.layout.sidebar')

    <div class="admin-content" style="margin-left:260px;">

        <!-- Breadcrumb -->
        <div class="topbar">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2">
                <circle cx="12" cy="12" r="9"/>
                <path d="M12 7v5l3 3"/>
            </svg>
            <span>{{ ucfirst(auth()->user()->role) }}</span>
            <span style="color:#d1d5db;">/</span>
            <strong>History Pesanan</strong>
        </div>

        <div style="padding:30px;">

            <div class="page-wrapper">

                <!-- Header -->
                <div class="page-header">
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">
                        <div>
                            <div class="page-title">History Pesanan</div>
                            <div class="page-sub">Lihat riwayat semua pesanan (read-only)</div>
                        </div>

                        <!-- Search -->
                        <form method="GET" action="{{ route('admin.orders.history') }}">
                            <div class="d-flex gap-2 align-items-center">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2" style="position:absolute;margin-left:12px;pointer-events:none;">
                                    <circle cx="11" cy="11" r="7"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                                </svg>
                                <input type="text" name="search"
                                       class="search-box"
                                       style="padding-left:36px;"
                                       value="{{ request('search') }}"
                                       placeholder="Cari ID order, nama, atau meja...">
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Summary bar -->
                <div class="summary-bar">
                    <span>Total: <strong>{{ $orders->count() }} pesanan</strong></span>
                    <span>Selesai: <strong>{{ $orders->where('status','selesai')->count() }}</strong></span>
                    <span>Dibatalkan: <strong>{{ $orders->where('status','dibatalkan')->count() }}</strong></span>
                    @if(request('search'))
                        <span style="color:#6b7280;">
                            Hasil pencarian: "<strong>{{ request('search') }}</strong>"
                            <a href="{{ route('admin.orders.history') }}" style="color:#dc2626;margin-left:6px;font-size:12px;">✕ Hapus</a>
                        </span>
                    @endif
                </div>

                <!-- Table -->
                @if($orders->isEmpty())
                    <div class="empty-state">
                        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <circle cx="12" cy="12" r="9"/>
                            <path d="M12 7v5l3 3"/>
                        </svg>
                        <p>Belum ada riwayat pesanan</p>
                        <small>Pesanan yang selesai atau dibatalkan akan muncul di sini.</small>
                    </div>
                @else
                    <div style="overflow-x:auto;">
                        <table class="history-table">
                            <thead>
                                <tr>
                                    <th>ID Order</th>
                                    <th>Tanggal</th>
                                    <th>Nama Customer</th>
                                    <th>No. Meja</th>
                                    <th>Pesanan</th>
                                    <th>Total Harga</th>
                                    <th>Bayar</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                @php
                                    $payRec = $order->payments->sortByDesc('created_at')->first();
                                    $bayar  = $payRec?->payment_method ?? $order->payment_method ?? '-';
                                @endphp
                                <tr>
                                    <td>
                                        <span class="order-code">{{ $order->order_code }}</span>
                                    </td>
                                    <td style="white-space:nowrap; color:#6b7280;">
                                        {{ $order->created_at?->setTimezone('Asia/Jakarta')->format('d M Y, H:i') ?? '-' }}
                                    </td>
                                    <td style="font-weight:600;">
                                        {{ $order->customer_name ?? '-' }}
                                    </td>
                                    <td>
                                        <span class="meja-badge">Meja {{ $order->table_id }}</span>
                                    </td>
                                    <td>
                                        <div class="items-list">
                                            @forelse($order->orderDetails as $detail)
                                                <div class="item-entry">
                                                    {{ $detail->quantity }}x {{ $detail->menu->name ?? '-' }}
                                                    <span>· Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                                                </div>
                                            @empty
                                                <span style="color:#9ca3af; font-size:12px;">-</span>
                                            @endforelse
                                        </div>
                                    </td>
                                    <td>
                                        <span class="total-amt">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                                    </td>
                                    <td style="text-transform:uppercase; font-weight:600; font-size:12px;">
                                        {{ $bayar !== '-' ? strtoupper($bayar) : '-' }}
                                    </td>
                                    <td>
                                        <span class="status-badge badge-{{ $order->status }}">
                                            {{ $order->status === 'selesai' ? 'Selesai' : 'Dibatalkan' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.orders.struk', $order->order_id) }}"
                                           target="_blank" class="btn-struk">
                                            🖨 Struk
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

            </div><!-- /page-wrapper -->

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Auto-submit search on Enter
document.querySelector('.search-box')?.addEventListener('keydown', function(e) {
    if (e.key === 'Enter') this.closest('form').submit();
});
</script>
</body>
</html>