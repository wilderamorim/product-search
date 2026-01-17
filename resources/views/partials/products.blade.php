<div class="w-full space-y-3" wire:loading.remove wire:target="search,categorySlugs,brandSlugs">
    @forelse ($products as $product)
        <div class="rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
            <div class="flex flex-col gap-1">
                <span class="text-sm font-semibold text-slate-800">{{ $product->name }}</span>
                <div class="flex flex-wrap items-center gap-3 text-xs text-slate-500">
                    <span class="inline-flex items-center gap-1">
                        <svg class="h-4 w-4 text-slate-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M5.5 3A2.5 2.5 0 003 5.5v7A2.5 2.5 0 005.5 15h7a2.5 2.5 0 002.5-2.5v-7A2.5 2.5 0 0012.5 3h-7zm0 1.5h7A1 1 0 0113.5 5.5v7a1 1 0 01-1 1h-7a1 1 0 01-1-1v-7a1 1 0 011-1zm3.5 2a2 2 0 100 4 2 2 0 000-4zm0 1.5a.5.5 0 110 1 .5.5 0 010-1z" />
                        </svg>
                        <span>Categoria:</span>
                        <span class="font-medium text-slate-700">{{ $product->category->name }}</span>
                    </span>
                    <span class="inline-flex items-center gap-1">
                        <svg class="h-4 w-4 text-slate-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path d="M3 7.5A2.5 2.5 0 015.5 5h6.086a2 2 0 011.414.586l3.414 3.414A2 2 0 0117 10.414V14.5A2.5 2.5 0 0114.5 17h-9A2.5 2.5 0 013 14.5v-7zm2.5-1a1 1 0 00-1 1v7a1 1 0 001 1h9a1 1 0 001-1v-4.086a.5.5 0 00-.146-.354l-3.414-3.414a.5.5 0 00-.354-.146H5.5zm6 3a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                        </svg>
                        <span>Marca:</span>
                        <span class="font-medium text-slate-700">{{ $product->brand->name }}</span>
                    </span>
                </div>
            </div>
        </div>
    @empty
        <div class="rounded-lg border border-dashed border-slate-300 bg-white p-6 text-center text-sm text-slate-500">
            Nenhum produto encontrado para os filtros selecionados.
        </div>
    @endforelse
</div>
