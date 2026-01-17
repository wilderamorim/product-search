<aside class="space-y-6 rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
    <div>
        <h2 class="text-sm font-semibold text-slate-700">Nome do produto</h2>
        <input
            type="search"
            class="mt-2 w-full rounded-md border border-slate-300 px-3 py-2 text-sm focus:border-slate-500 focus:outline-none"
            placeholder="Buscar por nome"
            wire:model.live.debounce.300ms="search"
            list="product-suggestions"
        />
        <datalist id="product-suggestions">
            @foreach ($suggestions as $suggestion)
                <option value="{{ $suggestion }}"></option>
            @endforeach
        </datalist>
    </div>

    <div>
        <div class="flex items-center justify-between">
            <h2 class="text-sm font-semibold text-slate-700">
                Categorias
                @if (! empty($categorySlugs))
                    <span class="text-xs font-medium text-slate-500">({{ count($categorySlugs) }})</span>
                @endif
            </h2>
            @if (! empty($categorySlugs) && empty($brandSlugs))
                <button
                    type="button"
                    class="cursor-pointer text-xs font-semibold text-slate-500 hover:text-slate-700"
                    wire:click="clearCategories"
                >
                    Limpar
                </button>
            @endif
        </div>
        <div class="mt-3 space-y-2">
            @forelse ($categories as $category)
                <label class="flex items-center gap-2 text-sm text-slate-600">
                    <input
                        type="checkbox"
                        value="{{ $category->slug }}"
                        class="rounded border-slate-300 text-slate-900 focus:ring-slate-500"
                        wire:model.live="categorySlugs"
                    />
                    <span>{{ $category->name }}</span>
                    <span class="text-xs text-slate-500">({{ $category->products_count }})</span>
                </label>
            @empty
                <p class="text-sm text-slate-500">Nenhuma categoria disponível.</p>
            @endforelse
        </div>
    </div>

    <div>
        <div class="flex items-center justify-between">
            <h2 class="text-sm font-semibold text-slate-700">
                Marcas
                @if (! empty($brandSlugs))
                    <span class="text-xs font-medium text-slate-500">({{ count($brandSlugs) }})</span>
                @endif
            </h2>
            @if (! empty($brandSlugs) && empty($categorySlugs))
                <button
                    type="button"
                    class="cursor-pointer text-xs font-semibold text-slate-500 hover:text-slate-700"
                    wire:click="clearBrands"
                >
                    Limpar
                </button>
            @endif
        </div>
        <div class="mt-3 space-y-2">
            @forelse ($brands as $brand)
                <label class="flex items-center gap-2 text-sm text-slate-600">
                    <input
                        type="checkbox"
                        value="{{ $brand->slug }}"
                        class="rounded border-slate-300 text-slate-900 focus:ring-slate-500"
                        wire:model.live="brandSlugs"
                    />
                    <span>{{ $brand->name }}</span>
                    <span class="text-xs text-slate-500">({{ $brand->products_count }})</span>
                </label>
            @empty
                <p class="text-sm text-slate-500">Nenhuma marca disponível.</p>
            @endforelse
        </div>
    </div>

    <button
        type="button"
        class="w-full rounded-md border border-slate-300 px-3 py-2 text-sm font-semibold text-slate-700 hover:border-slate-400 hover:text-slate-900 enabled:cursor-pointer disabled:cursor-not-allowed disabled:border-slate-200 disabled:text-slate-400"
        wire:click="clearFilters"
        @disabled(! $this->hasActiveFilters())
    >
        Limpar filtros
    </button>
</aside>
