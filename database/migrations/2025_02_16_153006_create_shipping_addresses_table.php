<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shipping_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('address_line1');
            $table->string('address_line2')->nullable();
            $table->string('city');
            $table->string('state')->nullable();
            $table->string('postal_code');
            $table->foreignId('zone_id')->nullable()->constrained()->onDelete('cascade');
            $table->boolean('is_default')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        // 🔥 Primero eliminar las llaves foráneas
        Schema::table('shipping_addresses', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['zone_id']);
        });
        
        // Luego eliminar la tabla
        Schema::dropIfExists('shipping_addresses');
    }
};