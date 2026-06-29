<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('drates', function (Blueprint $table) {
            
            $table->string('moneda', 3);
            $table->string('fuente', 50);
            $table->decimal('compra', 15, 4)->nullable();
            $table->decimal('venta', 15, 4)->nullable();
            $table->decimal('promedio', 15, 4);
            $table->datetime('fecha_actualizacion_api');
            $table->datetime('fecha_registro');
            $table->timestamps();
            
            $table->index(['moneda', 'fuente']);
            $table->index('fecha_registro');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drates');
    }
};
