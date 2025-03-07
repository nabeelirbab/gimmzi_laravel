{{-- @if ($paginator->hasPages())
<nav>
    <ul class="pagination">
        @if ($paginator->onFirstPage())
        <li class="disabled page-item" aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
            <a class="page-link" wire:click="previousPage" rel="prev" aria-label="{{ __('pagination.previous') }}"><i><img src="{{ asset('frontend_assets/images/prev-arrow.svg')}}" alt=""></i> previous page</a>
        </li>
        @else

        <li class="page-item">
            <a class="page-link" wire:click="previousPage" rel="prev" aria-label="{{ __('pagination.previous') }}"><i><img src="{{ asset('frontend_assets/images/prev-arrow.svg')}}" alt=""></i> previous page</a>
        </li>
        @endif

        @if ($paginator->hasMorePages())
        <li class="page-item">
            <a class="page-link" wire:click="nextPage" rel="next" aria-label="{{ __('pagination.next') }}">next page <i><img src="{{ asset('frontend_assets/images/next-arrow.svg')}}" alt=""></i></a>
        </li>
        @else
        <li class="disabled page-item" aria-disabled="true" aria-label="{{ __('pagination.next') }}">
            <a class="page-link" wire:click="nextPage" rel="next" aria-label="{{ __('pagination.next') }}">next page <i><img src="{{ asset('frontend_assets/images/next-arrow.svg')}}" alt=""></i></a>
        </li>
        @endif
    </ul>
</nav>
@endif --}}

@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            @if ($paginator->onFirstPage())
            <li class="page-item"></li>
                <!-- Previous page link is hidden -->
            @else
                <li class="page-item">
                    <a class="page-link" wire:click="previousPage" rel="prev" aria-label="{{ __('pagination.previous') }}"><i><img src="{{ asset('frontend_assets/images/prev-arrow.svg')}}" alt=""></i> previous page</a>
                </li>
            @endif

            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" wire:click="nextPage" rel="next" aria-label="{{ __('pagination.next') }}">next page <i><img src="{{ asset('frontend_assets/images/next-arrow.svg')}}" alt=""></i></a>
                </li>
            @else
            <li class="page-item"></li>
                <!-- Next page link is hidden -->
            @endif
        </ul>
    </nav>
@endif
