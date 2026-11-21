<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    @vite(['resources/css/styleadmin.css'])
    @vite(['resources/js/script.js'])
</head>
<body>
    <div class="payment-overlay" id="paymentModal">
    <div class="payment-modal">
        <h3>Konfirmasi Pembayaran</h3>
        <h4>Pesanan #001</h4>

        <hr>

        <div class="payment-details">
            <h5>Detail Pembayaran</h5>

            <div class="detail-row">
                <span>Nama Pelanggan</span>
                <span>Fulan</span>
            </div>

            <div class="detail-row">
                <span>Metode Pembayaran</span>
                <span>Tunai</span>
            </div>

            <div class="detail-row">
                <span>Total Pembayaran</span>
                <span>Rp44.000</span>
            </div>
        </div>

        <div class="payment-footer">
            <p>Apakah pembayaran sudah diterima?</p>

            <div class="payment-buttons">
                <button class="btn-not-received" onclick="closePaymentModal()">
                    Belum Diterima
                </button>

                <button class="btn-received" onclick="confirmPayment()">
                    Sudah Diterima
                </button>
            </div>
        </div>
    </div>
</div>
</body>
</html>