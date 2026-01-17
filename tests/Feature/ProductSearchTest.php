<?php

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

it('shows initial products', function() {
    $products = Product::factory()->count(3)->create();

    Livewire::test('product-search')
        ->assertSee($products[0]->name)
        ->assertSee($products[1]->name)
        ->assertSee($products[2]->name);
});

it('filters by product name', function() {
    $match = Product::factory()->create(['name' => 'Galaxy Phone']);
    $other = Product::factory()->create(['name' => 'Office Chair']);

    Livewire::test('product-search')
        ->set('search', 'Galaxy')
        ->assertSee($match->name)
        ->assertDontSee($other->name);
});

it('filters by a single category', function() {
    $category = Category::factory()->create(['name' => 'Electronics']);
    $otherCategory = Category::factory()->create(['name' => 'Furniture']);

    $match = Product::factory()->for($category)->create(['name' => 'TV']);
    $other = Product::factory()->for($otherCategory)->create(['name' => 'Sofa']);

    Livewire::test('product-search')
        ->set('categorySlugs', [$category->slug])
        ->assertSee($match->name)
        ->assertDontSee($other->name);
});

it('filters by multiple categories', function() {
    $categoryA = Category::factory()->create(['name' => 'Electronics']);
    $categoryB = Category::factory()->create(['name' => 'Furniture']);
    $categoryC = Category::factory()->create(['name' => 'Kitchen']);

    $matchA = Product::factory()->for($categoryA)->create(['name' => 'TV']);
    $matchB = Product::factory()->for($categoryB)->create(['name' => 'Chair']);
    $other = Product::factory()->for($categoryC)->create(['name' => 'Mixer']);

    Livewire::test('product-search')
        ->set('categorySlugs', [$categoryA->slug, $categoryB->slug])
        ->assertSee($matchA->name)
        ->assertSee($matchB->name)
        ->assertDontSee($other->name);
});

it('filters by a single brand', function() {
    $brand = Brand::factory()->create(['name' => 'Acme']);
    $otherBrand = Brand::factory()->create(['name' => 'Globex']);

    $match = Product::factory()->for($brand)->create(['name' => 'Headphones']);
    $other = Product::factory()->for($otherBrand)->create(['name' => 'Speaker']);

    Livewire::test('product-search')
        ->set('brandSlugs', [$brand->slug])
        ->assertSee($match->name)
        ->assertDontSee($other->name);
});

it('filters by multiple brands', function() {
    $brandA = Brand::factory()->create(['name' => 'Acme']);
    $brandB = Brand::factory()->create(['name' => 'Globex']);
    $brandC = Brand::factory()->create(['name' => 'Initech']);

    $matchA = Product::factory()->for($brandA)->create(['name' => 'Tablet']);
    $matchB = Product::factory()->for($brandB)->create(['name' => 'Notebook']);
    $other = Product::factory()->for($brandC)->create(['name' => 'Monitor']);

    Livewire::test('product-search')
        ->set('brandSlugs', [$brandA->slug, $brandB->slug])
        ->assertSee($matchA->name)
        ->assertSee($matchB->name)
        ->assertDontSee($other->name);
});

it('filters by name, category and brand combined', function() {
    $category = Category::factory()->create(['name' => 'Electronics']);
    $brand = Brand::factory()->create(['name' => 'Acme']);
    $otherBrand = Brand::factory()->create(['name' => 'Globex']);

    $match = Product::factory()
        ->for($category)
        ->for($brand)
        ->create(['name' => 'Pro Headset']);

    $other = Product::factory()
        ->for($category)
        ->for($otherBrand)
        ->create(['name' => 'Pro Headset Max']);

    Livewire::test('product-search')
        ->set('search', 'Pro')
        ->set('categorySlugs', [$category->slug])
        ->set('brandSlugs', [$brand->slug])
        ->assertSee($match->name)
        ->assertDontSee($other->name);
});

it('persists filters on page refresh using query string', function() {
    $category = Category::factory()->create(['name' => 'Electronics']);
    $brand = Brand::factory()->create(['name' => 'Acme']);
    $other = Product::factory()->create(['name' => 'Office Desk']);

    $match = Product::factory()
        ->for($category)
        ->for($brand)
        ->create(['name' => 'Camera Pro']);

    $this->get('/?search=Camera&categories=' . $category->slug . '&brands=' . $brand->slug)
        ->assertOk()
        ->assertSee($match->name)
        ->assertDontSee($other->name);
});

it('clears all filters', function() {
    $category = Category::factory()->create();
    $brand = Brand::factory()->create();

    $match = Product::factory()
        ->for($category)
        ->for($brand)
        ->create(['name' => 'Desk']);

    $other = Product::factory()->create(['name' => 'Lamp']);

    Livewire::test('product-search')
        ->set('search', 'Desk')
        ->set('categorySlugs', [$category->slug])
        ->set('brandSlugs', [$brand->slug])
        ->call('clearFilters')
        ->assertSet('search', '')
        ->assertSet('categorySlugs', [])
        ->assertSet('brandSlugs', [])
        ->assertSee($match->name)
        ->assertSee($other->name);
});
