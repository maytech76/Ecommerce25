<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void{

        Schema::create('events', function (Blueprint $table) {

            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('banner', 150);
            $table->enum('type', ['MTB', 'ROUTE', 'DONWHILL', 'ENDURO', 'SPORT'])->default('sport');
            $table->string('name', 150);
            $table->string('description', 250);
            $table->datetime('event_date'); //fecha del evento
            $table->datetime('registration_deadline');//fecha limite para inscripciones
            $table->foreignId('state_id')->constrained()->onDelete('cascade');
            $table->foreignId('city_id')->constrained()->onDelete('cascade');
            $table->string('address', 250);
            $table->string('phone', 20);
            $table->string('name_manager', 150);//persona responsable
            $table->string('email_manager',150);//email de contacto
            $table->enum('status', ['draft', 'published', 'completed', 'cancelled'])->default('draft');
            $table->timestamps();

            // Índices para mejorar rendimiento en consultas
            $table->index('event_date');
            $table->index('type');
            $table->index('status');
            $table->index(['user_id', 'event_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_events');
    }
};
