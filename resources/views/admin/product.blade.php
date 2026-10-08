<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk - KopiPeteh</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    @vite(['resources/css/styleadmin.css'])
    @vite(['resources/js/script.js'])
</head>
<body>
    <div class="wrapper">
        <x-sidebar />

        <div class="content">
            <h3>Produk</h3>
            
            <div class="search-area">
                <a class="btn-add" href="#">Tambah</a>

                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Cari Kategori">
                </div>
            </div>

            <table class="data-table product-table">
                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Deskripsi</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>

                @if ($products->isNotEmpty())
                    @foreach ($products as $index => $product)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->category->category_name }}</td>
                            <td>{{ number_format($product->price, 0, ',', '.') }}</td>
                            <td>
                                <span class="status {{ $product->status == 'active' ? 'status-green' : 'status-red' }}">
                                    {{ ucfirst($product->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="#"><img src="{{ asset('images/icons/edit.svg') }}" alt="Edit"></a>
                                <a href="#"><img src="{{ asset('images/icons/delete.svg') }}" alt="Delete"></a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="7" style="color: rgba(0, 0, 0, 0.5); font-weight: 500;">Tidak ada data</td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
</body>
</html>