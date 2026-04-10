<?php
// database/seeders/SanFernandoZonesSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;
use App\Models\Zone;
use Carbon\Carbon;

class SfdoZonesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buscar o crear la ciudad usando Eloquent
        $sanFernando = City::firstOrCreate(
            ['name' => 'San Fernando'],
            [] // Los timestamps se generan automáticamente
        );

        $zones = [
            // ZONA CENTRO
            ['name' => 'Centro', 'price' => 4.50],
            ['name' => 'Plaza Bolívar', 'price' => 4.50],
            ['name' => 'Calle Comercio', 'price' => 4.60],
            ['name' => 'Mercado Municipal', 'price' => 4.70],
            
            // ZONA NORTE
            ['name' => 'Barrio Obrero', 'price' => 5.00],
            ['name' => 'Urbanización Los Mangos', 'price' => 5.20],
            ['name' => 'La Macanilla', 'price' => 5.30],
            ['name' => 'Aeropuerto Las Flecheras', 'price' => 5.50],
            
            // ZONA SUR
            ['name' => 'Paso Real', 'price' => 5.80],
            ['name' => 'La Esmeralda', 'price' => 6.00],
            ['name' => 'Puente Apure', 'price' => 5.50],
            ['name' => 'Boca del Río', 'price' => 6.20],
            
            // ZONA ESTE
            ['name' => 'Urbanización La Trinidad', 'price' => 5.00],
            ['name' => 'Santa Inés', 'price' => 5.10],
            ['name' => 'La Villa', 'price' => 5.30],
            ['name' => 'Sector La Ceiba', 'price' => 5.40],
            
            // ZONA OESTE
            ['name' => 'Barrio Unión', 'price' => 5.00],
            ['name' => 'Urbanización El Progreso', 'price' => 5.10],
            ['name' => 'La Floresta', 'price' => 5.20],
            ['name' => 'Sector El Carmen', 'price' => 5.30],
            
            // URBANIZACIONES
            ['name' => 'Urbanización Alto Apure', 'price' => 5.50],
            ['name' => 'Urbanización Los Chaguaramos', 'price' => 5.30],
            ['name' => 'Urbanización El Viñedo', 'price' => 5.40],
            ['name' => 'Urbanización Las Américas', 'price' => 5.20],
            ['name' => 'Urbanización San José', 'price' => 5.00],
            
            // BARRIOS
            ['name' => 'Barrio La Carolina', 'price' => 4.80],
            ['name' => 'Barrio El Triunfo', 'price' => 4.90],
            ['name' => 'Barrio La Paz', 'price' => 4.80],
            ['name' => 'Barrio 5 de Julio', 'price' => 4.90],
            
            // SECTORES RURALES
            ['name' => 'Biruaca', 'price' => 7.00],
            ['name' => 'El Recreo', 'price' => 7.50],
            ['name' => 'La Culebra', 'price' => 8.00],
            ['name' => 'El Samán', 'price' => 7.00],
            ['name' => 'La Yegüera', 'price' => 8.50],
            ['name' => 'Los Guarataros', 'price' => 9.00],
            ['name' => 'Palmarito', 'price' => 10.00],
            
            // ZONAS COMERCIALES
            ['name' => 'Zona Industrial', 'price' => 5.00],
            ['name' => 'Centro Comercial Apure', 'price' => 4.80],
            ['name' => 'Terminal de Pasajeros', 'price' => 4.70],
            ['name' => 'Malecón', 'price' => 5.00],
        ];

        // Insertar zonas usando la relación
        foreach ($zones as $zone) {
            $sanFernando->zones()->create($zone);
        }

        $this->command->info('Seeder de zonas de San Fernando de Apure ejecutado exitosamente!');
        $this->command->info('Total de zonas insertadas: ' . count($zones));
    }
}