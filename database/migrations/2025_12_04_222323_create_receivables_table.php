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
        Schema::create('receivables', function (Blueprint $table) {

            $table->id();
            $table->string('code')->unique()->comment('CXC-001');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('concept');
            $table->text('description')->nullable();
            $table->decimal('total_amount', 12, 2);
            $table->decimal('pending_balance', 12, 2);
            $table->date('issue_date'); //Fecha registro de deuda
            $table->date('due_date')->nullable(); //Fecha de vencimiento
            $table->enum('status', ['pendiente', 'parcial', 'pagado', 'retrazo'])->default('pendiente');
            $table->timestamps();
            $table->softDeletes();
            
            // Índices
            $table->index('user_id');
            $table->index('status');
            $table->index('due_date');
            $table->index('code');
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receivables');
    }
};
