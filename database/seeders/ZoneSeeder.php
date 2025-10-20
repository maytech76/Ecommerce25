<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Zone;
use App\Models\City;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = City::all();

        $zones = [
            // Lima
            ['name' => 'Centro', 'price' => 2.00, 'city_id' => $cities->where('name', 'Merida')->first()->id],
            ['name' => 'Santa Juana', 'price' => 5.50, 'city_id' => $cities->where('name', 'Merida')->first()->id],
            ['name' => 'Las Americas', 'price' => 6.00, 'city_id' => $cities->where('name', 'Merida')->first()->id],
            ['name' => 'Los Proceres', 'price' => 9.00, 'city_id' => $cities->where('name', 'Merida')->first()->id],
            
            // Ejido
            ['name' => 'Centro Ejido', 'price' => 10.00, 'city_id' => $cities->where('name', 'Ejido')->first()->id],
            ['name' => 'El Manzano', 'price' => 11.50, 'city_id' => $cities->where('name', 'Ejido')->first()->id],
            ['name' => 'Sulbaran', 'price' => 10.00, 'city_id' => $cities->where('name', 'Ejido')->first()->id],
            
            // El vigia
            ['name' => 'Centro Vigia', 'price' => 15.50, 'city_id' => $cities->where('name', 'El Vigia')->first()->id],
            ['name' => 'Zona Industrial', 'price' => 20.50, 'city_id' => $cities->where('name', 'El Vigia')->first()->id],
        ];

        foreach ($zones as $zone) {
            Zone::create($zone);
        }
    
    }
}
