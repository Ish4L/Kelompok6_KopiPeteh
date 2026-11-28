<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kategori - KopiPeteh</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    @vite(['resources/css/styleadmin.css', 'resources/js/app.js'])
</head>
<body>
    <div class="wrapper">
        <x-sidebar />

        <div class="content">
            <h3>Kategori</h3>

            <div class="search-area">
                <button class="btn-add" id="btnAddCategory" title="Tambah kategori">Tambah</button>

                <x-search-box placeholder="Cari kategori..." />
            </div>

            <table class="data-table category-table">
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
                
                @forelse ($categories as $category)
                    <tr>
                        <td>{{ $categories->firstItem() + $loop->index }}</td>
                        <td>{{ ucfirst($category->category_name) }}</td>
                        <td>
                            <button type="button" 
                                    class="btn-edit" 
                                    data-id="{{ $category->id }}" 
                                    data-name="{{ $category->category_name }}" 
                                    title="Edit">
                                <img src="{{ asset('images/icons/edit.svg') }}" alt="Edit">
                            </button>

                            <button type="button"
                                    class="btn-hapus"
                                    data-url="{{ route('category.destroy', $category->id) }}"
                                    data-name="{{ ucfirst($category->category_name) }}"
                                    data-type="kategori"
                                    title="Hapus">
                                <img src="{{ asset('images/icons/delete.svg') }}" alt="Delete">
                            </button>                           
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="color: rgba(0, 0, 0, 0.5); font-weight: 500;">Tidak ada data</td>
                    </tr>
                @endforelse
            </table>
            <x-pagination :paginator="$categories" />
        </div>
    </div>

    <div class="modal-overlay" id="categoryModal">
        <div class="modal-content">
            <form action="{{ route('category.store') }}" data-store-url="{{ route('category.store') }}" data-update-url="{{ url('/kategori') }}" method="POST" class="category-form" id="categoryForm">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">

                <div class="modal-body">
                    <h1 id="modalTitle">Tambah Kategori</h1>
                    <hr>
                    <div class="input-box">
                        <label for="categoryNameInput">Nama Kategori</label>
                        <input 
                            type="text" 
                            name="category_name" 
                            id="categoryNameInput" 
                            value="{{ old('category_name') }}" 
                            placeholder="Contoh: Makanan"
                            autofocus 
                            required>
                        
                        @error('category_name')
                            <small class="error-text" style="color: red;">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn-batal" id="btnCloseModal">Batal</button>
                    <button type="submit" class="btn-simpan">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div id="deleteModal" class="confirm-overlay" aria-hidden="true">
    <div class="confirm-box">
        <div class="confirm-icon">
            <img src="{{ asset('images/icons/delete2.svg') }}" alt="">
        </div>
        <div class="confirm-text">
            <h3>Hapus Kategori?</h3>
            <p id="deleteConfirmMessage">Anda yakin ingin menghapus kategori {{ ucfirst($category->categort_name) }}?</p>
        </div>

        <div class="confirm-actions">
            <button type="button" class="btn-cancel" onclick="closeDeleteModal()">Batal</button>
            
            <form id="deleteConfirmForm" action="" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger">Ya, Hapus</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>