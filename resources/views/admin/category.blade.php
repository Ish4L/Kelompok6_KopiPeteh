<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Category Page</title>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">

    @vite(['resources/css/styleadmin.css'])
</head>

<body>

    <div class="wrapper">
        <div class="sidebar">

            <div class="sidebar-header">
                <img src="{{ asset('images/logo2.png') }}"
                     alt="KopiPeteh Logo"
                     class="logo">
            </div>

            <ul class="sidebar-menu">

                <li>
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/icons/home.png') }}"
                             alt="Dashboard">
                        Dashboard
                    </a>
                </li>

                <li>
                    <a href="{{ route('profile') }}">
                        <img src="{{ asset('images/icons/profile.png') }}"
                             alt="Profile">
                        Profil
                    </a>
                </li>

                <li>
                    <a href="{{ route('category') }}">
                        <img src="{{ asset('images/icons/kategori.png') }}"
                             alt="Kategori">
                        Kategori
                    </a>
                </li>

                <li>
                    <a href="{{ route('product') }}">
                        <img src="{{ asset('images/icons/produk.png') }}"
                             alt="Produk">
                        Produk
                    </a>
                </li>

                <li>
                    <a href="{{ route('history') }}">
                        <img src="{{ asset('images/icons/history.png') }}"
                             alt="Riwayat Pesanan">
                        Riwayat Pesanan
                    </a>
                </li>

                <li class="logout">
                    <a href="{{ route('logout') }}">
                        <img src="{{ asset('images/icons/logout.png') }}"
                             alt="Logout">
                        Keluar
                    </a>
                </li>

            </ul>

        </div>

        <div class="content">

            <div class="page-header">
                <h3>Kategori</h3>
            </div>

            <div class="search-area">

                <button class="btn-add">
                    Tambah
                </button>

                <div class="search-box">

                    <i class="fa-solid fa-magnifying-glass"></i>

                    <input type="text"
                           placeholder="Cari Kategori">

                </div>

            </div>

            <table class="data-table">

                <thead>
                    <tr>
                        <th class="top-left">No</th>
                        <th>Kategori</th>
                        <th class="top-right">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>1</td>
                        <td>Makanan</td>
                        <td class="action">
                            <img src="{{ asset('images/icons/edit.png') }}"
                                 alt="Edit">
                            <img src="{{ asset('images/icons/delete.png') }}"
                                 alt="Delete">
                        </td>
                    </tr>

                    <tr>
                        <td class="bottom-left">2</td>
                        <td>Minuman</td>
                        <td class="bottom-right action">
                            <img src="{{ asset('images/icons/edit.png') }}"
                                 alt="Edit">
                            <img src="{{ asset('images/icons/delete.png') }}"
                                 alt="Delete">
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</body>
</html>