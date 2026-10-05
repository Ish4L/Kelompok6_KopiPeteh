<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - KopiPeteh</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    @vite(['resources/css/styleadmin.css'])
    @vite(['resources/js/script.js'])
</head>
<body>
    <div class="wrapper">
        <x-sidebar />

        <div class="content">
            <h3>Riwayat Pesanan</h3>
            <div class="search-area">
                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Cari Riwayat">
                </div>
            </div>

            <div class="tabs">
                    <a href="#" class="active-tab">Semua Pesanan</a>
                    <a href="#" class="tab">Dibatalkan</a>
                    <a href="#" class="tab">Menunggu</a>
                    <a href="#" class="tab">Selesai</a>
            </div>

            <table class="data-table">
                <thead>
                    <tr>
                        <th class="top-left">No</th>
                        <th>Nama</th>
                        <th>No. Telp</th>
                        <th>Tanggal ↓</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th class="top-right">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Ahoy</td>
                        <td>081234567</td>
                        <td>17-9-2026</td>
                        <td>20.000</td>
                        <td>Menunggu</td>
                        <td class="action">•••</td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>Kokoh</td>
                        <td>088888888 </td>
                        <td>17-9-2026</td>
                        <td>12.000</td>
                        <td>Menunggu</td>
                        <td class="action">•••</td>
                    </tr>

                    <tr>
                        <td class="bottom-left">3</td>
                        <td>Zixuss</td>
                        <td>0867676767</td>
                        <td>17-9-2026</td>
                        <td>15.000</td>
                        <td>Menunggu</td>
                        <td class="action bottom-right">•••</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>