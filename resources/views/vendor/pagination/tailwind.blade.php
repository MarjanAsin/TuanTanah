@if ($paginator->hasPages())

<nav class="flex flex-col sm:flex-row items-center justify-between gap-4">

    {{-- Info --}}
    <div class="text-sm text-gray-500 font-inria">
        Menampilkan
        <span class="font-semibold text-indigo-600">
            {{ $paginator->firstItem() ?? 0 }}
        </span>
        -
        <span class="font-semibold text-indigo-600">
            {{ $paginator->lastItem() ?? 0 }}
        </span>
        dari
        <span class="font-semibold text-indigo-600">
            {{ $paginator->total() }}
        </span>
        data
    </div>

    {{-- MOBILE --}}
    <div class="flex sm:hidden items-center gap-3">

        @if ($paginator->onFirstPage())

            <span class="px-4 py-2 rounded-xl bg-gray-100 text-gray-400 cursor-not-allowed font-inria">
                ‹ Prev
            </span>

        @else

            <a href="{{ $paginator->previousPageUrl() }}"
               rel="prev"
               class="px-4 py-2 rounded-xl bg-white border border-gray-200 text-indigo-600 shadow-sm font-inria">
                ‹ Prev
            </a>

        @endif

        <span class="px-3 py-2 text-sm font-semibold text-gray-700 font-inria">
            {{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}
        </span>

        @if ($paginator->hasMorePages())

            <a href="{{ $paginator->nextPageUrl() }}"
               rel="next"
               class="px-4 py-2 rounded-xl bg-white border border-gray-200 text-indigo-600 shadow-sm font-inria">
                Next ›
            </a>

        @else

            <span class="px-4 py-2 rounded-xl bg-gray-100 text-gray-400 cursor-not-allowed font-inria">
                Next ›
            </span>

        @endif

    </div>

    {{-- DESKTOP --}}
    <div class="hidden sm:flex items-center gap-2">

        {{-- Previous --}}
        @if ($paginator->onFirstPage())

            <span class="w-10 h-10 flex items-center justify-center rounded-xl bg-gray-100 text-gray-400 cursor-not-allowed">
                ‹
            </span>

        @else

            <a href="{{ $paginator->previousPageUrl() }}"
               rel="prev"
               class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-gray-200 text-indigo-600 hover:bg-indigo-600 hover:text-white transition shadow-sm">
                ‹
            </a>

        @endif

        {{-- Numbers --}}
        @foreach ($elements as $element)

            @if (is_string($element))

                <span class="px-3 text-gray-400">
                    {{ $element }}
                </span>

            @endif

            @if (is_array($element))

                @foreach ($element as $page => $url)

                    @if ($page == $paginator->currentPage())

                        <span class="min-w-[40px] h-10 px-3 flex items-center justify-center rounded-xl bg-gradient-to-r from-indigo-600 to-indigo-700 text-white font-semibold shadow-md">
                            {{ $page }}
                        </span>

                    @else

                        <a href="{{ $url }}"
                           class="min-w-[40px] h-10 px-3 flex items-center justify-center rounded-xl bg-white border border-gray-200 text-gray-700 hover:bg-indigo-50 hover:border-indigo-300 hover:text-indigo-600 transition">
                            {{ $page }}
                        </a>

                    @endif

                @endforeach

            @endif

        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())

            <a href="{{ $paginator->nextPageUrl() }}"
               rel="next"
               class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-gray-200 text-indigo-600 hover:bg-indigo-600 hover:text-white transition shadow-sm">
                ›
            </a>

        @else

            <span class="w-10 h-10 flex items-center justify-center rounded-xl bg-gray-100 text-gray-400 cursor-not-allowed">
                ›
            </span>

        @endif

    </div>

</nav>

@endif