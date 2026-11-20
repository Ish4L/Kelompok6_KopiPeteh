<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - KopiPeteh</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    @vite(['resources/css/styleadmin.css'])
    @vite(['resources/js/script.js'])
</head>
<body>
    <div class="wrapper">
        <x-sidebar />

        <div class="content dashboard-content">
            <!-- <div class="dashboard-header">
                <h3>Selamat Datang, Admin.</h3>
            </div> -->
            
            <div class="report-cards">
                <h3>Laporan Minggu Ini</h3>
                <div class="report-card">
                    <div class="card-text">
                        <span>Total penjualan minggu ini</span>
                        <h3>XX Cup</h3>
                    </div>
                    <div class="card-icon">
                        <img src="{{ asset('images/icons/cup.svg') }}" alt="Sales">
                    </div>
                </div>
                <div class="report-card">
                    <div class="card-text">
                        <span>Total pemasukan minggu ini</span>
                        <h3>Rp XXX.XXX,XX</h3>
                    </div>
                    <div class="card-icon">
                        <img src="{{ asset('images/icons/income.svg') }}" alt="Sales">
                    </div>
                </div>
            </div>
    
            <div class="order-list">
                <h3>List pesanan hari ini: Kamis</h3>
                <p>Cup terjual: 1/10 cup</p>
            <table class="data-table dashboard-table">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Pesanan</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>

                <tr>
                    <td>1</td>
                    <td>Fulan</td>
                    <td>Dirty Latte</td>
                    <td>1</td>
                    <td>20.000</td>
                    <td>
                        <span class="status status-yellow">Menunggu</span>
                    </td>
                    <td>
                        <a href="#"><img img src="{{ asset('images/icons/edit.svg') }}" alt="Edit"></a>
                        <a href="#"><img img src="{{ asset('images/icons/info.svg') }}" alt="Info"></a>
                    </td>
                </tr>
            </table>
            </div>
        </div>
    </div>
</body>
</html>