<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - KopiPeteh</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    @vite(['resources/css/styleadmin.css', 'resources/js/app.js'])
</head>
<body>
    <div class="wrapper">
        <x-sidebar />

        <div class="content dashboard-content">
            <div class="report-cards">
                <h3>Laporan Minggu Ini</h3>
                <div class="report-card">
                    <div class="card-text">
                        <span>Total penjualan minggu ini</span>
                        <h3>{{ $weeklyCups }} Cup</h3>
                    </div>
                    <div class="card-icon">
                        <img src="{{ asset('images/icons/cup.svg') }}" alt="Sales">
                    </div>
                </div>
                <div class="report-card">
                    <div class="card-text">
                        <span>Total pemasukan minggu ini</span>
                        <h3>Rp {{ number_format($weeklyIncome, 2, ',', '.') }}</h3>
                    </div>
                    <div class="card-icon">
                        <img src="{{ asset('images/icons/income.svg') }}" alt="Sales">
                    </div>
                </div>
            </div>
    
            <div class="order-list">
                <h3>List pesanan hari ini: {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l') }}</h3>
                <div>
                    <span>Cup terjual: {{ $todayCups }}/10 cup</span>
                </div>
                <div style="height: fit-content; overflow-y: auto;">
                    <table class="data-table dashboard-table">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Produk</th>
                            <th>Varian</th>
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
                                    <td>{{ ucfirst($item->variant) }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="status 
                                            @if($item->order->status == 'menunggu' || $item->order->status == 'belum bayar')
                                            status-yellow
                                            @elseif($item->order->status == 'selesai')
                                                status-green
                                            @else
                                                status-red
                                            @endif
                                        ">
                                        {{ ucfirst($item->order->status) }}
                                    </span>
                                    </td>
                                    <td>
                                        @php
                                            $order = $item->order;

                                            $orderItems = $order->items->map(function ($orderItem) {
                                                return [
                                                    'name' => $orderItem->product->product_name ?? 'Produk dihapus',
                                                    'variant' => $orderItem->variant ? ucfirst($orderItem->variant) : null,
                                                    'quantity' => $orderItem->quantity,
                                                    'price' => $orderItem->price,
                                                    'subtotal' => $orderItem->quantity * $orderItem->price,
                                                ];
                                            });
                                        @endphp

                                        <button type="button"
                                            class="btn-info-order"
                                            data-id="{{ $order->id }}"
                                            data-formatted-id="Pesanan #{{ str_pad($order->id, 3, '0', STR_PAD_LEFT) }}"
                                            data-name="{{ $order->name }}"
                                            data-phone="{{ $order->phone }}"
                                            data-date="{{ $order->created_at->format('j-n-Y') }}"
                                            data-payment="{{ ucfirst($order->payment_method ?? 'Cash') }}"
                                            data-total="{{ $order->total_price }}"
                                            data-status="{{ $order->status }}"
                                            data-update-url="{{ route('order.update', $order->id) }}"
                                            data-items='@json($orderItems)'
                                            style="background: none; border: none; cursor: pointer; padding: 0;">
                                            <img src="{{ asset('images/icons/info.svg') }}" alt="Info">
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="8" style="color: rgba(0, 0, 0, 0.5); font-weight: 500;">Belum ada pesanan hari ini</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>

    <x-order-detail-modal />
</body>
</html>