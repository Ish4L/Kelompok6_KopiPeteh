<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | KopiPeteh</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    @vite(['resources/css/styleadmin.css'])
</head>
<body>
    <div class="wrapper">
        <div class="sidebar">
            <div class="sidebar-header">
                <img src="{{ asset('images/logo2.png') }}" alt="KopiPeteh Logo" class="logo">
            </div>
            <ul class="sidebar-menu">
                <li><a href="{{ route('dashboard') }}"><img src="{{ asset('images/icons/home.png') }}" alt="">Dashboard</a></li>
                <li><a href="{{ route('profile') }}"><img src="{{ asset('images/icons/profile.png') }}" alt="Profile">Profil</a></li>
                <li><a href="{{ route('category') }}"><img src="{{ asset('images/icons/kategori.png') }}" alt="Kategori">Kategori</a></li>
                <li><a href="{{ route('product') }}"><img src="{{ asset('images/icons/produk.png') }}" alt="Produk">Produk</a></li>
                <li><a href="{{ route('history') }}"><img src="{{ asset('images/icons/history.png') }}" alt="Riwayat Pesanan">Riwayat Pesanan</a></li>
                <li class="logout"><a href="{{ route('logout') }}"><img src="{{ asset('images/icons/logout.png') }}" alt="Logout">Keluar</a></li>
            </ul>
        </div>

        <div class="content">
            <header>
                <h1>Dashboard</h1>
            </header>
        </div>

    </div>
</body>
</html>