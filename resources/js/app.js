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

// Fitur form overlay
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