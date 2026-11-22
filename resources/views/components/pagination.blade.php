@props(['paginator'])

<div class="table-footer">
    <p class="pagination-info">
        Menampilkan {{ $paginator->firstItem() ?? 0 }} - {{ $paginator->lastItem() ?? 0 }} dari {{ $paginator->total() }}
    </p>

    <div class="pagination-controls">
        @if ($paginator->onFirstPage())
            <span class="page-nav disabled">&lsaquo;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="page-nav">&lsaquo;</a>
        @endif

        <span class="page-current">{{ $paginator->currentPage() }}</span>

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="page-nav">&rsaquo;</a>
        @else
            <span class="page-nav disabled">&rsaquo;</span>
        @endif
    </div>
</div>