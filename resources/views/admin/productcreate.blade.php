<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    @vite(['resources/css/styleadmin.css', 'resources/js/script.js'])
</head>
<body>
    <div class="product-overlay" id="productModal">
    <div class="product-modal">
        <h2>Tambah Produk</h2>
            <form action="#" method="POST" enctype="multipart/form-data">

                <div class="product-form">
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" name="nama_produk"
                            placeholder="Contoh: Matcha">
                    </div>

                    <div class="form-group">
                        <label>Kategori Produk</label>
                        <select name="kategori">
                            <option value="">Pilih kategori produk</option>
                            <option value="1">Minuman</option>
                            <option value="2">Makanan</option>
                        </select>
                    </div>
                
                    <div class="form-group">
                        <label>Gambar Produk</label>

                        <label for="productImage" class="upload-box">
                            <i class="fa-solid fa-image"></i>
                            <span>Klik untuk upload gambar</span>
                            <small>atau drag & drop</small>
                        </label>

                        <!-- <input type="file" id="productImage"
                            name="gambar" accept="image/*" hidden> -->
                    </div>

                    <div class="form-group">
                        <label>Harga Produk</label>
                        <input type="number" name="harga"
                            placeholder="Masukkan harga produk...">
                    </div>

                    <div class="form-group">
                        <label>Deskripsi Produk</label>
                        <textarea name="deskripsi"
                            placeholder="Masukkan deskripsi produk..."></textarea>
                    </div>

                    <div class="form-group status-group">
                        <label>Status</label>

                        <div class="status-toggle">
                            <label class="switch">
                                <input type="checkbox" name="status" value="active">
                                <span class="slider"></span>
                            </label>

                            <span id="statusText">Inactive</span>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-batal"
                        onclick="closeProductModal()">Batal</button>
                    <button type="submit" class="btn-simpan">Simpan</button>
                </div>

            </form>
    </div>
    </div>
</body>
</html>