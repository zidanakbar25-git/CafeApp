{{-- resources/views/payment/cash.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota — Order #{{ str_pad($order->order_id, 4, '0', STR_PAD_LEFT) }}</title>
    <link rel="stylesheet" href="{{ asset('css/payment-cash.css') }}">
</head>
<body>

<div class="wrapper">

    {{-- Top Bar --}}
    <div class="topbar no-print">
        <a href="javascript:history.back()" class="back-btn">←</a>
        <h1>Nota Pembayaran</h1>
    </div>

    {{-- Instruksi --}}
    <div class="nota-instruction no-print">
        <div class="icon">🧾</div>
        <p>Tunjukkan nota ini ke <strong>kasir</strong> untuk membayar.</p>
    </div>

    {{-- Nota --}}
    <div class="card">

        {{-- Header nota --}}
        <div class="nota-header">
            <h2>{{ config('app.name', 'Café') }}</h2>
            <p>{{ now()->format('d M Y, H:i') }}</p>
        </div>

        {{-- Info order --}}
        <div class="info-row">
            <span>Kode Pesanan</span>
            <span class="val">#{{ $order->order_code }}</span>
        </div>
        <div class="info-row">
            <span>Pelanggan</span>
            <span class="val">{{ $order->customer_name ?? '-' }}</span>
        </div>
        <div class="info-row">
            <span>Meja</span>
            <span class="val">Meja {{ $order->table_id }}</span>
        </div>

        <div class="divider-dashed"></div>

        {{-- Rincian Menu --}}
        <div class="section-label">Rincian Pesanan</div>

        @foreach ($order->orderDetails as $index => $detail)
        <div class="menu-row">
            <div class="menu-left">
                <span class="menu-num">{{ $index + 1 }}. {{ $detail->menu->name }}</span>
                <span class="menu-qty-price">{{ $detail->quantity }}x {{ number_format($detail->unit_price, 0, ',', '.') }}</span>
            </div>
            <span class="menu-subtotal">{{ number_format($detail->subtotal, 0, ',', '.') }}</span>
        </div>
        @endforeach

        <div class="divider-dashed"></div>

        {{-- Total --}}
        <div class="total-row">
            <span class="lbl">Total Tagihan</span>
            <span class="amount">Rp {{ number_format($total, 0, ',', '.') }}</span>
        </div>

        <div class="divider-dashed"></div>

        {{-- Metode bayar --}}
        <div class="payment-method">
            <span class="method-icon">💵</span>
            <span>Bayar Tunai di Kasir</span>
        </div>

    </div>

    <p class="footer-note no-print">Terima kasih telah memesan!</p>

</div>

</body>
</html>