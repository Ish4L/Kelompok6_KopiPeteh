import './bootstrap';

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