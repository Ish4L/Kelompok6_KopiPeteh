<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk - KopiPeteh</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    @vite(['resources/css/styleadmin.css'])
    @vite(['resources/js/script.js'])
</head>

<body>
    <div class="wrapper">
        <x-sidebar />

        <div class="content">
            <h3>Produk</h3>
            
            <div class="search-area">
                <a class="btn-add" href="#">Tambah</a>

                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Cari Kategori">
                </div>
            </div>

            <table class="data-table product-table">
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Deskripsi</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>

                <tr>
                    <td>1</td>
                    <td>Dirty Latte</td>
                    <td>Kopi dicamp...</td>
                    <td>Minuman</td>
                    <td>20.000</td>
                    <td>
                        <span class="status status-green">Active</span>
                    </td>
                    <td>
                        <a href="#"><img src="{{ asset('images/icons/edit.svg') }}" alt="Edit"></a>
                        <a href="#"><img src="{{ asset('images/icons/delete.svg') }}" alt="Delete"></a></a>
                    </td>
                </tr>

                <tr>
                    <td>2</td>
                    <td>Spanish Latte</td>
                    <td>Intinya kopi...</td>
                    <td>Minuman</td>
                    <td>15.000</td>
                    <td>
                        <span class="status status-red">Inactive</span>
                    </td>
                    <td>
                        <a href="#"><img src="{{ asset('images/icons/edit.svg') }}" alt="Edit"></a>
                        <a href="#"><img src="{{ asset('images/icons/delete.svg') }}" alt="Delete"></a></a>
                    </td>
                </tr>

                <tr>
                    <td class="bottom-left">3</td>
                    <td>Ice Americano</td>
                    <td>Kopi hitam es</td>
                    <td>Minuman</td>
                    <td>12.000</td>
                    <td>
                        <span class="status status-green">Active</span>
                    </td>
                    <td>
                        <a href="#"><img src="{{ asset('images/icons/edit.svg') }}" alt="Edit"></a>
                        <a href="#"><img src="{{ asset('images/icons/delete.svg') }}" alt="Delete"></a></a>
                    </td>
                </tr>

                <tr>
                    <td colspan="7" style="color: rgba(0, 0, 0, 0.5)">Tidak ada data</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>