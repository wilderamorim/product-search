@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-between">
        <div class="flex flex-1 items-center justify-between gap-4 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="inline-flex items-center rounded-md border border-slate-200 bg-white px-3 py-2 text-sm text-slate-400">
                    Anterior
                </span>
            @else
                <button
                    type="button"
                    wire:click="previousPage"
                    wire:loading.attr="disabled"
                    class="inline-flex items-center rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-700 hover:border-slate-400 hover:text-slate-900"
                >
                    Anterior
                </button>
            @endif

            @if ($paginator->hasMorePages())
                <button
                    type="button"
                    wire:click="nextPage"
                    wire:loading.attr="disabled"
                    class="inline-flex items-center rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-700 hover:border-slate-400 hover:text-slate-900"
                >
                    Próxima
                </button>
            @else
                <span class="inline-flex items-center rounded-md border border-slate-200 bg-white px-3 py-2 text-sm text-slate-400">
                    Próxima
                </span>
            @endif
        </div>

        <div class="hidden flex-1 items-center justify-between sm:flex">
            <div>
                <p class="text-sm text-slate-500">
                    Exibindo
                    <span class="font-medium text-slate-700">{{ $paginator->firstItem() }}</span>
                    até
                    <span class="font-medium text-slate-700">{{ $paginator->lastItem() }}</span>
                    de
                    <span class="font-medium text-slate-700">{{ $paginator->total() }}</span>
                    resultados
                </p>
            </div>

            <div>
                <span class="inline-flex items-center gap-1 rounded-md bg-white px-1 py-1">
                    @if ($paginator->onFirstPage())
                        <span class="inline-flex items-center rounded-md border border-slate-200 bg-white px-2 py-2 text-sm text-slate-400">
                            <span class="sr-only">Anterior</span>
                            &lsaquo;
                        </span>
                    @else
                        <button
                            type="button"
                            wire:click="previousPage"
                            wire:loading.attr="disabled"
                            class="inline-flex cursor-pointer items-center rounded-md border border-slate-300 bg-white px-2 py-2 text-sm text-slate-700 hover:border-slate-400 hover:text-slate-900"
                        >
                            <span class="sr-only">Anterior</span>
                            &lsaquo;
                        </button>
                    @endif

                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <span class="inline-flex items-center rounded-md border border-slate-200 bg-white px-3 py-2 text-sm text-slate-400">
                                {{ $element }}
                            </span>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span class="inline-flex items-center rounded-md border border-slate-400 bg-slate-100 px-3 py-2 text-sm font-semibold text-slate-900">
                                        {{ $page }}
                                    </span>
                                @else
                                    <button
                                        type="button"
                                        wire:click="gotoPage({{ $page }})"
                                        class="inline-flex cursor-pointer items-center rounded-md border border-slate-300 bg-white px-3 py-2 text-sm text-slate-700 hover:border-slate-400 hover:text-slate-900"
                                    >
                                        {{ $page }}
                                    </button>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    @if ($paginator->hasMorePages())
                        <button
                            type="button"
                            wire:click="nextPage"
                            wire:loading.attr="disabled"
                            class="inline-flex cursor-pointer items-center rounded-md border border-slate-300 bg-white px-2 py-2 text-sm text-slate-700 hover:border-slate-400 hover:text-slate-900"
                        >
                            <span class="sr-only">Próxima</span>
                            &rsaquo;
                        </button>
                    @else
                        <span class="inline-flex items-center rounded-md border border-slate-200 bg-white px-2 py-2 text-sm text-slate-400">
                            <span class="sr-only">Próxima</span>
                            &rsaquo;
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
