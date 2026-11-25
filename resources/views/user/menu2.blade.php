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

            <img src="{{ asset('images/brown-deco-1.svg') }}" alt="" class="bg-organic brown-deco">
            <img src="{{ asset('images/hero-product.png') }}" alt="" class="bg-organic hero-product">
            <img src="{{ asset('images/brown-deco-left-2.svg') }}" alt="" class="bg-organic brown-deco-left">
            <img src="{{ asset('images/coffee-deco-left-2.png') }}" alt="" class="bg-organic coffee-deco-left">
            <img src="{{ asset('images/brown-deco-right-2.svg') }}" alt="" class="bg-organic brown-deco-right">
            <img src="{{ asset('images/coffee-deco-right-3.png') }}" alt="" class="bg-organic coffee-deco-right">
            <img src="{{ asset('images/cream-deco-bottom-1.svg') }}" alt="" class="bg-organic cream-deco-bottom">
        </div>

        <div class="menu-section">
            <div class="menu-header">
                <h2 class="section-title">
                    Menu Drinks
                </h2>
    
                <div class="menu-tab">
                    <a href="#">All</a>
                    <a href="#">Coffee</a>
                    <a href="#">Non-coffee</a>
                </div>
            </div>

            <div class="quota">
                <img src="{{ asset('images/icons/cup.svg') }}" alt="">
                <div class="quota-text">
                    <p>Sisa Kuota Hari Ini</p>
                    <span>7/10 Cup</span>
                </div>
            </div>
        </div>
    </section>
</body>
</html>