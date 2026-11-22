<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan - KopiPeteh</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    @vite(['resources/css/styleadmin.css', 'resources/js/app.js'])
</head>
<body>
    <div class="wrapper">
        <x-sidebar />

        <div class="content">
            <h3>Daftar Pesanan</h3>
            <div class="search-area">
                <x-search-box placeholder="Cari nama pemesan atau ID pesanan..." />
            </div>

            <div class="tabs">
                    <a href="{{ route('order', ['search' => request('search')]) }}" class="tab {{ request('status') == null ? 'active-tab' : '' }}">Semua Pesanan</a>
                    <a href="{{ route('order', ['status' => 'belum bayar', 'search' => request('search')]) }}" class="tab {{ request('status') == 'belum bayar' ? 'active-tab' : '' }}">Belum bayar</a>
                    <a href="{{ route('order', ['status' => 'menunggu', 'search' => request('search')]) }}" class="tab {{ request('status') == 'menunggu' ? 'active-tab' : '' }}">Menunggu</a>
                    <a href="{{ route('order', ['status' => 'selesai', 'search' => request('search')]) }}" class="tab {{ request('status') == 'selesai' ? 'active-tab' : '' }}">Selesai</a>
                    <a href="{{ route('order', ['status' => 'dibatalkan', 'search' => request('search')]) }}" class="tab {{ request('status') == 'dibatalkan' ? 'active-tab' : '' }}">Dibatalkan</a>
            </div>

            <table class="data-table history-table">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>No. Telp</th>
                    <th>Tanggal</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Aksi</th=>
                </tr>

                @forelse ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
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
                        <td>
                            <a href="#"><img src="{{ asset('images/icons/info.svg') }}" alt="Info"></a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; color: rgba(0, 0, 0, 0.5); font-weight: 500;">
                            Belum ada pesanan
                        </td>
                    </tr>
                @endforelse
            </table>
            <x-pagination :paginator="$orders" />

            {{-- <div class="pagination-container">
                <p class="pagination-info">
                    Menampilkan 3 dari 36
                </p>

                <div class="pagination">
                    <button type="button" class="page-btn">
                        <i class="fa-solid fa-angle-left"></i>
                    </button>

                    <span class="page-number">1</span>

                    <button type="button" class="page-btn">
                        <i class="fa-solid fa-angle-right"></i>
                    </button>
                </div>
            </div> --}}
        </div>
    </div>
</body>
</html>