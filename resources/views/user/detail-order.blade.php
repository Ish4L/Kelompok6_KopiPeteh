<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan - KopiPeteh</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    @vite(['resources/css/style.css', 'resources/js/app.js'])
</head>
<body>
    <x-navbar />

    <div class="hidden"></div>

    <div class="page-detail">
        <div class="detail-box">
            <div class="detail-content">
                <img src="{{ asset('images/icons/user2.svg') }}" alt="">
                <h3>{{ $order->name }}</h3>
                <div class="detail-field">
                    <span>Tanggal</span>
                    <span>{{ $order->created_at->format('m-d-Y') }}</span>
                </div>
                <div class="detail-field">
                    <span>Waktu</span>
                    <span>{{ $order->created_at->format('H:i') }} WITA</span>
                </div>
                <div class="detail-field">
                    <span>Metode Pembayaran</span>
                    <span>{{ strtoupper($order->payment_method) === 'QRIS' ? 'QRIS' : 'Cash' }}</span>
                </div>
                <hr>
                <h4>Detail Pesanan</h4>
                @foreach ($order->items as $item)
                    <div class="detail-item">
                        <span>{{ $item->product->product_name ?? $item->product->name }} ({{ $item->variant }})</span>
                        <div class="item-qty">
                            <small>{{ $item->quantity }} x {{ number_format($item->price, 0, ',', '.') }}</small>
                            <small>Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</small>
                        </div>
                    </div>
                @endforeach
                <hr>
                <div class="detail-total">
                    <h4>Total</h4>
                    <h4>Rp {{ number_format($order->total_price, 0, ',', '.') }}</h4>
                </div>
            </div>

            @if (strtolower($order->payment_method) === 'qris')
                <div class="order-status qris">
                    <span>Transaksi Berhasil</span>
                </div>
            @else
                <div class="order-status cash">
                    <span>Menunggu Konfirmasi Pembayaran</span>
                </div>
            @endif

            <a href="{{ route('menu') }}" class="return-btn">Kembali ke Menu</a>
        </div>
    </div>

    <x-footer />
    
    @if (session('clear_cart'))
        <div id="orderSuccessFlag" style="display: none;"></div>
    @endif
</body>
</html>