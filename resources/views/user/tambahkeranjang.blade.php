<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - KopiPeteh</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    @vite(['resources/css/style.css'])
    @vite(['resources/js/script.js'])
</head>
<body>
    <div class="cart-modal-overlay">
        <div class="cart-modal">
            <h2>Tambah ke keranjang</h2>
            
            <div class="modal-divider"></div>

            <h3>Americano</h3>

            <div class="quantity-control">
                <span>Jumlah:</span>
                <div class="quantity">
                    <button>−</button>
                    <span>1</span>
                    <button>+</button>
                </div>
            </div>

            <div class="temperature-options">
                <button type="button"
                    class="temperature-btn active"
                    onclick="selectTemperature(this)">
                    Iced
                </button>

                <button type="button"
                    class="temperature-btn"
                    onclick="selectTemperature(this)">
                    Hot
                </button>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-batal"
                 onclick="closeProductModal()">Batal</button>
                <button type="submit" class="btn-tambah">Tambah</button>
            </div>
        </div>
    </div>
</body>
</html>