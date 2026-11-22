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
                    <span>GOOD COOFFE, GOOD MOOD</span>
                    <span class="eybrow-line"></span>
                </div>
    
                <h1 class="hero-title">
                    <span class="first-title">FRESH COFFÉE</span>
                    <span class="second-title">Better Together</span>
                </h1>
    
                <p class="hero-subtitle">
                    Nikmati kopi favoritmu dengan rasa yang selalu istimewa.
                </p>
            </div>
        </div>
    </section>
</body>
</html>