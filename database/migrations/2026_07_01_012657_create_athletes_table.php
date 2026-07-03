<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('athletes', function (Blueprint $table) {

            $table->id();  
            // Datos personales
            $table->string('photo')->nullable();
            $table->string('document')->unique();
            $table->string('name');
            $table->string('last_name');
            $table->date('birth_date');
            $table->enum('gender', ['masculino', 'femenino']);
            $table->string('phone', 20)->nullable();
            
            // Ubicación y contacto
            $table->foreignId('state_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('city_id')->nullable()->constrained()->onDelete('set null');
            $table->string('email')->unique();
            
            // Datos deportivos
            $table->string('team_name')->nullable();
            
            // Datos médicos
            $table->text('medical_conditions')->nullable();
            $table->text('allergies')->nullable();
            $table->string('blood_type', 5)->nullable();
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone', 20)->nullable();
            
            // Estado y auditoría
            $table->text('notes')->nullable();
            $table->enum('status', ['activo', 'inactivo', 'suspendido'])->default('activo');
            
            $table->timestamps();
            
            
            // Índices para mejorar rendimiento
            $table->index('status');
            $table->index('team_name');
            $table->index('state_id');
            $table->index('birth_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('athletes');
    }
};