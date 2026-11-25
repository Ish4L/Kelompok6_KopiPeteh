<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk - KopiPeteh</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    @vite(['resources/css/styleadmin.css', 'resources/js/app.js'])
</head>
<body>
    <div class="wrapper">
        <x-sidebar />

        <div class="content">
            <h3>Produk</h3>
            
            <div class="search-area">
                <button class="btn-add" id="btnAddProduct" title="Tambah Produk">Tambah</button>

                <x-search-box placeholder="Cari produk atau kategori..." />
            </div>

            <table class="data-table product-table">
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Produk</th>
                    <th>Deskripsi</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>

                @forelse ($products as $product)
                    <tr>
                        <td>{{ $products->firstItem() + $loop->index }}</td>
                        <td>@if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->product_name }}" class="product-img">
                            @else
                                <div class="no-img">
                                    <img src="{{ asset('images/icons/image-off.svg') }}" alt="">
                                </div>
                            @endif</td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ ucfirst($product->category->category_name) }}</td>
                        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td>
                            <span class="status {{ $product->status == 'active' ? 'status-green' : 'status-red' }}">
                                {{ ucfirst($product->status) }}
                            </span>
                        </td>
                        <td>
                            <button type="button"
                                    class="btn-edit-product"
                                    data-id="{{ $product->id }}"
                                    data-name="{{ $product->product_name }}"
                                    data-category="{{ $product->category_id }}"
                                    data-price="{{ (int) $product->price }}"
                                    data-description="{{ $product->description }}"
                                    data-status="{{ $product->status }}"
                                    data-image="{{ $product->image ? asset('storage/' . $product->image) : '' }}">
                                <img src="{{ asset('images/icons/edit.svg') }}" alt="Edit">
                            </button>

                            <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin hapus {{ ucfirst($product->product_name) }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-hapus">
                                    <img src="{{ asset('images/icons/delete.svg') }}" alt="Delete">
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="color: rgba(0, 0, 0, 0.5); font-weight: 500;">Tidak ada data</td>
                    </tr>
                @endforelse
            </table>
            <x-pagination :paginator="$products" />
        </div>
    </div>

    <div class="modal-overlay" id="productModal">
        <div class="modal-content product-modal-content">
            <form action="{{ route('product.store') }}" 
                data-store-url="{{ route('product.store') }}" 
                data-update-url="{{ url('/produk') }}" 
                method="POST" 
                enctype="multipart/form-data" 
                class="product-form" 
                id="productForm">
                @csrf
                <input type="hidden" name="_method" id="productFormMethod" value="POST">

                <div class="modal-body">
                    <h1 id="productModalTitle">Tambah Produk</h1>
                    <hr>

                    <div class="input-box">
                        <label for="productNameInput">Nama Produk</label>
                        <input 
                            type="text" 
                            name="product_name" 
                            id="productNameInput" 
                            value="{{ old('product_name') }}" 
                            placeholder="Contoh: Matcha"
                            maxlength="50"
                            autofocus 
                            required>
                        
                        @error('product_name')
                            <small class="error-text" style="color: red;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="input-box">
                        <label for="productCategoryInput">Kategori Produk</label>
                        <select name="category_id" id="productCategoryInput" required>
                            <option value="" disabled selected>Pilih kategori produk</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ ucfirst($category->category_name) }}
                                </option>
                            @endforeach
                        </select>

                        @error('category_id')
                            <small class="error-text" style="color: red;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="input-box">
                        <label>Status</label>
                        <div class="status-toggle-wrapper">
                            <label class="switch">
                                <input type="checkbox" name="status" id="productStatusInput" value="active" {{ old('status') == 'active' ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                            <span id="statusText">Inactive</span>
                        </div>
                    </div>

                    <div class="input-box">
                        <label>Gambar Produk</label>
                        <div class="upload-area" id="uploadDropzone">
                            <input type="file" name="image" id="productImageInput" accept="image/*" hidden>
                            <img id="imagePreview" src="" alt="Preview">
                            <div class="upload-placeholder" id="uploadPlaceholder">
                                <img src="{{ asset('images/icons/upload.svg') }}" alt="">
                                <p>Klik untuk upload gambar</p>
                                <small>atau drag & drop</small>
                            </div>
                        </div>

                        @error('image')
                            <small class="error-text" style="color: red;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="input-box">
                        <label for="productPriceInput">Harga Produk</label>
                        <input 
                            type="number" 
                            name="price" 
                            id="productPriceInput" 
                            value="{{ old('price') }}" 
                            step="0.01" 
                            min="0" 
                            placeholder="Masukkan harga produk..." 
                            required>

                        @error('price')
                            <small class="error-text" style="color: red;">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="input-box">
                        <label for="productDescInput">Deskripsi Produk</label>
                        <textarea 
                            name="description" 
                            id="productDescInput" 
                            rows="3" 
                            placeholder="Masukkan deskripsi produk...">{{ old('description') }}</textarea>

                        @error('description')
                            <small class="error-text" style="color: red;">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-batal" id="btnCloseProductModal">Batal</button>
                    <button type="submit" class="btn-simpan">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div class="fullscreen-drop-overlay" id="fullscreenDropOverlay">
    <div class="fullscreen-drop-box">
        <img src="{{ asset('images/icons/image-add.svg') }}" alt="">
        <p>Masukkan gambar</p>
    </div>
</div>
</body>
</html>