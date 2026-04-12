<?php

namespace App\Http\Controllers;

use App\Models\Table;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        try {
            $tables = Table::latest()->paginate(4);
            
            return view('admin.tables.index', compact('tables'));
            
        } catch (\Exception $e) {
            Log::error("Error al cargar mesas: " . $e->getMessage());
            return back()->with('error', 'Error al cargar las mesas.');
        }
    }


    public function gestion(){


        $tables = Table::all();

        return view('admin.tables.gestion', compact('tables'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){

        return view('admin.tables.create'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        DB::beginTransaction();
        
        try {
            $validated = $request->validate([
                'name' => 'required',
                'capacity' => 'required|integer|min:1|max:20',
                'description' => 'nullable|string|max:255',
                'status' => 'sometimes|in:disponible,ocupada,reservada,inactiva'
            ]);

            // Establecer status por defecto si no viene
            $validated['status'] = $validated['status'] ?? 'disponible';

            $table = Table::create($validated);

            DB::commit();

            return redirect()
                ->route('tables.index')
                ->with('success', "Mesa '{$table->name}' creada exitosamente.");

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('error', 'Por favor corrige los errores del formulario.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error al crear mesa: " . $e->getMessage());
            
            return back()
                ->withInput()
                ->with('error', 'Error al crear la mesa. Por favor, inténtalo nuevamente.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id){
        try {
            $table = Table::findOrFail($id);
            
            return view('admin.tables.show', compact('table'));
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()
                ->route('tables.index')
                ->with('error', 'La mesa no existe.');
        } catch (\Exception $e) {
            Log::error("Error al mostrar mesa: " . $e->getMessage());
            return back()->with('error', 'Error al cargar la mesa.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id){
        
        try {
            $table = Table::findOrFail($id);
            
            return view('admin.tables.edit', compact('table'));
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()
                ->route('tables.index')
                ->with('error', 'La mesa no existe.');
        } catch (\Exception $e) {
            Log::error("Error al editar mesa: " . $e->getMessage());
            return back()->with('error', 'Error al cargar la mesa.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id){
        DB::beginTransaction();
        
        try {
            $table = Table::findOrFail($id);
            
            $validated = $request->validate([
                'name' => "required|string|max:50|unique:tables,name,{$id}",
                'capacity' => 'required|integer|min:1|max:20',
                'description' => 'nullable|string|max:255',
                'status' => 'required|in:disponible,ocupada,reservada,inactiva'
            ]);

            $table->update($validated);

            DB::commit();

            return redirect()
                ->route('admin.tables.index')
                ->with('success', "Mesa '{$table->name}' actualizada exitosamente.");

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            return back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('error', 'Por favor corrige los errores del formulario.');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollBack();
            return redirect()
                ->route('tables.index')
                ->with('error', 'La mesa no existe.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error al actualizar mesa: " . $e->getMessage());
            
            return back()
                ->withInput()
                ->with('error', 'Error al actualizar la mesa.');
        }
    }

    /**
     * Remove the specified resource from storage (soft delete via status).
     */
    public function destroy(string $id){
        DB::beginTransaction();
        
        try {
            $table = Table::findOrFail($id);
            
            // NO ELIMINAR, solo cambiar status a 'inactiva'
            $table->update(['status' => 'inactiva']);

            DB::commit();

            return redirect()
                ->route('admin.tables.index')
                ->with('success', "Mesa '{$table->name}' desactivada exitosamente.");

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            DB::rollBack();
            return redirect()
                ->route('tables.index')
                ->with('error', 'La mesa no existe.');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error al desactivar mesa: " . $e->getMessage());
            
            return back()
                ->with('error', 'Error al desactivar la mesa.');
        }
    }

    /**
     * Activar una mesa previamente inactiva
     */
    public function activate(string $id){
        DB::beginTransaction();
        
        try {
            $table = Table::findOrFail($id);
            
            $table->update(['status' => 'disponible']);

            DB::commit();

            return redirect()
                ->route('admin.tables.index')
                ->with('success', "Mesa '{$table->name}' activada exitosamente.");

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error al activar mesa: " . $e->getMessage());
            
            return back()->with('error', 'Error al activar la mesa.');
        }
    }
}