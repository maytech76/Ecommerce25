<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::table('shipping_addresses', function (Blueprint $table) {
            // Eliminar la columna city existente
            $table->dropColumn('city');
            $table->dropColumn('state');
            $table->dropColumn('zip_code');
            $table->dropColumn('country');
            
            // Agregar las nuevas relaciones
            $table->foreignId('zone_id')
            ->after('user_id')  // ← Aquí especificas la posición
            ->constrained()
            ->onDelete('cascade');
            
        });
    }

  
    public function down(): void
    {
        Schema::table('shipping_addresses', function (Blueprint $table) {
            $table->dropForeign(['zone_id']);
            $table->dropColumn('zone_id');
            $table->string('city');
            $table->string('state');
            $table->string('zip_code');
            $table->string('country');
        });
    }
};
