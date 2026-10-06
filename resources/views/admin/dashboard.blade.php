<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - KopiPeteh</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    @vite(['resources/css/styleadmin.css'])
    @vite(['resources/js/script.js'])
</head>
<body>
    <div class="wrapper">
        <x-sidebar />

        <div class="content dashboard-content">
            <div class="dashboard-header">
                <h3>Selamat Datang, Admin.</h3>
            </div>
            
            <div class="report-cards">
                <p>Laporan Minggu Ini</p>
                <div class="card-expense">
                    <div class="card-text">
                        <span>Total penjualan minggu ini</span>
                        <h3>xx Cup</h3>
                    </div>
                    <div class="card-icon">
                        <img src="{{ asset('images/icons/cup.svg') }}" alt="Sales">
                    </div>
                </div>
                <div class="card-income">
                    <div class="card-text">
                        <span>Total pemasukan minggu ini</span>
                        <h3>Rp. xxx.xxx,xx</h3>
                    </div>
                    <div class="card-icon">
                        <img src="{{ asset('images/icons/income.svg') }}" alt="Sales">
                    </div>
                </div>
            </div>
    
            <div class="order-list">
                <p>List pesanan hari ini: Kamis</p>
            <table class="data-table dashboard-table">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Pesanan</th>
                    <th>Harga</th>
                </tr>

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
                    <td>4</td>
                    <td>Helta</td>
                    <td>Ice Americano</td>
                    <td>12.000</td>
                </tr>
            </table>
            </div>
        </div>
    </div>
</body>
</html>