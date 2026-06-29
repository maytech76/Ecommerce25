<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\State;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = [
            'AMAZONAS',
            'ANZOÁTEGUI',
            'APURE',
            'ARAGUA',
            'BARINAS',
            'BOLÍVAR',
            'CARABOBO',
            'COJEDES',
            'DELTA AMACURO',
            'FALCÓN',
            'GUÁRICO',
            'LA GUAIRA',
            'LARA',
            'MÉRIDA',
            'MIRANDA',
            'MONAGAS',
            'NUEVA ESPARTA',
            'PORTUGUESA',
            'SUCRE',
            'TÁCHIRA',
            'TRUJILLO',
            'LA GUAIRA',
            'YARACUY',
            'ZULIA',
            'DISTRITO CAPITAL'
        ];

        foreach ($states as $stateName) {
            State::create([
                'name' => $stateName,
                'status' => 1
            ]);
        }
    }
}