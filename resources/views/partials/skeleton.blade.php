<div class="w-full space-y-3" wire:loading wire:target="search,categorySlugs,brandSlugs">
    @for ($i = 0; $i < 5; $i++)
        <div class="w-full max-w-none min-w-full rounded-lg border border-slate-200 bg-white p-4 shadow-sm">
            <div class="flex flex-col gap-2">
                <div class="h-4 w-2/6 animate-pulse rounded bg-slate-200"></div>
                <div class="h-3 w-1/2 animate-pulse rounded bg-slate-200"></div>
            </div>
        </div>
    @endfor
</div>
