<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CityController extends Controller
{
    public function index(){
        $cities = City::withCount('zones')->latest()->paginate(4);
        return view('admin.cities.index', compact('cities'));
    } 

    public function create(){
        return view('admin.cities.create');
    }

    public function store(Request $request){

        $request->validate([
            'city_name' => 'required|string|max:100|unique:cities,name'
        ]);

        $city = City::create([
            'name' => $request->city_name
        ]);

        // Para peticiones AJAX
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Ciudad creada exitosamente',
                'data' => $city
            ]);
        }

        // Para peticiones normales
        return redirect()->route('cities.index')
            ->with('success', 'Ciudad creada exitosamente.');
    }

    public function show(City $city){
        Log::info('🔍 CityController@show llamado', [
            'city_id' => $city->id,
            'city_name' => $city->name
        ]);
        
        // Cargar las zonas con paginación
        $zones = $city->zones()->paginate(10);
        
        Log::info('📊 Zonas encontradas', [
            'total_zones' => $zones->total(),
            'current_page' => $zones->currentPage()
        ]);
        
        return response()->json([
            'success' => true,
            'city' => [
                'id' => $city->id,
                'name' => $city->name,
                'status' => $city->status
            ],
            'zones' => $zones->items(),
            'pagination' => [
                'current_page' => $zones->currentPage(),
                'last_page' => $zones->lastPage(),
                'per_page' => $zones->perPage(),
                'total' => $zones->total(),
                'next_page_url' => $zones->nextPageUrl(),
                'prev_page_url' => $zones->previousPageUrl()
            ]
        ]);
    }

    /* consultar ciudad y mostrar sus Zonas */
    public function getCityDetails($id){
        try {
            $city = City::withCount(['zones' => function($query) {
                $query->where('status', 1); // Solo zonas activas si quieres filtrar
            }])->with(['zones' => function($query) {
                $query->select('id', 'name', 'price', 'status', 'city_id')
                      ->orderBy('name');
            }])->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $city->id,
                    'name' => $city->name,
                    'status' => $city->status,
                    'zones_count' => $city->zones_count,
                    'created_at' => $city->created_at->format('d/m/Y'),
                    'zones' => $city->zones->map(function($zone) {
                        return [
                            'name' => $zone->name,
                            'price' => number_format($zone->price, 2),
                            'status' => $zone->status,
                            'status_badge' => $zone->status == 1 
                                ? '<span class="badge bg-success">Activa</span>' 
                                : '<span class="badge bg-danger">Inactiva</span>'
                        ];
                    })
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al cargar los detalles de la ciudad'
            ], 404);
        }
    }

   /**
     * Desactivar ciudad (cambiar status a 0)
     * ============================================
     * Este método cambia el status de la ciudad a 0 (inactiva)
     * También puede desactivar las zonas asociadas si se desea
     * ============================================
     */
    public function deactivate($id){
        try {
            $city = City::findOrFail($id);
            
            // Cambiar status a 0 (inactiva)
            $city->status = 0;
            $city->save();
            
            // OPCIONAL: También desactivar todas las zonas asociadas
            // Descomentar la siguiente línea si quieres desactivar las zonas automáticamente
            // $city->zones()->update(['status' => 0]);
            
            return response()->json([
                'success' => true,
                'message' => "La ciudad '{$city->name}' ha sido desactivada exitosamente.",
                'data' => [
                    'id' => $city->id,
                    'name' => $city->name,
                    'status' => $city->status
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al desactivar la ciudad: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Activar ciudad (cambiar status a 1)
     * Método complementario para reactivar ciudades
     */
    public function activate($id){

        try {
            $city = City::findOrFail($id);
            
            // Cambiar status a 1 (activa)
            $city->status = 1;
            $city->save();
            
            return response()->json([
                'success' => true,
                'message' => "La ciudad '{$city->name}' ha sido activada exitosamente.",
                'data' => [
                    'id' => $city->id,
                    'name' => $city->name,
                    'status' => $city->status
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al activar la ciudad: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get city data for editing (AJAX)
     */
    public function getEditData($id){
        
        try {
            $city = City::findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $city->id,
                    'name' => $city->name,
                    'status' => $city->status
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ciudad no encontrada'
            ], 404);
        }
    }

    /**
 * Update the specified resource in storage.
 */
public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:100|unique:cities,name,' . $id
    ]);

    $city = City::findOrFail($id);
    $city->update([
        'name' => $request->name,
        'status' => $request->status ?? $city->status
    ]);

    // Para peticiones AJAX
    if ($request->ajax()) {
        return response()->json([
            'success' => true,
            'message' => "Ciudad '{$city->name}' actualizada exitosamente",
            'data' => $city
        ]);
    }

    // Para peticiones normales
    return redirect()->route('cities.index')
        ->with('success', 'Ciudad actualizada exitosamente.');
}



}