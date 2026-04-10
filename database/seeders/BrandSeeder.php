<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            [
                'name' => 'Comidas',
                'description' => 'Las mejores marcas de comidas rápidas y tradicionales, con ingredientes frescos y sabores únicos.'
            ],
            [
                'name' => 'Bebidas',
                'description' => 'Bebidas refrescantes, naturales y energéticas para acompañar tus comidas.'
            ],
            [
                'name' => 'Snacks',
                'description' => 'Snacks crujientes, papas fritas, nachos, y aperitivos para cualquier momento del día.'
            ]
        ];

        foreach ($brands as $brand) {
            Brand::create([
                'name' => $brand['name'],
                'slug' => Str::slug($brand['name']),
                'description' => $brand['description']
            ]);
        }
    }
}