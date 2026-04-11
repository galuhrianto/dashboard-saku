@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between sm:justify-end">
        {{-- Mobile View: Previous and Next --}}
        <div class="flex flex-1 justify-between sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center rounded-(--radius) border border-(--border) bg-(--background) px-4 py-2 text-sm font-medium text-(--muted-foreground) cursor-not-allowed">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center rounded-(--radius) border border-(--border) bg-(--background) px-4 py-2 text-sm font-medium text-(--foreground) hover:bg-(--accent) hover:text-(--accent-foreground) transition-colors">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="relative ml-3 inline-flex items-center rounded-(--radius) border border-(--border) bg-(--background) px-4 py-2 text-sm font-medium text-(--foreground) hover:bg-(--accent) hover:text-(--accent-foreground) transition-colors">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="relative ml-3 inline-flex items-center rounded-(--radius) border border-(--border) bg-(--background) px-4 py-2 text-sm font-medium text-(--muted-foreground) cursor-not-allowed">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        {{-- Desktop View: Numbered Pagination --}}
        <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-end">
            <span class="isolate inline-flex -space-x-px rounded-(--radius) shadow-sm">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}" class="relative inline-flex items-center rounded-l-(--radius) border border-(--border) bg-(--background) px-2 py-2 text-sm font-medium text-(--muted-foreground) cursor-not-allowed">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
                        </svg>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="{{ __('pagination.previous') }}" class="relative inline-flex items-center rounded-l-(--radius) border border-(--border) bg-(--background) px-2 py-2 text-sm font-medium text-(--foreground) hover:bg-(--accent) hover:text-(--accent-foreground) transition-colors focus:z-20">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />
                        </svg>
                    </a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span aria-disabled="true" class="relative inline-flex items-center border border-(--border) bg-(--background) px-4 py-2 text-sm font-medium text-(--muted-foreground) cursor-default">
                            {{ $element }}
                        </span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span aria-current="page" class="relative z-10 inline-flex items-center border border-(--primary) bg-(--primary) px-4 py-2 text-sm font-semibold text-(--primary-foreground) focus:z-20">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}" class="relative inline-flex items-center border border-(--border) bg-(--background) px-4 py-2 text-sm font-medium text-(--foreground) hover:bg-(--accent) hover:text-(--accent-foreground) transition-colors focus:z-20">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="{{ __('pagination.next') }}" class="relative inline-flex items-center rounded-r-(--radius) border border-(--border) bg-(--background) px-2 py-2 text-sm font-medium text-(--foreground) hover:bg-(--accent) hover:text-(--accent-foreground) transition-colors focus:z-20">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                        </svg>
                    </a>
                @else
                    <span aria-disabled="true" aria-label="{{ __('pagination.next') }}" class="relative inline-flex items-center rounded-r-(--radius) border border-(--border) bg-(--background) px-2 py-2 text-sm font-medium text-(--muted-foreground) cursor-not-allowed">
                        <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                        </svg>
                    </span>
                @endif
            </span>
        </div>
    </nav>
@endif
