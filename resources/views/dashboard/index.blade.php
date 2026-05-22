<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cafe Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            margin:0;
            background:#f5f7fb;
            font-family:Arial, sans-serif;
        }

        .admin-layout{
            display:flex;
        }

        .admin-content{
            flex:1;
            padding:30px;
        }

        .dashboard-title{
            font-size:38px;
            font-weight:700;
            color:#0b1533;
        }

        .dashboard-subtitle{
            color:#6b7280;
            margin-bottom:30px;
        }

        /* =========================
           STATISTIC CARD
        ========================== */

        .stat-card{
            background:white;
            border-radius:22px;
            padding:22px;
            border:1px solid #e5e7eb;
            height:130px;
        }

        .stat-title{
            font-size:13px;
            color:#64748b;
            font-weight:600;
            text-transform:uppercase;
        }

        .stat-value{
            font-size:36px;
            font-weight:700;
            margin-top:10px;
            color:#0b1533;
        }

        /* =========================
           ORDER SECTION
        ========================== */

        .order-wrapper{
            background:white;
            border-radius:28px;
            border:1px solid #e5e7eb;
            margin-top:30px;
            overflow:hidden;
        }

        .order-header{
            padding:22px;
            border-bottom:1px solid #e5e7eb;
        }

        .order-title{
            font-size:28px;
            font-weight:700;
            color:#0b1533;
        }

        .tab-btn{
            border:none;
            border-radius:30px;
            padding:8px 18px;
            font-weight:600;
            background:#f3f4f6;
            color:#374151;
            font-size:14px;
        }

        .tab-btn.active{
            background:#0b1533;
            color:white;
        }

        .search-box{
            border-radius:30px;
            border:1px solid #d1d5db;
            padding:10px 18px;
            width:280px;
            outline:none;
        }

        /* =========================
           ORDER CARD
        ========================== */

        .order-card{
            border:1px solid #e5e7eb;
            border-radius:22px;
            padding:18px;
            background:white;
            height:100%;
            transition:0.2s ease;
        }

        .order-card:hover{
            transform:translateY(-2px);
            box-shadow:0 8px 20px rgba(0,0,0,0.05);
        }

        .order-id{
            font-size:18px;
            font-weight:700;
            color:#0b1533;
        }

        .badge-pending{
            background:#fff3cd;
            color:#d97706;
            padding:5px 10px;
            border-radius:10px;
            font-size:11px;
            font-weight:700;
        }

        .info-label{
            color:#6b7280;
            font-size:12px;
            margin-bottom:2px;
        }

        .info-value{
            font-size:15px;
            font-weight:600;
            color:#0b1533;
        }

        .menu-item{
            background:#f9fafb;
            border-radius:14px;
            padding:10px 14px;
            margin-top:10px;
            font-size:14px;
        }

        /* =========================
           BUTTON
        ========================== */

        .btn-dark-custom{
            background:#0b1533;
            color:white;
            border:none;
            border-radius:30px;
            padding:8px 16px;
            font-weight:600;
            font-size:13px;
        }

        .btn-outline-custom{
            background:white;
            border:1px solid #d1d5db;
            border-radius:30px;
            padding:8px 16px;
            font-weight:600;
            font-size:13px;
        }

        .btn-dark-custom:hover{
            opacity:0.9;
        }

        .btn-outline-custom:hover{
            background:#f9fafb;
        }

    </style>
</head>

<body>

