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
    <x-navbar />

    <section class="page-menu">
        <div class="hero-section">
            <div class="hero-text">
                <div class="hero-eyebrow">
                    <span>GOOD COFFEE, GOOD MOOD</span>
                    <span class="eybrow-line"></span>
                </div>
    
                <h1 class="hero-title">
                    <span class="first-title">FRESH COFFÉE</span>
                    <span class="second-title">Better Together</span>
                </h1>
    
                <p class="hero-subtitle">
                    Nikmati kopi favoritmu dengan rasa yang selalu <br>istimewa.
                </p>
            </div>

            <img src="{{ asset('images/hero-product.png') }}" alt="" class="bg-organic hero-product">
            <img src="{{ asset('images/brown-deco-left-2.svg') }}" alt="" class="bg-organic brown-deco-left">
            <img src="{{ asset('images/coffee-deco-left-2.png') }}" alt="" class="bg-organic coffee-deco-left">
            <img src="{{ asset('images/brown-deco-right-2.svg') }}" alt="" class="bg-organic brown-deco-right">
            <img src="{{ asset('images/coffee-deco-right-3.png') }}" alt="" class="bg-organic coffee-deco-right">
            <img src="{{ asset('images/cream-deco-bottom-1.svg') }}" alt="" class="bg-organic cream-deco-bottom">
        </div>

        <div class="menu-section">
            <div class="menu-header">
                <div class="section-title">
                    <h2>
                        Menu Drinks
                    </h2>
                    <span></span>
                </div>
    
                <div class="menu-tab">
                    <button type="button" class="active" data-filter="all">All</button>
                    <button type="button" data-filter="coffee">Coffee</button>
                    <button type="button" data-filter="non-coffee">Non-coffee</button>
                </div>
            </div>

            <div class="quota">
                <img src="{{ asset('images/icons/cup.svg') }}" alt="">
                <div class="quota-text">
                    <p>Kuota PO Hari Ini</p>
                    <span>{{ $todayCups }}/10 Cup</span>
                </div>
            </div>

            <div @class(['product-list', 'is-empty' => $menus->isEmpty()])>
                @foreach ($menus as $item)
                    <div class="item"
                        data-id="{{ $item->id }}"
                        data-name="{{ $item->product_name }}"
                        data-price="{{ $item->price }}"
                        data-img="{{ asset('storage/' . $item->image) }}"
                        data-category="{{ \Illuminate\Support\Str::slug($item->category->category_name ?? '') }}">
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->product_name }}" class="item-img">

                        <div class="item-info">
                            <p class="item-name">{{ $item->product_name }}</p>
                            <p class="item-desc">{{ $item->description }}</p>
                            <div class="item-price">
                                <p>Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                <button type="button" class="cart-add">
                                    <img src="{{ asset('images/icons/cart1.svg') }}" alt="">
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach

                <h4 id="emptyFilterMsg" style="display: {{ $menus->isEmpty() ? 'block' : 'none' }}; font-weight: 500;">
                    Tidak ada data
                </h4>
            </div>
        </div>
    </section>
    
    <x-footer />

    <div id="addToCartModal" class="cart-modal-overlay" aria-hidden="true">
        <div class="cart-modal-box">
            <div class="cart-modal-body">
                <h3 class="cart-modal-title">Tambah ke keranjang</h3>
                <hr class="cart-modal-divider">

                <p id="modalProductName" class="cart-modal-product"></p>

                <div class="cart-modal-qty-row">
                    <span>Jumlah:</span>
                    <div class="modal-qty-control">
                        <button type="button" id="modalQtyMinus" class="modal-qty-btn" disabled>-</button>
                        <span id="modalQtyValue">1</span>
                        <button type="button" id="modalQtyPlus" class="modal-qty-btn">+</button>
                    </div>
                </div>

                <div class="cart-modal-variants">
                    <button type="button" class="variant-btn active" data-variant="Iced">Iced</button>
                    <button type="button" class="variant-btn" data-variant="Hot">Hot</button>
                </div>
            </div>

            <div class="cart-modal-footer">
                <button type="button" id="modalCancelBtn" class="modal-btn-cancel">Batal</button>
                <button type="button" id="modalConfirmBtn" class="modal-btn-add">Tambah</button>
            </div>
        </div>
    </div>

    @if (session('order_success'))
        <div id="orderSuccessFlag" data-message="{{ session('order_success') }}" style="display: none;"></div>
    @endif
</body>
</html>