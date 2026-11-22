<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - KopiPeteh</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    @vite(['resources/css/style.css', 'resources/js/app.js'])
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

    <section class="hero">

        <div class="hero-content">
            <!-- Background hero menggunakan gambar milikmu -->
        </div>

    </section>

    <section class="menu-section">

        <div class="menu-header">

            <div>
                <h2>Menu Drinks</h2>

                <div class="category-buttons">
                    <button class="category active" data-category="All">All</button>
                    <button class="category" data-category="Coffee">Coffee</button>
                    <button class="category" data-category="Non Coffee">Non Coffee</button>
                </div>
            </div>

            <div class="quota">
                <span>
                    <a href="#"><img src="{{ asset('images/icons/cup.svg') }}" alt="Keranjang"></a>
                </span>
                <div>
                    <small>Sisa Kuota Hari Ini</small>
                    <p>7 / 10 Cup</p>
                </div>
            </div>

        </div>

        <div class="product-container">
            <div class="product-card" data-category="Coffee">
                <img src="{{ asset('images/americano.jpeg') }}" alt="Americano">
                <div class="product-info">
                    <h3>Americano</h3>
                    <p>Kopi hitam espresso dengan aroma kopi yang khas.</p>
                    <h4>Rp 8.000</h4>
                </div>
                <button class="add-cart" onclick="openModal('Americano', 8000)">
                   <a href="#"><img src="{{ asset('images/icons/cart1.svg') }}" alt="Keranjang" class="cart"></a>
                </button>
            </div>

            <div class="product-card" data-category="Coffee">
                <img src="{{ asset('images/sunset.jpeg') }}" alt="Sunset Noir">
                <div class="product-info">
                    <h3>Sunset Noir</h3>
                    <p>Kopi susu dengan perpaduan rasa manis dan creamy.</p>
                    <h4>Rp 12.000</h4>
                </div>
                <button class="add-cart" onclick="openModal('Sunset Noir', 12000)">
                    <a href="#"><img src="{{ asset('images/icons/cart1.svg') }}" alt="Keranjang" class="cart"></a>
                </button>
            </div>

            <div class="product-card" data-category="Coffee">
                <img src="{{ asset('images/dirty.jpeg') }}" alt="Dirty Latte">
                <div class="product-info">
                    <h3>Dirty Latte</h3>
                    <p>Espresso dengan susu segar yang lembut.</p>
                    <h4>Rp 20.000</h4>
                </div>
                <button class="add-cart" onclick="openModal('Dirty Latte', 20000)">
                    <a href="#"><img src="{{ asset('images/icons/cart1.svg') }}" alt="Keranjang" class="cart"></a>
                </button>
            </div>

            <div class="product-card" data-category="Coffee">
                <img src="{{ asset('images/senja.jpeg') }}" alt="Kopi Senja Aren">
                <div class="product-info">
                    <h3>Kopi Senja Aren</h3>
                    <p>Perpaduan kopi, susu, dan manisnya gula aren.</p>
                    <h4>Rp 15.000</h4>
                </div>
                <button class="add-cart" onclick="openModal('Kopi Senja Aren', 15000)">
                    <a href="#"><img src="{{ asset('images/icons/cart1.svg') }}" alt="Keranjang" class="cart"></a>
                </button>
            </div>

            <div class="product-card" data-category="Coffee">
                <img src="{{ asset('images/spanish.jpeg') }}" alt="Spanish Latte">
                <div class="product-info">
                    <h3>Spanish Latte</h3>
                    <p>Espresso dengan susu creamy dan rasa manis.</p>
                    <h4>Rp 15.000</h4>
                </div>
                <button class="add-cart" onclick="openModal('Spanish Latte', 15000)">
                    <a href="#"><img src="{{ asset('images/icons/cart1.svg') }}" alt="Keranjang" class="cart"></a>
                </button>
            </div>

            <div class="product-card" data-category="Non Coffee">
                <img src="{{ asset('images/matcha.jpeg') }}" alt="Matcha">
                <div class="product-info">
                    <h3>Matcha</h3>
                    <p>Matcha pilihan dengan rasa khas dan tekstur lembut.</p>
                    <h4>Rp 20.000</h4>
                </div>
                <button class="add-cart" onclick="openModal('Matcha', 20000)">
                    <a href="#"><img src="{{ asset('images/icons/cart1.svg') }}" alt="Keranjang" class="cart"></a>
                </button>
            </div>

            <div class="product-card" data-category="Non Coffee">
                <img src="{{ asset('images/magic.jpeg') }}" alt="Magic Milk">
                <div class="product-info">
                    <h3>Magic Milk</h3>
                    <p>Perpaduan susu dengan rasa manis yang creamy.</p>
                    <h4>Rp 20.000</h4>
                </div>
                <button class="add-cart" onclick="openModal('Magic Milk', 20000)">
                    <a href="#"><img src="{{ asset('images/icons/cart1.svg') }}" alt="Keranjang" class="cart"></a>
                </button>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-line"></div>
        <p>Life begins after coffee</p>
        <div class="footer-line"></div>
    </footer>
    </div>
</body>
</html>