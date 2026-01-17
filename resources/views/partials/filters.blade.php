<aside class="space-y-6 rounded-lg border border-slate-200 bg-white p-6 shadow-sm">
    <div>
        <h2 class="text-sm font-semibold text-slate-700">Nome do produto</h2>
        <input
            type="text"
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
        <h2 class="text-sm font-semibold text-slate-700">Categorias</h2>
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
                </label>
            @empty
                <p class="text-sm text-slate-500">Nenhuma categoria disponível.</p>
            @endforelse
        </div>
    </div>

    <div>
        <h2 class="text-sm font-semibold text-slate-700">Marcas</h2>
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
