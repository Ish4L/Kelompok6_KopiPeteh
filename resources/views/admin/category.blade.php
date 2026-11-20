<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori - KopiPeteh</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    @vite(['resources/css/styleadmin.css'])
    @vite(['resources/js/script.js'])
</head>
<body>
    <div class="wrapper">
        <x-sidebar />

        <div class="content">
            <h3>Kategori</h3>

            <div class="search-area">
                <a class="btn-add" href="#">Tambah</a>

                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Cari Kategori">
                </div>
            </div>

            <table class="data-table category-table">
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
                
                <tr>
                    <td>1</td>
                    <td>Makanan</td>
                    <td>
                        <a href="#"><img src="{{ asset('images/icons/edit.svg') }}" alt="Edit"></a>
                        <a href="#"><img src="{{ asset('images/icons/delete.svg') }}" alt="Delete"></a></a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Minuman</td>
                    <td>
                        <a href="#"><img src="{{ asset('images/icons/edit.svg') }}" alt="Edit"></a>
                        <a href="#"><img src="{{ asset('images/icons/delete.svg') }}" alt="Delete"></a></a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>