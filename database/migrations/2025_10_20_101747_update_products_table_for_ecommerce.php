<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Campos booleanos para características del producto
            $table->boolean('interchangeable')->default(false)->after('status');
            $table->boolean('refundable')->default(false)->after('interchangeable');
            
            // Campos de costo y utilidad
            $table->decimal('cost', 10, 2)->nullable()->after('price2');
            $table->decimal('utility_percentage', 5, 2)->default(0)->after('cost');
            $table->decimal('profit', 10, 2)->default(0)->after('utility_percentage');
            
            // Campos para video
            $table->enum('video_provider', ['youtube', 'vimeo', 'tiktok', 'none'])->default('none')->after('profit');
            $table->string('video_link', 255)->nullable()->after('video_provider');
            
            // Campo para unidad de medida
            $table->enum('unit', ['UND', 'CAJA', 'PAR', 'PIEZA', 'KIT', 'SET', 'MTS', 'KG', 'LTS'])->default('UND')->after('video_link');
            
            // Campo para imagen de portada (si quieres separarla de la imagen principal)
            $table->string('cover_image', 255)->nullable()->after('image');
            
            // Cambiar el campo image para que sea más descriptivo
            $table->renameColumn('image', 'main_image');
        });
    }
    

    
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Revertir cambios en products
            $table->renameColumn('main_image', 'image');
            $table->dropColumn([
                'interchangeable',
                'refundable',
                'cost',
                'utility_percentage',
                'profit',
                'video_provider',
                'video_link',
                'unit',
                'cover_image'
            ]);
        });

        // Eliminar tabla de imágenes
        Schema::dropIfExists('product_images');
    }
    
};
