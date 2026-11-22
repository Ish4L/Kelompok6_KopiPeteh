import './bootstrap';

// Fitur show password
window.togglePassword = function (inputId, button) {
    const input = document.getElementById(inputId);
    const eyeIcon = button.querySelector('.icon-eye');
    const eyeOffIcon = button.querySelector('.icon-eye-off');

    if (input.type === 'password') {
        input.type = 'text';
        eyeIcon.style.display = 'none';
        eyeOffIcon.style.display = 'block';
    } else {
        input.type = 'password';
        eyeIcon.style.display = 'block';
        eyeOffIcon.style.display = 'none';
    }
}

// Fitur search auto submit
document.addEventListener('DOMContentLoaded', function () {
        const searchForm = document.getElementById('searchForm');
        const searchInput = document.getElementById('searchInput');
        let debounceTimer;

        if (searchInput && searchForm) {
            const wasAutoSubmitted = sessionStorage.getItem('searchAutoSubmitted') === 'true';

            if (wasAutoSubmitted) {
                sessionStorage.removeItem('searchAutoSubmitted');
                
                searchInput.focus();
                const length = searchInput.value.length;
                searchInput.setSelectionRange(length, length);
            }

            function submitCleanSearch(isAuto = false) {
                if (isAuto) {
                    sessionStorage.setItem('searchAutoSubmitted', 'true');
                }

                if (searchInput.value.trim() === '') {
                    const url = new URL(searchForm.action);
                    const formData = new FormData(searchForm);
                    formData.delete('search');

                    for (const [key, value] of formData.entries()) {
                        url.searchParams.append(key, value);
                    }
                    window.location.href = url.toString();
                } else {
                    searchForm.submit();
                }
            }

            searchInput.addEventListener('input', function () {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(function () {
                    submitCleanSearch(true);
                }, 500);
            });

            searchForm.addEventListener('submit', function (e) {
                e.preventDefault(); 
                clearTimeout(debounceTimer);
                submitCleanSearch(false);
            });
        }
    });

// Form Category Overlay
document.addEventListener('DOMContentLoaded', function () {
    const categoryModal = document.getElementById('categoryModal');
    const categoryForm = document.getElementById('categoryForm');
    const modalTitle = document.getElementById('modalTitle');
    const formMethod = document.getElementById('formMethod');
    const categoryNameInput = document.getElementById('categoryNameInput');
    const btnAddCategory = document.getElementById('btnAddCategory');
    const btnCloseModal = document.getElementById('btnCloseModal');

    if (categoryModal && categoryForm) {
        if (btnAddCategory) {
            btnAddCategory.addEventListener('click', function () {
                modalTitle.textContent = 'Tambah Kategori';
                categoryForm.action = categoryForm.dataset.storeUrl;
                formMethod.value = 'POST';
                categoryNameInput.value = '';
                categoryModal.classList.add('show');
                categoryNameInput.focus();
            });
        }

        document.querySelectorAll('.btn-edit').forEach(function (button) {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                const name = this.dataset.name;

                modalTitle.textContent = 'Edit Kategori';
                categoryForm.action = `${categoryForm.dataset.updateUrl}/${id}`;
                formMethod.value = 'PUT';
                categoryNameInput.value = name;
                categoryModal.classList.add('show');
                categoryNameInput.focus();
            });
        });

        if (btnCloseModal) {
            btnCloseModal.addEventListener('click', function () {
                categoryModal.classList.remove('show');
            });
        }

        categoryModal.addEventListener('click', function (e) {
            if (e.target === categoryModal) {
                categoryModal.classList.remove('show');
            }
        });
    }
});

