<div class="sidebar">
    <div class="sidebar-header">
        <div class="logo">
            <img src="{{ asset('images/logo2.png') }}" alt="KopiPeteh Logo">
        </div>
    </div>

    @php
        $menus = [
            ['route' => 'dashboard', 'active' => 'dashboard*', 'label' => 'Dashboard',       'icon' => 'home.svg'],
            ['route' => 'profile',   'active' => 'profile*',   'label' => 'Profil',          'icon' => 'profile.svg'],
            ['route' => 'category',  'active' => 'category*',  'label' => 'Kategori',        'icon' => 'category.svg'],
            ['route' => 'product',   'active' => 'product*',   'label' => 'Produk',          'icon' => 'product.svg'],
            ['route' => 'history',   'active' => 'history*',   'label' => 'Riwayat Pesanan', 'icon' => 'history.svg'],
        ];
    @endphp

    <ul>
        @foreach ($menus as $m)
            <li class="{{ request()->routeIs($m['active']) ? 'active' : '' }}">
                <a href="{{ route($m['route']) }}">
                    <img src="{{ asset('images/icons/' . $m['icon']) }}" alt="">
                    {{ $m['label'] }}
                </a>
            </li>
        @endforeach

        <li class="logout">
            <a href="{{ route('logout') }}" onclick="return confirm('Yakin ingin keluar?')">
                <!-- <img src="{{ asset('images/icons/logout.svg') }}" alt=""> -->
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                    <path d="M0 0h24v24H0z" fill="none" />
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.393 4C4 4.617 4 5.413 4 7.004v9.994c0 1.591 0 2.387.393 3.002q.105.165.235.312c.483.546 1.249.765 2.78 1.202c1.533.438 2.3.657 2.856.329a1.5 1.5 0 0 0 .267-.202C11 21.196 11 20.4 11 18.803V5.197c0-1.596 0-2.393-.469-2.837a1.5 1.5 0 0 0-.267-.202c-.555-.328-1.323-.11-2.857.329c-1.53.437-2.296.656-2.78 1.202a2.5 2.5 0 0 0-.234.312M11 4h2.017c1.902 0 2.853 0 3.443.586c.33.326.476.764.54 1.414m-6 14h2.017c1.902 0 2.853 0 3.443-.586c.33-.326.476-.764.54-1.414m4-6h-7m5.5-2.5S22 11.34 22 12s-2.5 2.5-2.5 2.5" />
                </svg>
                Keluar
            </a>
        </li>
    </ul>
</div>