<?php

use App\Models\{Brand, Category, Product};
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public string $search = '';

    /** @var array<int, int|string> */
    public array $categorySlugs = [];

    /** @var array<int, int|string> */
    public array $brandSlugs = [];

    public string $categoriesQuery = '';

    public string $brandsQuery = '';

    public int $simulateDelayMs = 350;

    public int $perPage = 10;

    protected array $queryString = [
        'search' => ['except' => ''],
        'categoriesQuery' => ['as' => 'categories', 'except' => ''],
        'brandsQuery' => ['as' => 'brands', 'except' => ''],
    ];

    public function mount(): void
    {
        $this->categorySlugs = $this->parseSlugs($this->categoriesQuery);
        $this->brandSlugs = $this->parseSlugs($this->brandsQuery);
    }

    public function clearFilters(): void
    {
        $this->reset('search', 'categoriesQuery', 'brandsQuery', 'categorySlugs', 'brandSlugs');
        $this->resetPage();
    }

    public function clearCategories(): void
    {
        $this->reset('categoriesQuery', 'categorySlugs');
        $this->resetPage();
    }

    public function clearBrands(): void
    {
        $this->reset('brandsQuery', 'brandSlugs');
        $this->resetPage();
    }

    public function hasActiveFilters(): bool
    {
        return $this->search !== ''
            || $this->categoriesQuery !== ''
            || $this->brandsQuery !== ''
            || $this->categorySlugs !== []
            || $this->brandSlugs !== [];
    }

    public function render()
    {
        return $this->view([
            'categories' => $this->categories(),
            'brands' => $this->brands(),
            'products' => $this->filteredProducts(),
            'suggestions' => $this->nameSuggestions(),
        ]);
    }

    /**
     * @return Collection<int, Category>
     */
    private function categories(): Collection
    {
        $search = trim($this->search);
        $brandSlugs = array_values(array_filter($this->brandSlugs, 'strlen'));

        return Category::query()
            ->withCount(['products' => function ($query) use ($search, $brandSlugs) {
                $query->when($search !== '', function ($query) use ($search) {
                    $query->where('name', 'ilike', '%' . $search . '%');
                })
                    ->when($brandSlugs !== [], function ($query) use ($brandSlugs) {
                        $query->whereIn('brand_id', Brand::query()->whereIn('slug', $brandSlugs)->select('id'));
                    });
            }])
            ->orderBy('name')
            ->get();
    }

    /**
     * @return Collection<int, Brand>
     */
    private function brands(): Collection
    {
        $search = trim($this->search);
        $categorySlugs = array_values(array_filter($this->categorySlugs, 'strlen'));

        return Brand::query()
            ->withCount(['products' => function ($query) use ($search, $categorySlugs) {
                $query->when($search !== '', function ($query) use ($search) {
                    $query->where('name', 'ilike', '%' . $search . '%');
                })
                    ->when($categorySlugs !== [], function ($query) use ($categorySlugs) {
                        $query->whereIn('category_id', Category::query()->whereIn('slug', $categorySlugs)->select('id'));
                    });
            }])
            ->orderBy('name')
            ->get();
    }

    /**
     * @return Collection<int, Product>
     */
    private function filteredProducts(): LengthAwarePaginator
    {
        if ($this->simulateDelayMs > 0) {
            usleep($this->simulateDelayMs * 1000);
        }

        $search = trim($this->search);
        $categorySlugs = array_values(array_filter($this->categorySlugs, 'strlen'));
        $brandSlugs = array_values(array_filter($this->brandSlugs, 'strlen'));

        return Product::query()
            ->with(['category', 'brand'])
            ->when($search !== '', function ($query) use ($search) {
                $query->where('name', 'ilike', '%' . $search . '%');
            })
            ->when($categorySlugs !== [], function ($query) use ($categorySlugs) {
                $query->whereIn('category_id', Category::query()->whereIn('slug', $categorySlugs)->select('id'));
            })
            ->when($brandSlugs !== [], function ($query) use ($brandSlugs) {
                $query->whereIn('brand_id', Brand::query()->whereIn('slug', $brandSlugs)->select('id'));
            })
            ->orderBy('name')
            ->paginate($this->perPage);
    }

    /**
     * @return array<int, string>
     */
    private function nameSuggestions(): array
    {
        $search = trim($this->search);
        $categorySlugs = array_values(array_filter($this->categorySlugs, 'strlen'));
        $brandSlugs = array_values(array_filter($this->brandSlugs, 'strlen'));

        if ($search === '') {
            return [];
        }

        return Product::query()
            ->where('name', 'ilike', '%' . $search . '%')
            ->when($categorySlugs !== [], function ($query) use ($categorySlugs) {
                $query->whereIn('category_id', Category::query()->whereIn('slug', $categorySlugs)->select('id'));
            })
            ->when($brandSlugs !== [], function ($query) use ($brandSlugs) {
                $query->whereIn('brand_id', Brand::query()->whereIn('slug', $brandSlugs)->select('id'));
            })
            ->orderBy('name')
            ->limit(6)
            ->pluck('name')
            ->all();
    }

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedCategorySlugs(): void
    {
        $this->categoriesQuery = implode(',', $this->categorySlugs);
        $this->resetPage();
    }

    public function updatedBrandSlugs(): void
    {
        $this->brandsQuery = implode(',', $this->brandSlugs);
        $this->resetPage();
    }

    public function updatedCategoriesQuery($value): void
    {
        $this->categorySlugs = $this->parseSlugs($value);
        $this->resetPage();
    }

    public function updatedBrandsQuery($value): void
    {
        $this->brandSlugs = $this->parseSlugs($value);
        $this->resetPage();
    }

    /**
     * @return array<int, string>
     */
    private function parseSlugs($value): array
    {
        if (is_array($value)) {
            $items = array_map('trim', $value);

            return array_values(array_filter(array_unique($items), 'strlen'));
        }

        if (! is_string($value) || trim($value) === '') {
            return [];
        }

        $items = array_map('trim', explode(',', $value));

        return array_values(array_filter(array_unique($items), 'strlen'));
    }
};