<div class="admin-layout">

    @include('dashboard.layout.sidebar')

    <div class="admin-content">

        <!-- HEADER -->
        <div class="dashboard-title">
            Dashboard
        </div>

        <div class="dashboard-subtitle">
            Ringkasan pesanan dan aktivitas hari ini.
        </div>

        <!-- STATISTICS -->
        <div class="row g-4">

            <div class="col-md-4">
                <div class="stat-card">

                    <div class="stat-title">
                        TOTAL PESANAN
                    </div>

                    <div class="stat-value">
                        {{ $orders->count() }}
                    </div>

                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card">

                    <div class="stat-title">
                        AKTIF
                    </div>

                    <div class="stat-value">
                        {{ $orders->where('status','pending')->count() }}
                    </div>

                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card">

                    <div class="stat-title">
                        SELESAI
                    </div>

                    <div class="stat-value">
                        {{ $orders->where('status','selesai')->count() }}
                    </div>

                </div>
            </div>

        </div>

        <!-- ORDER SECTION -->
        <div class="order-wrapper">

            <!-- HEADER -->
            <div class="order-header d-flex justify-content-between align-items-center">

                <div class="d-flex align-items-center gap-3">

                    <div class="order-title">
                        Pesanan
                    </div>

                    <button class="tab-btn active">
                        Aktif

                        <span class="badge bg-secondary ms-1">
                            {{ $orders->where('status','pending')->count() }}
                        </span>
                    </button>

                    <button class="tab-btn">

                        Selesai

                        <span class="badge bg-secondary ms-1">
                            {{ $orders->where('status','selesai')->count() }}
                        </span>

                    </button>

                </div>

                <input type="text"
                       class="search-box"
                       placeholder="Cari pesanan...">

            </div>

            <!-- ORDER LIST -->
            <div class="row p-3">

                @foreach($orders as $order)

                    <div class="col-lg-6 mb-3">

                        <div class="order-card">

                            <!-- TOP -->
                            <div class="d-flex justify-content-between">

                                <div>

                                    <div class="d-flex align-items-center gap-2">

                                        <div class="order-id">
                                            MC-TH{{ $order->order_id }}
                                        </div>

                                        <span class="badge-pending">
                                            {{ strtoupper($order->status) }}
                                        </span>

                                    </div>

                                    <div class="text-secondary mt-2" style="font-size:13px;">

                                        @if($order->created_at)
                                            {{ $order->created_at->format('d M Y, H:i') }}
                                        @else
                                            -
                                        @endif

                                    </div>

                                </div>

                                <div class="text-end">

                                    <div class="info-label">
                                        Total
                                    </div>

                                    <div class="info-value">
                                        Rp {{ number_format($order->total_amount,0,',','.') }}
                                    </div>

                                </div>

                            </div>

                            <!-- INFO -->
                            <div class="row mt-3">

                                <div class="col-4">

                                    <div class="info-label">
                                        Pelanggan
                                    </div>

                                    <div class="info-value">
                                        {{ $order->customer_name ?? '-' }}
                                    </div>

                                </div>

                                <div class="col-4">

                                    <div class="info-label">
                                        Meja
                                    </div>

                                    <div class="info-value">
                                        #{{ $order->table_id ?? '1' }}
                                    </div>

                                </div>

                                <div class="col-4">

                                    <div class="info-label">
                                        Bayar
                                    </div>

                                    <div class="info-value">
                                        {{ strtoupper($order->payment_method ?? '-') }}
                                    </div>

                                </div>

                            </div>

                            <!-- ITEMS -->
                            @foreach($order->orderDetails as $detail)

                                <div class="menu-item d-flex justify-content-between align-items-center">

                                    <div>
                                        {{ $detail->menu->name }}
                                        × {{ $detail->quantity }}
                                    </div>

                                    <div>
                                        Rp {{ number_format($detail->subtotal,0,',','.') }}
                                    </div>

                                </div>

                            @endforeach

                            <!-- ACTION -->
                            <div class="d-flex justify-content-between mt-3">

                                <div class="d-flex gap-2">

                                    <button class="btn-dark-custom">
                                        Start Serve
                                    </button>

                                    <button class="btn-outline-custom">
                                        Batal
                                    </button>

                                </div>

                                <div class="d-flex gap-2">

                                    <button class="btn-outline-custom">
                                        Struk
                                    </button>

                                    <button class="btn-outline-custom">
                                        Hapus
                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </div>

</div>

</body>
</html>