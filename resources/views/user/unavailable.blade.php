<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unavailable - KopiPeteh</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    @vite(['resources/css/style.css'])
    @vite(['resources/js/script.js'])
</head>
<body>
    <section class="unavailable-page">

        <div class="unavailable-logo">
            <img src="{{ asset('images/logo1.png') }}" alt="KopiPeteh">
        </div>

        <div class="unavailable-content">

            <img src="{{ asset('images/coffee-icon.png') }}"
                 alt="Coffee"
                 class="coffee-icon">

            <h1>Maaf</h1>

            <p>
                Pemesanan sudah ditutup,<br>
                Silahkan kembali lagi besok !
            </p>

        </div>
    </section>
</body>
</html>