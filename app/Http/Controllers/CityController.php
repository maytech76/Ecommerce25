<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Zone;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Mostrar formulario para crear ciudad con sus zonas
     */
    public function create()
    {
        return view('cities.create');
    }

    /**
     * Guardar ciudad con sus zonas
     */
    public function store(Request $request)
    {
        $request->validate([
            'city_name' => 'required|string|max:255',
            'zones' => 'required|array|min:1',
            'zones.*.name' => 'required|string|max:255',
            'zones.*.price' => 'required|numeric|min:0',
        ]);

        // Crear la ciudad
        $city = City::create([
            'name' => $request->city_name
        ]);

        // Crear las zonas
        foreach ($request->zones as $zoneData) {
            Zone::create([
                'name' => $zoneData['name'],
                'price' => $zoneData['price'],
                'city_id' => $city->id
            ]);
        }

        return redirect()->route('cities.index')
            ->with('success', 'Ciudad y zonas creadas exitosamente.');
    }

    /**Obtener zonas de una ciudad (para AJAX)**/
    public function getZones($cityId)
    {
        $zones = Zone::where('city_id', $cityId)
            ->orderBy('price')
            ->get();

        return response()->json($zones);
    }
}