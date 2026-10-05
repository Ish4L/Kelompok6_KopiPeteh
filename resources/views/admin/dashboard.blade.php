<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | KopiPeteh</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    @vite(['resources/css/styleadmin.css'])
    @vite(['resources/js/script.js'])
</head>
<body>
    <div class="wrapper">
        <x-sidebar />

        <div class="content">
            <div class="dashboard-header">
                <h3>Selamat Datang, Admin.</h3>
                <p>Laporan Minggu Ini</p>
            </div>

            <div class="report-cards">
                <div class="card">
                    <div class="card-text">
                        <span>Total penjualan minggu ini</span>
                        <h2>XX Cup</h2>
                    </div>
                    <div class="card-icon">
                        <img src="{{ asset('images/icons/cup.svg') }}" alt="Sales">
                    </div>
                </div>
                <div class="card">
                    <div class="card-text">
                        <span>Total pemasukan minggu ini</span>
                        <h2>Rp. XXX.XXX,XX</h2>
                    </div>
                    <div class="card-icon">
                        <img src="{{ asset('images/icons/income.svg') }}" alt="Sales">
                    </div>
                </div>
            </div>

            <table class="data-table">

                <thead>
                    <tr>
                        <th class="top-left">No</th>
                        <th>Nama</th>
                        <th>Pesanan</th>
                        <th class="top-right">Harga</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>1</td>
                        <td>Ahoy</td>
                        <td>Dirty Latte</td>
                        <td>20.000</td>
                    </tr>

                    <tr>
                        <td>2</td>
                        <td>Kokoh</td>
                        <td>Ice Americano</td>
                        <td>12.000</td>
                    </tr>

                    <tr>
                        <td>3</td>
                        <td>Zixuss</td>
                        <td>Spanish Latte</td>
                        <td>15.000</td>
                    </tr>

                    <tr>
                        <td class="bottom-left">4</td>
                        <td>Helta</td>
                        <td>Ice Americano</td>
                        <td class="bottom-right">12.000</td>
                    </tr>

                </tbody>

            </table>
        </div>
    </div>
</body>
</html>