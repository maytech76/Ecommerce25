<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeederap extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            
            ['name' => 'San Fernando'],
            ['name' => 'Biruaca'],
            ['name' => 'Camaguan']
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}
