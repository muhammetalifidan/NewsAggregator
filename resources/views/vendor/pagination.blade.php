@if ($paginator->hasPages())
    <div class="card-footer d-flex justify-content-end">
        <div class="pagination d-flex align-items-center">
            <div class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
                <a href="{{ $paginator->previousPageUrl() }}" class="page-link rounded-pill px-0" rel="prev">
                    <i class="ph-caret-left"></i>
                </a>
            </div>

            <div class="px-3">
                {{ $paginator->currentPage() }} of <a href="#">{{ $paginator->lastPage() }}</a>
            </div>

            <div class="page-item {{ !$paginator->hasMorePages() ? 'disabled' : '' }}">
                <a href="{{ $paginator->nextPageUrl() }}" class="page-link rounded-pill px-0" rel="next">
                    <i class="ph-caret-right"></i>
                </a>
            </div>
        </div>
    </div>
@endif
