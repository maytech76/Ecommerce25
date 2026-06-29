<?php
// database/seeders/EjidoZonesSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EjidoZonesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verificar si Ejido ya existe, si no, crearla
        $ejidoId = DB::table('cities')->where('name', 'Ejido')->value('id');
        
        if (!$ejidoId) {
            $ejidoId = DB::table('cities')->insertGetId([
                'name' => 'Ejido'
            ]);
        }

        $zones = [
            // ZONA CENTRO EJIDO (Más cercana a Mérida)
            ['name' => 'Centro', 'price' => 5.50, 'city_id' => $ejidoId],
            ['name' => 'La Parroquia', 'price' => 5.80, 'city_id' => $ejidoId],
            ['name' => 'Plaza Bolívar', 'price' => 5.60, 'city_id' => $ejidoId],
            ['name' => 'Mercado Municipal', 'price' => 5.70, 'city_id' => $ejidoId],
            
            // ZONA NORTE EJIDO (Media distancia)
            ['name' => 'La Vega', 'price' => 6.20, 'city_id' => $ejidoId],
            ['name' => 'Los Curos', 'price' => 6.50, 'city_id' => $ejidoId],
            ['name' => 'Campo Alegre', 'price' => 6.80, 'city_id' => $ejidoId],
            ['name' => 'La Pedregosa', 'price' => 7.00, 'city_id' => $ejidoId],
            
            // ZONA SUR EJIDO (Más lejana de Mérida)
            ['name' => 'Montaña Alta', 'price' => 8.50, 'city_id' => $ejidoId],
            ['name' => 'La Lagunita', 'price' => 8.20, 'city_id' => $ejidoId],
            ['name' => 'El Corozo', 'price' => 7.80, 'city_id' => $ejidoId],
            ['name' => 'Los Naranjos', 'price' => 7.50, 'city_id' => $ejidoId],
            
            // ZONA ESTE EJIDO (Hacia la carretera panamericana)
            ['name' => 'La Trampa', 'price' => 6.00, 'city_id' => $ejidoId],
            ['name' => 'Las González', 'price' => 6.30, 'city_id' => $ejidoId],
            ['name' => 'Bella Vista', 'price' => 6.10, 'city_id' => $ejidoId],
            ['name' => 'Los Andes', 'price' => 6.40, 'city_id' => $ejidoId],
            
            // ZONA OESTE EJIDO (Hacia la sierra)
            ['name' => 'La Molina', 'price' => 8.00, 'city_id' => $ejidoId],
            ['name' => 'El Carmen', 'price' => 7.20, 'city_id' => $ejidoId],
            ['name' => 'La Esperanza', 'price' => 7.60, 'city_id' => $ejidoId],
            ['name' => 'San José', 'price' => 7.40, 'city_id' => $ejidoId],
            
            // URBANIZACIONES EJIDO
            ['name' => 'Urbanización La Hacienda', 'price' => 6.50, 'city_id' => $ejidoId],
            ['name' => 'Urbanización Los Próceres', 'price' => 6.30, 'city_id' => $ejidoId],
            ['name' => 'Urbanización El Recreo', 'price' => 6.20, 'city_id' => $ejidoId],
            ['name' => 'Urbanización Santa Rosa', 'price' => 6.80, 'city_id' => $ejidoId],
            ['name' => 'Urbanización El Valle', 'price' => 7.00, 'city_id' => $ejidoId],
            
            // SECTORES RURALES (Más lejanos - mayor precio)
            ['name' => 'Mesa de Quintero', 'price' => 9.50, 'city_id' => $ejidoId],
            ['name' => 'La Toma', 'price' => 10.00, 'city_id' => $ejidoId],
            ['name' => 'Los Nevados', 'price' => 12.00, 'city_id' => $ejidoId],
            ['name' => 'Pueblo Nuevo', 'price' => 8.80, 'city_id' => $ejidoId],
            ['name' => 'La Gonzalera', 'price' => 9.20, 'city_id' => $ejidoId],
            
            // ZONAS INDUSTRIALES Y COMERCIALES
            ['name' => 'Zona Industrial', 'price' => 6.00, 'city_id' => $ejidoId],
            ['name' => 'Centro Comercial', 'price' => 5.80, 'city_id' => $ejidoId],
            ['name' => 'Terminal de Pasajeros', 'price' => 5.90, 'city_id' => $ejidoId],
        ];

        DB::table('zones')->insert($zones);

        $this->command->info('Seeder de zonas de Ejido ejecutado exitosamente!');
        $this->command->info('Total de zonas insertadas: ' . count($zones));
    }
}