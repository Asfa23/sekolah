@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex justify-between mt-4"> <!-- Add mt-4 for top margin -->
        <div class="flex-1">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="cursor-not-allowed relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                    {!! __('Previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:ring ring-blue-200 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                    {!! __('Previous') !!}
                </a>
            @endif
        </div>

        <div class="flex-1 flex justify-center">
            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span aria-disabled="true">
                        <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                            {{ $element }}
                        </span>
                    </span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-current="page">
                                <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-indigo-600 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                                    {{ $page }}
                                </span>
                            </span>
                        @else
                            <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:ring ring-blue-200 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        <div class="flex-1 flex justify-end">
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:ring ring-blue-200 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                    {!! __('Next') !!}
                </a>
            @else
                <span class="cursor-not-allowed relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                    {!! __('Next') !!}
                </span>
            @endif
        </div>
    </nav>
@endif
