<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Zone;
use App\Models\City;
use Illuminate\Support\Facades\DB;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener el ID de Mérida
        $meridaId = DB::table('cities')->where('name', 'Merida')->value('id');
        
        $zones = [
            // ZONA CENTRO - MÉRIDA
            ['name' => 'Centro', 'price' => 2.50, 'city_id' => $meridaId],
            ['name' => 'La Parroquia', 'price' => 3.00, 'city_id' => $meridaId],
            ['name' => 'La Hechicera', 'price' => 3.50, 'city_id' => $meridaId],
            ['name' => 'Los Curos', 'price' => 3.00, 'city_id' => $meridaId],
            ['name' => 'Santa María', 'price' => 2.80, 'city_id' => $meridaId],
            ['name' => 'Santa Juana', 'price' => 3.20, 'city_id' => $meridaId],
            
            // ZONA NORTE - MÉRIDA
            ['name' => 'Campo de Oro', 'price' => 4.00, 'city_id' => $meridaId],
            ['name' => 'La Pedregosa', 'price' => 3.80, 'city_id' => $meridaId],
            ['name' => 'La Victoria', 'price' => 3.50, 'city_id' => $meridaId],
            ['name' => 'Los Chorros', 'price' => 4.20, 'city_id' => $meridaId],
            ['name' => 'Mucumbarila', 'price' => 4.50, 'city_id' => $meridaId],
            
            // ZONA SUR - MÉRIDA
            ['name' => 'Ejido', 'price' => 5.00, 'city_id' => $meridaId],
            ['name' => 'Lagunillas', 'price' => 6.00, 'city_id' => $meridaId],
            ['name' => 'San Rafael de Muucuchíes', 'price' => 8.00, 'city_id' => $meridaId],
            
            // ZONA ESTE - MÉRIDA
            ['name' => 'Avenida Urdaneta', 'price' => 3.00, 'city_id' => $meridaId],
            ['name' => 'Bella Vista', 'price' => 3.20, 'city_id' => $meridaId],
            ['name' => 'Los Sauzales', 'price' => 3.80, 'city_id' => $meridaId],
            ['name' => 'Milla', 'price' => 2.80, 'city_id' => $meridaId],
            
            // ZONA OESTE - MÉRIDA
            ['name' => 'Chama', 'price' => 4.50, 'city_id' => $meridaId],
            ['name' => 'La Otra Banda', 'price' => 4.00, 'city_id' => $meridaId],
            ['name' => 'Loma de Los Guantes', 'price' => 3.50, 'city_id' => $meridaId],
            
            // URBANIZACIONES - MÉRIDA
            ['name' => 'Urbanización La Hacienda', 'price' => 4.20, 'city_id' => $meridaId],
            ['name' => 'Urbanización Los Andes', 'price' => 3.80, 'city_id' => $meridaId],
            ['name' => 'Urbanización Santa Rosa', 'price' => 3.60, 'city_id' => $meridaId],
            ['name' => 'Urbanización El Valle', 'price' => 4.50, 'city_id' => $meridaId],
            ['name' => 'Urbanización La Floresta', 'price' => 3.40, 'city_id' => $meridaId],
        ];

        DB::table('zones')->insert($zones);
    }
    
    }

