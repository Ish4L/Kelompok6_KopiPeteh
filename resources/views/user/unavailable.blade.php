<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unavailable</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    @vite(['resources/css/style.css', 'resources/js/app.js'])
</head>
<body>
    <section class="unavailable-page">
        <div class="unavailable-content">
            <img src="{{ asset('images/coffee-deco-2.png') }}" alt="">

            <h1>Maaf</h1>
            <p>
                Pemesanan sudah ditutup,<br>
                silakan kembali lagi besok!
            </p>
        </div>

        <img src="{{ asset('images/brown-deco-left-1.svg') }}" alt="" class="bg-organic brown-deco-left">
        <img src="{{ asset('images/brown-deco-right-1.svg') }}" alt="" class="bg-organic brown-deco-right">
        <img src="{{ asset('images/coffee-deco-left-1.png') }}" alt="" class="bg-organic coffee-deco-left">
        <img src="{{ asset('images/coffee-deco-right-1.png') }}" alt="" class="bg-organic coffee-deco-right">
    </section>
</body>
</html>
