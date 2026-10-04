<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    @vite(['resources/css/styleadmin.css'])
    @vite(['resources/js/script.js'])
</head>

<body>
    <div class="wrapper">
        <x-sidebar />

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
                    <input type="text" placeholder="Cari Kategori">
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
                            <img src="{{ asset('images/icons/edit.png') }}" alt="Edit">
                            <img src="{{ asset('images/icons/delete.png') }}" alt="Delete">
                        </td>
                    </tr>

                    <tr>
                        <td class="bottom-left">2</td>
                        <td>Minuman</td>
                        <td class="bottom-right action">
                            <img src="{{ asset('images/icons/edit.png') }}" alt="Edit">
                            <img src="{{ asset('images/icons/delete.png') }}" alt="Delete">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>