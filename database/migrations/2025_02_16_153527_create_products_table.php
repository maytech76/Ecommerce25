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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->string('codebar')->nullable();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();

            // Campos de costo, utilidad, ganancias
            $table->decimal('cost', 10, 2)->nullable();
            $table->decimal('utility_percentage', 5, 2)->default(0);
            $table->decimal('profit', 10, 2)->default(0);

            $table->decimal('price', 10, 2);
            $table->decimal('price2', 10, 2);

            // Campos para video
            $table->enum('video_provider', ['youtube', 'vimeo', 'tiktok', 'none'])->default('none');
            $table->string('video_link', 255)->nullable();

            $table->integer('stock')->default(0);
            $table->string('image')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->boolean('interchangeable')->default(false);
            $table->boolean('refundable')->default(false);
            
          
            // Campo para imagen de portada (si quieres separarla de la imagen principal)
            $table->string('cover_image', 255)->nullable();
            
            // Cambiar el campo image para que sea más descriptivo
            $table->renameColumn('image', 'main_image');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
