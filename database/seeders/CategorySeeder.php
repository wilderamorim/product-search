<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Eletrônicos',
            'Eletrodomésticos',
            'Casa e Cozinha',
            'Beleza e Cuidados',
            'Esporte e Lazer',
        ];

        foreach ($categories as $name) {
            Category::create(compact('name'));
        }
    }
}
