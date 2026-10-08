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
            <!-- <div class="dashboard-header">
                <h3>Selamat Datang, Admin.</h3>
            </div> -->
            
            <div class="report-cards">
                <h3>Laporan Minggu Ini</h3>
                <div class="report-card">
                    <div class="card-text">
                        <span>Total penjualan minggu ini</span>
                        <h3>{{ $weekCups }} Cup</h3>
                    </div>
                    <div class="card-icon">
                        <img src="{{ asset('images/icons/cup.svg') }}" alt="Sales">
                    </div>
                </div>
                <div class="report-card">
                    <div class="card-text">
                        <span>Total pemasukan minggu ini</span>
                        <h3>Rp {{ number_format($weekIncome, 2, ',', '.') }}</h3>
                    </div>
                    <div class="card-icon">
                        <img src="{{ asset('images/icons/income.svg') }}" alt="Sales">
                    </div>
                </div>
            </div>
    
            <div class="order-list">
                <h3>List pesanan hari ini: {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l') }}</h3>
                <div style="margin-bottom: 10px; font-weight: bold;">
                    <span>Cup terjual: {{ $todayCups }}/10 cup</span>
                </div>
                <table class="data-table dashboard-table">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Pesanan</th>
                        <th>Jumlah</th>
                        <th>Total harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    
                    @if ($todayOrders->isNotEmpty())
                        @foreach ($todayOrders as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->order->name }}</td>
                                <td>{{ $item->product->product_name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->quantity * $item->price, 0, ',', '.') }}</td>
                                <td>
                                    <span class="status 
                                        @if($item->order->status == 'pending')
                                        status-yellow
                                        @elseif($item->order->status == 'completed')
                                            status-green
                                        @else
                                            status-red
                                        @endif
                                    ">
                                    {{ ucfirst($item->order->status) }}
                                </span>
                                </td>
                                <td>•••</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" style="color: rgba(0, 0, 0, 0.5); font-weight: 500;">Belum ada pesanan hari ini</td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
</body>
</html>