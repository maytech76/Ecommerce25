<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Estructura base con rangos lógicos de edad para deportes
        $baseCategories = [
            ['name' => 'JUVENIL',  'min_age' => 14, 'max_age' => 18],
            ['name' => 'SUB-20',   'min_age' => 19, 'max_age' => 20],
            ['name' => 'ELITE',    'min_age' => 19, 'max_age' => 29], // Edad competitiva libre/pro
            ['name' => 'MASTER A', 'min_age' => 30, 'max_age' => 39],
            ['name' => 'MASTER B', 'min_age' => 40, 'max_age' => 49],
        ];

        $genders = ['masculino', 'femenino'];
        
        // 2. ID del evento al que se le asignarán estas categorías.
        // Como definiste 'event_id' como string, usamos un '1' de prueba.
        // Opcional: Si usas el modelo Event puedes descomentar la siguiente línea:
        // $eventId = \App\Models\Event::first()?->id ?? '1';
        $eventId = '1'; 

        $categoriesToInsert = [];

        // 3. Cruzamos las categorías base con ambos géneros
        foreach ($genders as $gender) {
            foreach ($baseCategories as $category) {
                
                // Formateamos el nombre (Ej: "MASTER A MASCULINO" o "ELITE FEMENINO")
                $fullName = $category['name'] . ' ' . strtoupper($gender);

                $categoriesToInsert[] = [
                    'event_id'           => $eventId,
                    'name'               => $fullName,
                    'min_age'            => $category['min_age'],
                    'max_age'            => $category['max_age'],
                    'gender_restriction' => $gender,
                    'status'             => 1,
                    'created_at'         => Carbon::now(),
                    'updated_at'         => Carbon::now(),
                ];
            }
        }

        // 4. Inserción masiva en la base de datos
        DB::table('event_categories')->insert($categoriesToInsert);
    }
}
