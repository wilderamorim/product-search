<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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
            'Eletrônicos',
            'Eletrodomésticos',
            'Casa e Cozinha',
            'Beleza e Cuidados',
            'Esporte e Lazer',
            'Moda',
        ];

        return [
            'name' => $names[$index++ % count($names)],
        ];
    }
}
