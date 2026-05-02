<!DOCTYPE html>
<html>
<head>
    <title>Pembayaran</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #e6ddd4, #d6c5b8);
            display: flex;
            justify-content: center;
        }

        .container {
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }

        .header {
            background: #6b4226;
            color: white;
            padding: 18px;
            border-radius: 20px;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 15px;
        }

        .card {
            background: #ffffff;
            padding: 18px;
            border-radius: 15px;
            margin-bottom: 15px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.08);
        }

        .title {
            font-weight: 600;
            margin-bottom: 15px;
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 14px;
        }

        hr {
            border: none;
            border-top: 1px solid #eee;
            margin: 12px 0;
        }

        label {
            font-size: 13px;
            font-weight: 500;
            display: block;
            margin-top: 10px;
        }

        input {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: 1px solid #ddd;
            margin-top: 5px;
        }

        .flex {
            display: flex;
            gap: 10px;
        }

        .field {
            flex: 1;
        }

        .payment-method {
            padding: 12px;
            border: 2px solid #6b4226;
            border-radius: 12px;
            display: flex;
            gap: 10px;
        }

        .small {
            font-size: 12px;
            color: gray;
        }

        .btn {
            margin-top: 15px;
            background: #6b4226;
            color: white;
            padding: 15px;
            border-radius: 30px;
            border: none;
            width: 100%;
            font-weight: bold;
            cursor: pointer;
        }

        .success {
            background: #d4edda;
            color: #155724;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">Pembayaran Credit Card</div>

    <?php if(session()->getFlashdata('success')): ?>
        <div class="success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>


    <!-- Ringkasan -->
    <div class="card">

        <div class="title">Ringkasan Pesanan</div>

        <?php foreach($items as $item): ?>

            <div class="row">
                <span>
                    <?= $item['name'] ?> x<?= $item['quantity'] ?>
                </span>

                <span>
                    Rp <?= number_format($item['subtotal'],0,',','.') ?>
                </span>
            </div>

        <?php endforeach; ?>

        <hr>

        <div class="row">
            <strong>Total</strong>

            <strong>
                Rp <?= number_format($total,0,',','.') ?>
            </strong>
        </div>

    </div>


    <!-- Form -->
    <form method="post" action="<?= base_url('payment/proses/'.$order['order_id']) ?>">

        <div class="card">

            <div class="title">Informasi Kartu</div>

            <label>Nama Pemilik</label>
            <input type="text" name="name" required>

            <label>Nomor Kartu</label>
            <input type="text" name="card" required>

            <div class="flex">

                <div class="field">
                    <label>Expired</label>
                    <input type="text" name="exp" required>
                </div>

                <div class="field">
                    <label>CVV</label>
                    <input type="password" name="cvv" required>
                </div>

            </div>

        </div>


        <div class="card">

            <div class="title">
                Metode Pembayaran
            </div>

            <div class="payment-method">

                💳

                <div>
                    Credit Card

                    <div class="small">
                        Pembayaran menggunakan kartu
                    </div>

                </div>

            </div>

        </div>


        <button class="btn">

            Bayar ·
            Rp <?= number_format($total,0,',','.') ?>

        </button>

    </form>

</div>

</body>
</html>