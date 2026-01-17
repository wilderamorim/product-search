<?php

namespace Database\Seeders;

use App\{Models\Brand, Models\Category, Models\Product};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::query()->pluck('id', 'slug');
        $brands = Brand::query()->pluck('id', 'slug');

        if ($categories->isEmpty() || $brands->isEmpty()) {
            return;
        }

        $products = [
            ['name' => 'Smart TV 50" 4K', 'category_slug' => 'eletronicos', 'brand_slug' => 'samsung'],
            ['name' => 'Smartphone 128GB', 'category_slug' => 'eletronicos', 'brand_slug' => 'samsung'],
            ['name' => 'Notebook 15" i5', 'category_slug' => 'eletronicos', 'brand_slug' => 'lg'],
            ['name' => 'Geladeira Duplex 400L', 'category_slug' => 'eletrodomesticos', 'brand_slug' => 'brastemp'],
            ['name' => 'Fogão 4 bocas', 'category_slug' => 'eletrodomesticos', 'brand_slug' => 'consul'],
            ['name' => 'Máquina de Lavar 12kg', 'category_slug' => 'eletrodomesticos', 'brand_slug' => 'electrolux'],
            ['name' => 'Liquidificador 900W', 'category_slug' => 'casa-e-cozinha', 'brand_slug' => 'philco'],
            ['name' => 'Fritadeira Elétrica 5L', 'category_slug' => 'casa-e-cozinha', 'brand_slug' => 'philco'],
            ['name' => 'Cafeteira Elétrica 30 xícaras', 'category_slug' => 'casa-e-cozinha', 'brand_slug' => 'electrolux'],
            ['name' => 'Secador de Cabelo 2000W', 'category_slug' => 'beleza-e-cuidados', 'brand_slug' => 'philco'],
            ['name' => 'Chapinha Cerâmica', 'category_slug' => 'beleza-e-cuidados', 'brand_slug' => 'philco'],
            ['name' => 'Bicicleta Aro 29', 'category_slug' => 'esporte-e-lazer', 'brand_slug' => 'samsung'],
        ];

        foreach ($products as $product) {
            Product::create([
                'name' => $product['name'],
                'slug' => Str::slug($product['name']),
                'category_id' => $categories[$product['category_slug']],
                'brand_id' => $brands[$product['brand_slug']],
            ]);
        }
    }
}
