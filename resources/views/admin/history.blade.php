<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - KopiPeteh</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    @vite(['resources/css/styleadmin.css'])
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
                    <a href="{{ route('history') }}" class="tab {{ request('status') == null ? 'active-tab' : '' }}">Semua Pesanan</a>
                    <a href="{{ route('history', ['status' => 'menunggu']) }}" class="tab {{ request('status') == 'menunggu' ? 'active-tab' : '' }}">Menunggu</a>
                    <a href="{{ route('history', ['status' => 'selesai']) }}" class="tab {{ request('status') == 'selesai' ? 'active-tab' : '' }}">Selesai</a>
                    <a href="{{ route('history', ['status' => 'dibatalkan']) }}" class="tab {{ request('status') == 'dibatalkan' ? 'active-tab' : '' }}">Dibatalkan</a>
            </div>

            <table class="data-table history-table">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>No. Telp</th>
                    <th>Tanggal</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Aksi</th=>
                </tr>

                @if ($orders->isNotEmpty())
                @foreach ($orders as $index => $order)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->created_at->format('d - m - Y') }}</td>
                        <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td>
                            <span class="status 
                                @if($order->status == 'menunggu')
                                    status-yellow
                                @elseif($order->status == 'selesai')
                                    status-green
                                @else
                                    status-red
                                @endif
                            ">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>•••</td>
                    </tr>
                @endforeach
                @else
                    <tr>
                        <td colspan="7" style="text-align: center; color: rgba(0, 0, 0, 0.5); font-weight: 500;">
                            Belum ada riwayat pesanan
                        </td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
</body>
</html>