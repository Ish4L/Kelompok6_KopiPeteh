<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang - KopiPeteh</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    @vite(['resources/css/style.css', 'resources/js/app.js'])
</head>
<body>
    <x-navbar />

    <div class="page-cart">
        <div class="page-header">
            <div class="page-title">
                <h2>Keranjang Pesanan</h2>
                <span></span>
            </div>

            <a href="{{ route('menu') }}" class="return-btn">< Kembali</a>
        </div>

        @if ($errors->any())
            <div class="cart-alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="cart-content">
            <div class="cart-list" id="cartListContainer"></div>

            <form action="{{ route('order.store') }}" method="POST" class="payment" id="checkoutForm">
                @csrf
                <input type="hidden" name="payment_method" id="paymentMethodInput" value="cash">
                <input type="hidden" name="items" id="cartItemsInput">
                
                <h3>Pembayaran</h3>
                <div class="form-group">
                    <label>Nama</label>
                    <div class="input-box">
                        <img src="{{ asset('images/icons/user1.svg') }}" alt="">
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama" required>
                    </div>
                </div>
                <div class="form-group">
                    <label>Nomor Telepon</label>
                    <div class="input-box">
                        <img src="{{ asset('images/icons/phone.svg') }}" alt="">
                        <input type="tel" inputmode="numeric" pattern="[0-9]*" name="phone" value="{{ old('phone') }}" placeholder="Masukkan nomor telepon" required>
                    </div>
                </div>
                <hr>
                <div class="total-price">
                    <p>Total</p>
                    <p id="cartTotalPrice">Rp 0</p>
                </div>
                <hr>
                <button type="submit" class="pay-btn" id="openPaymentModalBtn">Bayar</button>
            </form>
        </div>
    </div>

    <x-footer />

    <div id="paymentMethodModal" class="cart-modal-overlay" aria-hidden="true">
        <div class="payment-modal-box">
            <h3 class="payment-modal-title">Metode Pembayaran</h3>

            <div class="payment-method-options">
                <button type="button" class="payment-option-btn active" data-method="cash">
                    <div class="payment-option-left">
                        <img src="{{ asset('images/icons/cash.svg') }}" alt="Cash" class="payment-option-icon">
                        <span>Cash</span>
                    </div>
                    <span class="payment-radio"></span>
                </button>

                <button type="button" class="payment-option-btn" data-method="QRIS">
                    <div class="payment-option-left">
                        <img src="{{ asset('images/icons/qris.svg') }}" alt="QRIS" class="payment-option-icon">
                        <span>QRIS</span>
                    </div>
                    <span class="payment-radio"></span>
                </button>
            </div>

            <div class="payment-modal-actions">
                <button type="button" id="cancelPaymentModalBtn" class="payment-btn-cancel">Batal</button>
                <button type="button" id="confirmOrderBtn" class="payment-btn-submit">Pilih</button>
            </div>
        </div>
    </div>
</body>
</html>