<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KopiPeteh</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    @vite(['resources/css/style.css', 'resources/js/app.js'])
</head>
<body>
    <section class="home-page">
        <div class="home-content">
            <img src="{{ asset('images/logo1.png') }}" alt="KopiPeteh Logo">

            <div class="home-tagline">
                <div class="first-tagline">
                    <h1>
                        FRESH COFFÉE<br>
                        TO YOUR MUG
                    </h1>
                </div>

                <div class="second-tagline">
                    <span></span>
                    <p>Made for your day</p>
                    <span></span>
                </div>
            </div>

            <a href="{{ route('menu') }}" class="home-button">
                Lihat Menu
            </a>
        </div>

        <img src="{{ asset('images/brown-deco-left-1.svg') }}" alt="" class="bg-organic brown-deco-left">
        <img src="{{ asset('images/brown-deco-right-1.svg') }}" alt="" class="bg-organic brown-deco-right">
        <img src="{{ asset('images/coffee-deco-left-1.png') }}" alt="" class="bg-organic coffee-deco-left">
        <img src="{{ asset('images/coffee-deco-right-1.png') }}" alt="" class="bg-organic coffee-deco-right">
        <img src="{{ asset('images/coffee-deco-1.png') }}" alt="" class="bg-organic coffee-deco">
    </section>
</body>
</html>