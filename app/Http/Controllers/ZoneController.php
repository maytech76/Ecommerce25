<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use App\Models\City;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Zone::with('city');
        
        // Filtrar por ciudad si se especifica
        if ($request->has('city_id') && $request->city_id) {
            $query->where('city_id', $request->city_id);
        }
        
        // Filtrar por estado
        if ($request->has('status') && $request->status != '') {
            $query->where('status', $request->status);
        }
        
        // Buscar por nombre
        if ($request->has('search') && $request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        $zones = $query->orderBy('name')->paginate(15);
        $cities = City::where('status', 1)->orderBy('name')->get();
        
        return view('admin.zones.index', compact('zones', 'cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::where('status', 1)->orderBy('name')->get();
        return view('admin.zones.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:zones,name',
            'price' => 'required|numeric|min:0',
            'city_id' => 'required|exists:cities,id'
        ]);

        $zone = Zone::create([
            'name' => $request->name,
            'price' => $request->price,
            'city_id' => $request->city_id,
            'status' => $request->has('status') ? 1 : 0
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Zona creada exitosamente',
                'data' => $zone->load('city')
            ]);
        }

        return redirect()->route('zones.index')
            ->with('success', 'Zona creada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $zone = Zone::with('city')->findOrFail($id);
        
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $zone->id,
                'name' => $zone->name,
                'price' => $zone->price,
                'city_id' => $zone->city_id,
                'city_name' => $zone->city->name,
                'status' => $zone->status,
                'created_at' => $zone->created_at->format('d/m/Y H:i:s'),
                'updated_at' => $zone->updated_at->format('d/m/Y H:i:s')
            ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $zone = Zone::findOrFail($id);
        $cities = City::where('status', 1)->orderBy('name')->get();
        
        return view('admin.zones.edit', compact('zone', 'cities'));
    }

    /**
     * Get zone data for editing (AJAX)
     */
    public function getEditData($id)
    {
        try {
            $zone = Zone::with('city')->findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $zone->id,
                    'name' => $zone->name,
                    'price' => $zone->price,
                    'city_id' => $zone->city_id,
                    'city_name' => $zone->city->name,
                    'status' => $zone->status
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Zona no encontrada'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:zones,name,' . $id,
            'price' => 'required|numeric|min:0',
            'city_id' => 'required|exists:cities,id'
        ]);

        $zone = Zone::findOrFail($id);
        $zone->update([
            'name' => $request->name,
            'price' => $request->price,
            'city_id' => $request->city_id,
            'status' => $request->has('status') ? 1 : 0
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Zona actualizada exitosamente',
                'data' => $zone->load('city')
            ]);
        }

        return redirect()->route('zones.index')
            ->with('success', 'Zona actualizada exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $zone = Zone::findOrFail($id);
            $zoneName = $zone->name;
            $zone->delete();

            return response()->json([
                'success' => true,
                'message' => "La zona '{$zoneName}' ha sido eliminada exitosamente."
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar la zona: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Desactivar zona (cambiar status a 0)
     */
    public function deactivate($id)
    {
        try {
            $zone = Zone::findOrFail($id);
            $zone->status = 0;
            $zone->save();

            return response()->json([
                'success' => true,
                'message' => "La zona '{$zone->name}' ha sido desactivada exitosamente.",
                'data' => $zone
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al desactivar la zona: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Activar zona (cambiar status a 1)
     */
    public function activate($id)
    {
        try {
            $zone = Zone::findOrFail($id);
            $zone->status = 1;
            $zone->save();

            return response()->json([
                'success' => true,
                'message' => "La zona '{$zone->name}' ha sido activada exitosamente.",
                'data' => $zone
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al activar la zona: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtener zonas por ciudad (para selects dinámicos)
     */
    public function getZonesByCity($cityId)
    {
        try {
            $zones = Zone::where('city_id', $cityId)
                ->where('status', 1)
                ->orderBy('name')
                ->get(['id', 'name', 'price']);

            return response()->json([
                'success' => true,
                'data' => $zones
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al cargar las zonas'
            ], 500);
        }
    }

    /**
     * Obtener todas las zonas con sus ciudades (para API)
     */
    public function getAllZones()
    {
        $zones = Zone::with('city')
            ->where('status', 1)
            ->orderBy('name')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $zones
        ]);
    }
}