<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - KopiPeteh</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
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
                    <a href="{{ route('history') }}" class="tab {{ request('status') == null ? 'active-tab' : '' }}">Semua Pesanan</a>
                    <a href="{{ route('history', ['status' => 'menunggu']) }}" class="tab {{ request('status') == 'menunggu' ? 'active-tab' : '' }}">Menunggu</a>
                    <a href="{{ route('history', ['status' => 'selesai']) }}" class="tab {{ request('status') == 'selesai' ? 'active-tab' : '' }}">Selesai</a>
                    <a href="{{ route('history', ['status' => 'dibatalkan']) }}" class="tab {{ request('status') == 'dibatalkan' ? 'active-tab' : '' }}">Dibatalkan</a>
            </div>

            <table class="data-table history-table">
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
                        <td>
                            <span class="status status-yellow">Menunggu</span>
                        </td>
                        <td>
                            <a href="#"><img img src="{{ asset('images/icons/edit.svg') }}" alt="Edit"></a>
                            <a href="#"><img img src="{{ asset('images/icons/info.svg') }}" alt="Info"></a>
                        </td>
                    </tr>

                @if ($orders->isNotEmpty())
                @foreach ($orders as $index => $order)
                    <tr>
                        <td>2</td>
                        <td>Kokoh</td>
                        <td>088888888 </td>
                        <td>17-9-2026</td>
                        <td>12.000</td>
                        <td>
                            <span class="status status-yellow">Menunggu</span>
                        </td>
                        <td>
                            <a href="#"><img img src="{{ asset('images/icons/edit.svg') }}" alt="Edit"></a>
                            <a href="#"><img img src="{{ asset('images/icons/info.svg') }}" alt="Info"></a>
                        </td>
                    </tr>

                    <tr>
                        <td class="bottom-left">3</td>
                        <td>Zixuss</td>
                        <td>0867676767</td>
                        <td>17-9-2026</td>
                        <td>15.000</td>
                        <td>
                            <span class="status status-yellow">Menunggu</span>
                        </td>
                        <td>
                            <a href="#"><img img src="{{ asset('images/icons/edit.svg') }}" alt="Edit"></a>
                            <a href="#"><img img src="{{ asset('images/icons/info.svg') }}" alt="Info"></a>
                        </td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
</body>
</html>