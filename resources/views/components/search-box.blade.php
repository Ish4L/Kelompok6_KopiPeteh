@props([
    'placeholder' => 'Cari data',
    'action' => url()->current(),
])

<form action="{{ $action }}" method="GET" class="search-form" id="searchForm" style="width: 100%">
    @foreach (request()->except(['search']) as $key => $value)
        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
    @endforeach

    <div class="search-wrapper">
        <div class="input-box">
            <input type="text" name="search" id="searchInput" value="{{ request('search') }}" placeholder="{{ $placeholder }}" autocomplete="off">

            @if (request('search'))
                @php
                    $queryParams = request()->except(['search', 'page']);
                    $resetUrl = $action . (count($queryParams) ? '?' . http_build_query($queryParams) : '');
                @endphp
                <a href="{{ $resetUrl }}" class="btn-reset" title="Hapus pencarian">
                    <i class="fa-solid fa-xmark"></i>
                </a>
            @endif
        </div>

        <button class="btn-search">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>
    </div>
</form>