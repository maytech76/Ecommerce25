<?php
// database/seeders/ElVigiaZonesSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ElVigiaZonesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verificar si El Vigía ya existe, si no, crearla
        $elVigiaId = DB::table('cities')->where('name', 'El Vigía')->value('id');
        
        if (!$elVigiaId) {
            $elVigiaId = DB::table('cities')->insertGetId([
                'name' => 'El Vigía'
            ]);
        }

        $zones = [
            // ZONA CENTRO EL VIGÍA (Más céntrica)
            ['name' => 'Centro', 'price' => 8.00, 'city_id' => $elVigiaId],
            ['name' => 'Plaza Bolívar', 'price' => 8.20, 'city_id' => $elVigiaId],
            ['name' => 'Mercado Principal', 'price' => 8.10, 'city_id' => $elVigiaId],
            ['name' => 'Catedral', 'price' => 8.30, 'city_id' => $elVigiaId],
            
            // ZONA NORTE EL VIGÍA (Hacia la carretera)
            ['name' => 'La Concordia', 'price' => 8.50, 'city_id' => $elVigiaId],
            ['name' => 'Los Pescadores', 'price' => 8.80, 'city_id' => $elVigiaId],
            ['name' => 'El Progreso', 'price' => 9.00, 'city_id' => $elVigiaId],
            ['name' => 'La Victoria', 'price' => 9.20, 'city_id' => $elVigiaId],
            
            // ZONA SUR EL VIGÍA (Hacia el lago)
            ['name' => 'La Curva', 'price' => 8.60, 'city_id' => $elVigiaId],
            ['name' => 'El Manguito', 'price' => 8.90, 'city_id' => $elVigiaId],
            ['name' => 'La Playita', 'price' => 9.50, 'city_id' => $elVigiaId],
            ['name' => 'Los Llanitos', 'price' => 9.80, 'city_id' => $elVigiaId],
            
            // ZONA ESTE EL VIGÍA (Zonas residenciales)
            ['name' => 'Bello Monte', 'price' => 8.40, 'city_id' => $elVigiaId],
            ['name' => 'Las Acacias', 'price' => 8.70, 'city_id' => $elVigiaId],
            ['name' => 'Los Samanes', 'price' => 9.10, 'city_id' => $elVigiaId],
            ['name' => 'El Recreo', 'price' => 8.90, 'city_id' => $elVigiaId],
            
            // ZONA OESTE EL VIGÍA (Hacia la montaña)
            ['name' => 'La Pedregosa', 'price' => 9.50, 'city_id' => $elVigiaId],
            ['name' => 'El Carmen', 'price' => 9.80, 'city_id' => $elVigiaId],
            ['name' => 'La Montaña', 'price' => 10.50, 'city_id' => $elVigiaId],
            ['name' => 'Los Pinos', 'price' => 10.20, 'city_id' => $elVigiaId],
            
            // URBANIZACIONES EL VIGÍA
            ['name' => 'Urbanización La Floresta', 'price' => 8.60, 'city_id' => $elVigiaId],
            ['name' => 'Urbanización Los Jardines', 'price' => 8.80, 'city_id' => $elVigiaId],
            ['name' => 'Urbanización El Paraíso', 'price' => 9.00, 'city_id' => $elVigiaId],
            ['name' => 'Urbanización Santa Elena', 'price' => 9.20, 'city_id' => $elVigiaId],
            ['name' => 'Urbanización La Paz', 'price' => 9.40, 'city_id' => $elVigiaId],
            
            // ZONAS INDUSTRIALES Y COMERCIALES
            ['name' => 'Zona Industrial', 'price' => 8.30, 'city_id' => $elVigiaId],
            ['name' => 'Centro Comercial', 'price' => 8.10, 'city_id' => $elVigiaId],
            ['name' => 'Terminal de Pasajeros', 'price' => 8.20, 'city_id' => $elVigiaId],
            ['name' => 'Aeropuerto', 'price' => 8.80, 'city_id' => $elVigiaId],
            
            // SECTORES PERIFÉRICOS (Más lejanos)
            ['name' => 'Campo Alegre', 'price' => 10.00, 'city_id' => $elVigiaId],
            ['name' => 'La Ceiba', 'price' => 10.50, 'city_id' => $elVigiaId],
            ['name' => 'El Corozo', 'price' => 11.00, 'city_id' => $elVigiaId],
            ['name' => 'Las Delicias', 'price' => 10.80, 'city_id' => $elVigiaId],
            ['name' => 'Boca de Monte', 'price' => 12.00, 'city_id' => $elVigiaId],
            
            // ZONAS RURALES ALEDAÑAS
            ['name' => 'La Fría', 'price' => 15.00, 'city_id' => $elVigiaId],
            ['name' => 'Santa Bárbara', 'price' => 14.50, 'city_id' => $elVigiaId],
            ['name' => 'El Guayabo', 'price' => 13.80, 'city_id' => $elVigiaId],
            ['name' => 'La Tendida', 'price' => 16.00, 'city_id' => $elVigiaId],
        ];

        DB::table('zones')->insert($zones);

        $this->command->info('Seeder de zonas de El Vigía ejecutado exitosamente!');
        $this->command->info('Total de zonas insertadas: ' . count($zones));
    }
}