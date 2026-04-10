<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Perros Calientes',
                'description' => 'Los mejores perros calientes con salchichas artesanales, salsas exclusivas y toppings variados.',
                'photo' => 'perros_calientes.jpg'
            ],
            [
                'name' => 'Hamburguesas',
                'description' => 'Hamburguesas jugosas de res, pollo o veganas con pan artesanal y ingredientes frescos.',
                'photo' => 'hamburguesas.jpg'
            ],
            [
                'name' => 'Pizzas',
                'description' => 'Pizzas estilo italiano con masa delgada o gruesa, ingredientes premium y queso fundido.',
                'photo' => 'pizzas.jpg'
            ],
            [
                'name' => 'Pastas',
                'description' => 'Pastas frescas con salsas caseras: carbonara, boloñesa, pesto y más.',
                'photo' => 'pastas.jpg'
            ],
            [
                'name' => 'Bebidas',
                'description' => 'Bebidas frías y calientes para acompañar tu comida.',
                'photo' => 'bebidas.jpg'
            ],
            [
                'name' => 'Refrescos',
                'description' => 'Refrescos de cola, naranja, lima-limón y más, bien fríos.',
                'photo' => 'refrescos.jpg'
            ],
            [
                'name' => 'Jugos Naturales',
                'description' => 'Jugos exprimidos al momento: naranja, fresa, piña, mango y combinaciones especiales.',
                'photo' => 'jugos_naturales.jpg'
            ],
            [
                'name' => 'Café',
                'description' => 'Café de especialidad, espresso, capuchino, latte y bebidas derivadas.',
                'photo' => 'cafe.jpg'
            ],
            [
                'name' => 'Arepas',
                'description' => 'Arepas de Venezolanas especialidad, Carnes, Pabellon, Mixtas, Jamón Queso.',
                'photo' => 'comida_rapida.jpg'
            ]
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
                'photo' => $category['photo']
            ]);
        }
    }
}