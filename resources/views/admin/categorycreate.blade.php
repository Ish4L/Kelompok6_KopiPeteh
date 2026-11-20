<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    @vite(['resources/css/styleadmin.css'])
    @vite(['resources/js/script.js'])
</head>
<body>
<div class="modal-overlay" id="categoryModal">
    <div class="modal-content">
    <div class="modal-body">
        <h2>Tambah Kategori</h2>
            <form action="#" method="POST">
                <label for="namaKategori">Nama Kategori</label>
                <input type="text" id="namaKategori" name="nama_kategori" placeholder="Contoh: Makanan" required>

                <div class="modal-footer">
                    <button type="button" class="btn-batal"
                        onclick="closeModal()">
                        Batal
                    </button>

                    <button type="submit" class="btn-simpan">
                        Simpan
                    </button>
                </div>
            </form>
    </div>
    </div>
</div>

</body>
</html>