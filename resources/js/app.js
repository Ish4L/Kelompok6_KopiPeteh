import './bootstrap';

// Tampilan progress saat loading
import NProgress from 'nprogress';
import 'nprogress/nprogress.css';

NProgress.configure({ showSpinner: false, speed: 400 });

if (sessionStorage.getItem('nprogress_active')) {
    sessionStorage.removeItem('nprogress_active');
    NProgress.set(0.75);
    requestAnimationFrame(() => {
        NProgress.done();
    });
}

document.addEventListener('DOMContentLoaded', () => {
    const triggerProgress = () => {
        sessionStorage.setItem('nprogress_active', '1');
        NProgress.start();
    };

    document.addEventListener('click', (e) => {
        if (e.defaultPrevented) return;

        const link = e.target.closest('a');
        if (!link) return;

        const href = link.getAttribute('href');
        const isSamePageAnchor = !href || href.startsWith('#') || href.startsWith('javascript:');
        const isNewTab = link.target === '_blank' || e.ctrlKey || e.metaKey;

        if (!isSamePageAnchor && !isNewTab) {
            triggerProgress();
        }
    });

    document.addEventListener('submit', (e) => {
        if (e.defaultPrevented) return;

        triggerProgress();
    });

    window.addEventListener('pageshow', (e) => {
        if (e.persisted) {
            sessionStorage.removeItem('nprogress_active');
            NProgress.done();
        }
    });
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

// Overlay Form Category
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

// Overlay Form Product
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

// Overlay Detail Order
const orderDetailModal = document.getElementById('orderDetailModal');

if (orderDetailModal) {
    const closeOrderModal = document.getElementById('btnCloseOrderModal');
    const orderStatusForm = document.getElementById('orderStatusForm');
    const itemsContainer = document.getElementById('modalOrderItems');
    const statusSelect = document.getElementById('modalOrderStatus');
    const saveBtn = orderStatusForm.querySelector('.btn-simpan');

    const formatRupiah = (angka) => {
        return Number(angka).toLocaleString('id-ID');
    };

    document.querySelectorAll('.btn-info-order').forEach((btn) => {
        btn.addEventListener('click', () => {
            document.getElementById('modalOrderNumber').textContent = btn.dataset.formattedId;
            document.getElementById('modalCustomerName').textContent = btn.dataset.name;
            document.getElementById('modalCustomerPhone').textContent = btn.dataset.phone;
            document.getElementById('modalOrderDate').textContent = btn.dataset.date;
            document.getElementById('modalPaymentMethod').textContent = btn.dataset.payment;
            document.getElementById('modalTotalPrice').textContent = 'Rp ' + formatRupiah(btn.dataset.total);
            
            const currentStatus = btn.dataset.status;
            statusSelect.value = currentStatus;

            const isEditable = ['belum bayar', 'menunggu'].includes(currentStatus);
            statusSelect.disabled = !isEditable;
            if (saveBtn) {
                saveBtn.disabled = !isEditable;
            }

            orderStatusForm.action = btn.dataset.updateUrl;

            const items = JSON.parse(btn.dataset.items || '[]');
            itemsContainer.innerHTML = items.map((item) => {
                const productTitle = item.variant ? `${item.name} (${item.variant})` : item.name;
                return `
                    <div class="order-item-entry">
                        <div class="item-name">${productTitle}</div>
                        <div class="item-calc">
                            <span>${item.quantity} x ${formatRupiah(item.price)}</span>
                            <span>Rp ${formatRupiah(item.subtotal)}</span>
                        </div>
                    </div>
                `;
            }).join('');

            orderDetailModal.classList.add('show');
        });
    });

    closeOrderModal.addEventListener('click', () => {
        orderDetailModal.classList.remove('show');
    });

    orderDetailModal.addEventListener('click', (e) => {
        if (e.target === orderDetailModal) {
            orderDetailModal.classList.remove('show');
        }
    });
}

// Overlay notification logout
window.openLogoutModal = function () {
    const modal = document.getElementById('logoutModal');
    if (modal) {
        modal.classList.add('show');
        modal.setAttribute('aria-hidden', 'false');
    }
};

window.closeLogoutModal = function () {
    const modal = document.getElementById('logoutModal');
    if (modal) {
        modal.classList.remove('show');
        modal.setAttribute('aria-hidden', 'true');
    }
};

document.addEventListener('click', (e) => {
    const modal = document.getElementById('logoutModal');
    if (modal && e.target === modal) {
        window.closeLogoutModal();
    }
});

// Overlay tambah item
document.addEventListener('DOMContentLoaded', () => {
    const cartModal = document.getElementById('addToCartModal');
    if (!cartModal) return;

    const modalProductName = document.getElementById('modalProductName');
    const modalQtyValue = document.getElementById('modalQtyValue');
    const variantButtons = cartModal.querySelectorAll('.variant-btn');

    let cart = JSON.parse(localStorage.getItem('kopipeteh_cart') || '{}');
    let selectedProduct = null;
    let modalQty = 1;
    let modalVariant = 'Iced';

    function updateCartBadge() {
        const totalQty = Object.values(cart).reduce((sum, item) => sum + item.qty, 0);
        const navBadge = document.querySelector('.cart-count span');
        if (navBadge) navBadge.textContent = totalQty;
    }

    function openCartModal(product) {
        selectedProduct = product;
        modalQty = 1;
        modalVariant = 'Iced';

        modalProductName.textContent = product.name;
        modalQtyValue.textContent = modalQty;

        variantButtons.forEach((btn) => {
            btn.classList.toggle('active', btn.dataset.variant === 'Iced');
        });

        cartModal.classList.add('show');
        cartModal.setAttribute('aria-hidden', 'false');
    }

    function closeCartModal() {
        cartModal.classList.remove('show');
        cartModal.setAttribute('aria-hidden', 'true');
        selectedProduct = null;
    }

    updateCartBadge();

    document.addEventListener('click', (e) => {
        const addBtn = e.target.closest('.cart-add');
        if (!addBtn) return;

        const card = addBtn.closest('.item[data-id]');
        if (!card) return;

        openCartModal({
            id: card.dataset.id,
            name: card.dataset.name,
            price: parseInt(card.dataset.price, 10),
            img: card.dataset.img,
        });
    });

    document.getElementById('modalQtyMinus')?.addEventListener('click', () => {
        if (modalQty > 1) {
            modalQty--;
            modalQtyValue.textContent = modalQty;
        }
    });

    document.getElementById('modalQtyPlus')?.addEventListener('click', () => {
        modalQty++;
        modalQtyValue.textContent = modalQty;
    });

    variantButtons.forEach((btn) => {
        btn.addEventListener('click', () => {
            modalVariant = btn.dataset.variant;
            variantButtons.forEach((b) => b.classList.remove('active'));
            btn.classList.add('active');
        });
    });

    document.getElementById('modalCancelBtn')?.addEventListener('click', closeCartModal);

    cartModal.addEventListener('click', (e) => {
        if (e.target === cartModal) closeCartModal();
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && cartModal.classList.contains('show')) {
            closeCartModal();
        }
    });

    document.getElementById('modalConfirmBtn')?.addEventListener('click', () => {
        if (!selectedProduct) return;

        const key = `${selectedProduct.id}-${modalVariant}`;

        if (cart[key]) {
            cart[key].qty += modalQty;
        } else {
            cart[key] = {
                ...selectedProduct,
                variant: modalVariant,
                qty: modalQty,
            };
        }

        localStorage.setItem('kopipeteh_cart', JSON.stringify(cart));
        updateCartBadge();
        closeCartModal();
    });
});

// Filter menu
document.addEventListener('DOMContentLoaded', () => {
    const filterTabs = document.querySelectorAll('.menu-tab button');
    const menuItems = document.querySelectorAll('.product-list .item');
    const emptyMsg = document.getElementById('emptyFilterMsg');

    if (!filterTabs.length) return;

    filterTabs.forEach((tab) => {
        tab.addEventListener('click', (e) => {
            e.preventDefault();

            filterTabs.forEach((t) => t.classList.remove('active'));
            tab.classList.add('active');

            const selectedCategory = tab.dataset.filter;
            let visibleCount = 0;

            menuItems.forEach((item) => {
                const isMatch = selectedCategory === 'all' || item.dataset.category === selectedCategory;

                item.style.display = isMatch ? '' : 'none';
                if (isMatch) visibleCount++;
            });

            if (emptyMsg) {
                emptyMsg.style.display = visibleCount === 0 ? 'block' : 'none';
            }
        });
    });
});

// Fitur search menu
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.querySelector('.search-box input');
    const searchForm = searchInput?.closest('form');
    const filterTabs = document.querySelectorAll('.menu-tab button');
    const menuItems = document.querySelectorAll('.product-list .item');
    const emptyMsg = document.getElementById('emptyFilterMsg');
    const menuSection = document.querySelector('.menu-section');
    const productList = document.querySelector('.product-list');

    if (!productList && searchInput) {
        searchInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                const query = searchInput.value.trim();
                if (query) {
                    window.location.href = `/menu?search=${encodeURIComponent(query)}`;
                }
            }
        });
        return;
    }

    if (!productList) return;

    let activeCategory = 'all';
    let searchQuery = '';

    function applyMenuFilters() {
        let visibleCount = 0;

        menuItems.forEach((item) => {
            const category = item.dataset.category || '';
            const name = (item.dataset.name || item.querySelector('.item-name')?.textContent || '').toLowerCase();
            const desc = (item.querySelector('.item-desc')?.textContent || '').toLowerCase();

            const matchesCategory = activeCategory === 'all' || category === activeCategory;
            const matchesSearch = !searchQuery || name.includes(searchQuery) || desc.includes(searchQuery);

            const isVisible = matchesCategory && matchesSearch;
            item.style.display = isVisible ? '' : 'none';

            if (isVisible) visibleCount++;
        });

        if (emptyMsg) {
            if (menuItems.length === 0) {
                emptyMsg.textContent = 'Tidak ada data';
            } else if (searchQuery) {
                emptyMsg.textContent = `Item "${searchInput.value.trim()}" tidak ditemukan`;
            } else {
                emptyMsg.textContent = 'Tidak ada item di kategori ini';
            }

            emptyMsg.style.display = visibleCount === 0 ? 'block' : 'none';
        }

        productList.classList.toggle('is-empty', visibleCount === 0);
    }

    function scrollToMenu() {
        if (!menuSection) return;
        const navHeight = document.querySelector('.navbar')?.offsetHeight || 0;
        const targetPosition = menuSection.offsetTop - navHeight;

        if (window.scrollY < targetPosition - 20) {
            window.scrollTo({ top: targetPosition, behavior: 'smooth' });
        }
    }

    filterTabs.forEach((tab) => {
        tab.addEventListener('click', () => {
            filterTabs.forEach((t) => t.classList.remove('active'));
            tab.classList.add('active');

            activeCategory = tab.dataset.filter;
            applyMenuFilters();
        });
    });

    if (searchInput) {
        searchForm?.addEventListener('submit', (e) => e.preventDefault());

        searchInput.addEventListener('input', () => {
            searchQuery = searchInput.value.toLowerCase().trim();
            applyMenuFilters();

            if (searchQuery.length > 0) {
                scrollToMenu();
            }
        });

        const urlParams = new URLSearchParams(window.location.search);
        const initialSearch = urlParams.get('search');
        if (initialSearch) {
            searchInput.value = initialSearch;
            searchQuery = initialSearch.toLowerCase().trim();
            applyMenuFilters();
            scrollToMenu();
        }
    }
});