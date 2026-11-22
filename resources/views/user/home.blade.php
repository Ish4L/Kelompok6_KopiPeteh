<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - KopiPeteh</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    @vite(['resources/css/style.css'])
    @vite(['resources/js/script.js'])
</head>
<body>
    <section class="home-page">

        <div class="home-content">
                <img src="{{ asset('images/logo1.png') }}" alt="KopiPeteh Logo">

            <h1>
                 FRESH COFFEE<br>
                TO YOUR MUG
            </h1>

            <div class="home-tagline">
                <span></span>
                <p>Made for your day</p>
                <span></span>
            </div>

            <a href="#" class="home-button">
                Lihat Menu
            </a>

        </div>

    </section>

</body>
</html>
