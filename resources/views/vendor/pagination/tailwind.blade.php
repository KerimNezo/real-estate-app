@if ($paginator->hasPages())
    <div class="flex items-center justify-center w-full mt-2">
        {{-- Previous Page Link --}}
        <div class="mr-auto text-sm">
            @if ($paginator->onFirstPage())
                <span class="text-gray-500 disabled" aria-disabled="true">&laquo; Previous</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="text-[#ef5d60] hover:text-red-200">&laquo; Previous</a>
            @endif
        </div>

        {{-- Current Page Information --}}
        <div class="mx-auto text-sm text-center">
            Showing {{ $paginator->firstItem() }}-{{ $paginator->lastItem() }} of {{ $paginator->total() }} results
        </div>

        {{-- Next Page Link --}}
        <div class="ml-auto text-sm">
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="text-[#ef5d60] hover:text-red-200">Next &raquo;</a>
            @else
                <span class="text-gray-500 disabled" aria-disabled="true">Next &raquo;</span>
            @endif
        </div>
    </div>
@endif
