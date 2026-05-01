<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QRIS Payment</title>

    <script src="https://cdn.tailwindcss.com"></script>
    @vite('resources/css/cart.css')
</head>
<body>

<div class="cart-wrapper">

    {{-- Header --}}
    <header class="cart-header">
        <a href="{{ route('payment.index', $order->order_id) }}" class="back-btn">
            ←
        </a>
        <h1>Pembayaran QRIS</h1>
    </header>

    {{-- Content --}}
    <main class="cart-content">

        {{-- Ringkasan --}}
        <div class="order-summary">
            <h2>Ringkasan Pesanan</h2>

            @foreach ($items as $item)
                <div class="summary-row">
                    <span>{{ $item->menu->name }} ×{{ $item->quantity }}</span>
                    <span>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                </div>
            @endforeach

            <hr class="summary-divider">

            <div class="summary-total-row">
                <span>Total</span>
                <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>
        </div>

        {{-- QRIS --}}
        <div class="order-summary text-center">

            <h2 style="margin-bottom:20px;">Scan QRIS</h2>

            <div style="display:flex; justify-content:center;">
                <img src="{{ asset('images/Qris/Qris.jpeg') }}"
                     alt="QRIS"
                     style="width:250px; border-radius:16px;">
            </div>

            <p style="margin-top:16px; font-size:14px; color:#5F5E5A;">
                Scan menggunakan DANA, OVO, GoPay,
                Mobile Banking, atau E-Wallet lainnya
            </p>

        </div>

        {{-- Status --}}
        <div class="order-summary" style="background:#F4EFE9;">
            <div style="display:flex; gap:10px;">
                <div>🔒</div>
                <div>
                    <div>Pembayaran Aman</div>
                    <div style="font-size:12px;">
                        Pembayaran Anda dilindungi sistem keamanan
                    </div>
                </div>
            </div>
        </div>

    </main>

    {{-- Footer --}}
    <div class="checkout-bar">

        <a href="{{ route('payment.process', $order->order_id) }}">
            <button type="button" class="checkout-btn">
                Saya Sudah Bayar
            </button>
        </a>

    </div>

</div>

</body>
</html>