// Form Product Overlay
document.addEventListener('DOMContentLoaded', function () {
    const productModal = document.getElementById('productModal');
    const productForm = document.getElementById('productForm');

    if (productModal && productForm) {
        const modalTitle = document.getElementById('productModalTitle');
        const formMethod = document.getElementById('productFormMethod');
        const nameInput = document.getElementById('productNameInput');
        const categoryInput = document.getElementById('productCategoryInput');
        const priceInput = document.getElementById('productPriceInput');
        const descInput = document.getElementById('productDescInput');
        const statusInput = document.getElementById('productStatusInput');
        const statusText = document.getElementById('statusText');

        const dropzone = document.getElementById('uploadDropzone');
        const imageInput = document.getElementById('productImageInput');
        const imagePreview = document.getElementById('imagePreview');
        const uploadPlaceholder = document.getElementById('uploadPlaceholder');
        const fullscreenDropOverlay = document.getElementById('fullscreenDropOverlay');
        let dragCounter = 0;

        const btnAddProduct = document.getElementById('btnAddProduct');
        const btnCloseModal = document.getElementById('btnCloseProductModal');

        function updateStatusLabel() {
            statusText.textContent = statusInput.checked ? 'Active' : 'Inactive';
        }

        function resetImagePreview(src = '') {
            imageInput.value = '';
            if (src) {
                imagePreview.src = src;
                imagePreview.style.display = 'block';
                uploadPlaceholder.style.display = 'none';
            } else {
                imagePreview.src = '';
                imagePreview.style.display = 'none';
                uploadPlaceholder.style.display = 'flex';
            }
        }

        statusInput.addEventListener('change', updateStatusLabel);

        dropzone.addEventListener('click', () => imageInput.click());

        window.addEventListener('dragenter', (e) => {
            e.preventDefault();
            if (!productModal.classList.contains('show')) return;

            dragCounter++;
            fullscreenDropOverlay.classList.add('show');
        });

        window.addEventListener('dragleave', (e) => {
            e.preventDefault();
            if (!productModal.classList.contains('show')) return;

            dragCounter--;
            if (dragCounter <= 0) {
                dragCounter = 0;
                fullscreenDropOverlay.classList.remove('show');
            }
        });

        window.addEventListener('dragover', (e) => {
            e.preventDefault();
        });

        window.addEventListener('drop', (e) => {
            e.preventDefault();
            dragCounter = 0;
            fullscreenDropOverlay.classList.remove('show');

            if (!productModal.classList.contains('show')) return;

            const files = e.dataTransfer.files;
            if (files.length && files[0].type.startsWith('image/')) {
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(files[0]);
                imageInput.files = dataTransfer.files;
                imageInput.dispatchEvent(new Event('change'));
            }
        });

        imageInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                    uploadPlaceholder.style.display = 'none';
                };
                reader.readAsDataURL(file);
            }
        });

        if (btnAddProduct) {
            btnAddProduct.addEventListener('click', function () {
                modalTitle.textContent = 'Tambah Produk';
                productForm.action = productForm.dataset.storeUrl;
                formMethod.value = 'POST';

                nameInput.value = '';
                categoryInput.selectedIndex = 0;
                priceInput.value = '';
                descInput.value = '';
                statusInput.checked = false;
                updateStatusLabel();
                resetImagePreview();

                productModal.classList.add('show');
                nameInput.focus();
            });
        }

        document.querySelectorAll('.btn-edit-product').forEach(function (btn) {
            btn.addEventListener('click', function () {
                modalTitle.textContent = 'Edit Produk';
                productForm.action = `${productForm.dataset.updateUrl}/${this.dataset.id}`;
                formMethod.value = 'PUT';

                nameInput.value = this.dataset.name;
                categoryInput.value = this.dataset.category;
                priceInput.value = this.dataset.price;
                descInput.value = this.dataset.description || '';
                statusInput.checked = this.dataset.status === 'active';
                updateStatusLabel();
                resetImagePreview(this.dataset.image);

                productModal.classList.add('show');
                nameInput.focus();
            });
        });

        if (btnCloseModal) {
            btnCloseModal.addEventListener('click', () => productModal.classList.remove('show'));
        }
        productModal.addEventListener('click', (e) => {
            if (e.target === productModal) productModal.classList.remove('show');
        });
    }
});