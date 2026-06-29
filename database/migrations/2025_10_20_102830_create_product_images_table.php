<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('product_images', function (Blueprint $table) {

            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('path'); // Ruta de la imagen
            $table->boolean('is_primary')->default(false); // Indica si es la imagen principal
            $table->integer('order')->default(0); // Orden de visualización
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('product_images');
    }
};
