<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_address_id')->nullable()->constrained('shipping_addresses')->onDelete('set null');
            $table->decimal('total_price', 10, 2);
            $table->enum('status', ['pending', 'paid', 'shipped', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        // 🔥 Primero eliminar las llaves foráneas
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['user_address_id']);
        });
        
        // Luego eliminar la tabla
        Schema::dropIfExists('orders');
    }
};