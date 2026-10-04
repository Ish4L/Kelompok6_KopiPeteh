<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Product Page</title>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">

    @vite(['resources/css/styleadmin.css'])
    @vite(['resources/js/script.js'])

</head>

<body>
    <div class="wrapper">
        <x-sidebar />

        <div class="content">
            <div class="page-header">
                <h3>Produk</h3>
            </div>

            <div class="search-area">

                <button class="btn-add">
                    Tambah
                </button>

                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>

                    <input type="text"
                           placeholder="Cari Produk">
                </div>

            </div>

            <table class="data-table">

                <thead>
                    <tr>
                        <th class="top-left">No</th>
                        <th>Produk</th>
                        <th>Kategori</th>
                        <th>Detail</th>
                        <th>Harga</th>
                        <th class="top-right">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>1</td>
                        <td>Dirty Latte</td>
                        <td>Minuman</td>
                        <td>Kopi dicamp...</td>
                        <td>20.000</td>
                        <td class="action">
                            <img src="{{ asset('images/icons/edit.png') }}"
                                 alt="Edit">
                            <img src="{{ asset('images/icons/delete.png') }}"
                                 alt="Delete">
                        </td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>Spanish Latte</td>
                        <td>Minuman</td>
                        <td>Intinya kopi...</td>
                        <td>15.000</td>
                        <td class="action">
                            <img src="{{ asset('images/icons/edit.png') }}"
                                 alt="Edit">
                            <img src="{{ asset('images/icons/delete.png') }}"
                                 alt="Delete">
                        </td>
                    </tr>

                    <tr>
                        <td class="bottom-left">3</td>
                        <td>Ice Americano</td>
                        <td>Minuman</td>
                        <td>Kopi hitam es</td>
                        <td>12.000</td>
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