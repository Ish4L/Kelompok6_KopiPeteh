<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QRIS - KopiPeteh</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    @vite(['resources/css/style.css', 'resources/js/app.js'])
</head>
<body>
    <x-navbar />

    <div class="hidden"></div>

    <div class="page-qris">
        <div class="qris-box">
            <h2>Pembayaran QRIS</h2>

            @if ($errors->any())
                <div class="cart-alert-error" style="margin-bottom: 12px;">
                    {{ $errors->first() }}
                </div>
            @endif

            <img src="{{ asset('images/qris.png') }}" alt="QRIS KopiPeteh">
            <div class="total-price">
                <p>Total Pembayaran</p>
                <p class="total-number">Rp {{ number_format($pendingOrder['total_price'], 0, ',', '.') }}</p>
            </div>

            <form action="{{ route('payment.qris.confirm') }}" method="POST" id="qrisConfirmForm" class="qris-confirm">
                @csrf
                <button
                    type="submit"
                    class="pay-btn"
                    id="qrisConfirmBtn"
                    data-remaining="{{ $remainingSeconds }}"
                    {{ $remainingSeconds > 0 ? 'disabled' : '' }}
                >
                    @if ($remainingSeconds > 0)
                        Konfirmasi Bayar ({{ gmdate('i:s', $remainingSeconds) }})
                    @else
                        Konfirmasi Bayar
                    @endif
                </button>
            </form>
        </div>
    </div>

    <x-footer />
</body>
</html>