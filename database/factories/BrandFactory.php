<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
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
            'Brastemp',
            'Consul',
            'Philco',
            'Electrolux',
            'Samsung',
            'LG',
        ];

        return [
            'name' => $names[$index++ % count($names)],
        ];
    }
}
