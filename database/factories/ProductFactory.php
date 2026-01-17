<?php

namespace Database\Factories;

use App\Models\{Brand, Category};
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $index = 0;
        $names = [
            'Smart TV 50" 4K',
            'Geladeira Duplex 400L',
            'Micro-ondas 30L',
            'Liquidificador 900W',
            'Notebook 15" i5',
            'Smartphone 128GB',
            'Aspirador de Pó Turbo',
            'Fritadeira Elétrica 5L',
            'Cafeteira Elétrica 30 xícaras',
            'Ar-condicionado Split 12000 BTUs',
            'Fogão 4 bocas',
            'Máquina de Lavar 12kg',
        ];

        return [
            'name' => $names[$index++ % count($names)],
            'category_id' => Category::factory(),
            'brand_id' => Brand::factory(),
        ];
    }
}
