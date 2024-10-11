@if ($paginator->hasPages())
    <div class="flex items-center justify-center w-full mt-2">
        {{-- Previous Page Link --}}
        <div class="text-sm">
            @if ($paginator->onFirstPage())
                <span class="text-gray-500 cursor-pointer disabled" aria-disabled="true" aria-label="{{ __('pagination.previous') }}">&laquo; Previous</span>
            @else
                <a wire:click="previousPage('{{ $paginator->getPageName() }}')" aria-label="{{ __('pagination.previous') }}" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after" rel="prev" class="text-[#ef5d60] hover:text-red-200 cursor-pointer">&laquo; Previous</a>
            @endif
        </div>

        {{-- Current Page Information --}}
        <div class="mx-auto text-sm text-center">
            Showing {{ $paginator->firstItem() }}-{{ $paginator->lastItem() }} of {{ $paginator->total() }} results
        </div>

        {{-- Next Page Link --}}
        <div class="text-sm">
            @if ($paginator->hasMorePages())
                <a wire:click="nextPage('{{ $paginator->getPageName() }}')" aria-label="{{ __('pagination.next') }}" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after" rel="next" class="text-[#ef5d60] hover:text-red-200 cursor-pointer">Next &raquo;</a>
            @else
                <span class="text-gray-500 cursor-pointer disabled" aria-disabled="true" aria-label="{{ __('pagination.next') }}">Next &raquo;</span>
            @endif
        </div>
    </div>
@endif
