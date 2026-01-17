<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            'Brastemp',
            'Consul',
            'Philco',
            'Electrolux',
            'Samsung',
            'LG',
        ];

        foreach ($brands as $name) {
            Brand::create(compact('name'));
        }
    }
}
