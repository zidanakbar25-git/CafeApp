<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>

    <script src="https://cdn.tailwindcss.com"></script>
    @vite('resources/css/cart.css')
</head>
<body>

<div class="cart-wrapper">

    {{-- Header --}}
    <header class="cart-header">
        <a href="{{ route('home') }}" class="back-btn">
            ←
        </a>

        <h1>Status Pesanan</h1>
    </header>

    {{-- Content --}}
    <main class="cart-content">

        {{-- Success Card --}}
        <div class="order-summary text-center">

            {{-- Icon --}}
            <div style="display:flex; justify-content:center; margin-bottom:24px;">
                <div style="
                    width:100px;
                    height:100px;
                    background:#10D400;
                    border-radius:999px;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                    font-size:48px;
                    color:white;
                    font-weight:bold;
                ">
                    ✓
                </div>
            </div>

            {{-- Title --}}
            <h2 style="
                font-size:28px;
                font-weight:700;
                margin-bottom:6px;
                color:#4B2E2B;
            ">
                Order Successful
            </h2>

            <p style="
                font-size:14px;
                color:#6B6B6B;
                margin-bottom:28px;
            ">
                Please wait while we prepare your order.
            </p>


                {{-- Order --}}
                <div style="
                    display:flex;
                    align-items:flex-start;
                    gap:14px;
                    padding-top:16px;
                    padding-bottom:16px;
                    border-bottom:1px solid #D9D9D9;
                ">

                    <div style="
                        width:42px;
                        height:42px;
                        background:white;
                        border-radius:12px;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        font-size:22px;
                    ">
                        
                    </div>

                    <div style="width:100%;">

                        <p style="
                            font-size:14px;
                            color:#7A7A7A;
                            margin-bottom:10px;
                        ">
                            Your order
                        </p>

                        @foreach ($items as $item)
                            <div style="
                                display:flex;
                                justify-content:space-between;
                                margin-bottom:8px;
                                font-weight:600;
                                color:#333;
                            ">
                                <span>{{ $item->menu->name }}</span>
                                <span>x {{ $item->quantity }}</span>
                            </div>
                        @endforeach

                    </div>

                </div>

                {{-- Footer --}}
                <div style="padding-top:16px;">

                    <div style="
                        display:flex;
                        justify-content:space-between;
                        margin-bottom:12px;
                    ">
                        <span style="color:#666;">
                            Order number
                        </span>

                        <span style="
                            font-weight:700;
                            color:#333;
                        ">
                            #{{ $order->order_id }}
                        </span>
                    </div>

                    <div style="
                        display:flex;
                        justify-content:space-between;
                    ">
                        <span style="
                            font-weight:600;
                            color:#444;
                        ">
                            Total Paid
                        </span>

                        <span style="
                            font-weight:700;
                            color:#333;
                        ">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </span>
                    </div>

                </div>

            </div>

        </div>

    </main>

    {{-- Footer --}}
    <div class="checkout-bar">

        <a href="{{ route('home') }}">
            <button type="button" class="checkout-btn">
                Back to home
            </button>
        </a>

    </div>

</div>

</body>
</html>