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
        
        Schema::create('companies', function (Blueprint $table) {

            $table->id();
            $table->string('doc', 15)->unique();
            $table->string('name', 150)->unique();
            $table->string('email', 150)->unique();
            $table->string('phone', 20)->nullable();
            $table->string('address', 200)->nullable();
            $table->string('website', 150)->nullable();
            $table->string('logo', 150)->nullable();
            $table->string('city', 150)->nullable();
            $table->string('country', 150)->nullable();
            $table->string('license', 100)->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
