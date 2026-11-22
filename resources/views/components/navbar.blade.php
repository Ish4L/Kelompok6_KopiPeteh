<div class="navbar">
    <div class="nav-title">
        <a href="{{ route('available') }}">
            <img src="{{ asset('images/logo3.png') }}" alt="KopiPeteh">
        </a>
    </div>

    <div class="nav-content">
        <form action="#">
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" name="search" placeholder="Search...">
            </div>
        </form>

        <a href="#" class="nav-cart">
            <img src="{{ asset('images/icons/cart2.svg') }}" alt="" title="Lihat Keranjang">
            <div class="cart-count">
                <span>1</span>
            </div>
        </a>
    </div>
</div>