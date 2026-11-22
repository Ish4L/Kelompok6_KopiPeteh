<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang - KopiPeteh</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    @vite(['resources/css/style.css'])
    @vite(['resources/js/script.js'])
</head>
<body>
    <div class="main-container">
    <header class="navbar">
        <div class="logo">
            <img src="{{ asset('images/logo3.png') }}" alt="Kopipeteh Logo">
        </div>
        <div class="nav-right">
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="searchInput" placeholder="Search...">
            </div>
            <button class="cart-icon" onclick="showCart()">
                <a href="#"><img src="{{ asset('images/icons/cart2.svg') }}" alt="Keranjang" class="cart"></a>
                <span class="cart-count" id="cartCount">0</span>
            </button>
        </div>
    </header>

    <main class="cart-content">
        <h2 class="page-title">Keranjang pesanan</h2>
        <div class="cart-layout">
            <section class="cart-list">
                <div class="cart-item">
                    <img src="{{ asset('images/americano.jpeg') }}" alt="Americano">
                    <div class="product-detail">
                        <h3>Americano</h3>
                        <div class="temperature">
                            <button class="temp iced">Ice</button>
                            <button class="temp hot active">Hot</button>
                        </div>
                    </div>
                    <div class="product-price">
                        <h3>12.000</h3>
                        <div class="quantity">
                            <button>−</button>
                            <span>1</span>
                            <button>+</button>
                        </div>
                    </div>
                    <button class="delete-btn" aria-label="Hapus produk">
                         <a href="#"><img src="{{ asset('images/icons/delete1.svg') }}" alt="Keranjang" class="delete"></a>
                    </button>
                </div>
            </section>

                <section class="payment-card">
                <h2>Pembayaran</h2>
                <form action="#" method="POST">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <div class="input-box">
                             <a href="#"><img src="{{ asset('images/icons/user1.svg') }}" alt="User"></a>
                            <input
                                type="text"
                                id="nama"
                                name="nama"
                                placeholder="Masukkan nama"
                                required
                            >
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="telepon">Nomor Telepon</label>
                        <div class="input-box">
                             <a href="#"><img src="{{ asset('images/icons/phone.svg') }}" alt="Phone"></a>
                            <input
                                type="tel"
                                id="telepon"
                                name="telepon"
                                placeholder="Masukkan nomor telepon"
                                required
                            >
                        </div>
                    </div>

                    <div class="total-section">
                        <span>Total</span>
                        <strong>Rp 12.000</strong>
                    </div>

                    <div class="payment-buttons">
                        <button type="submit" class="pay-btn">
                            Bayar
                        </button>
                        <a href="{{ url('/menu') }}" class="cancel-btn">
                            Batal
                        </a>
                    </div>
                </form>
            </section>
        </div>
    </main>

    <footer class="footer">
        <div class="footer-line"></div>
            <p>Life begins after coffee</p>
        <div class="footer-line"></div>
    </footer>
</div>
</body>
</html>