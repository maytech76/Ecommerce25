<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('old_payments', function (Blueprint $table) {
            $table->id();
            $table->string('receipt_number')->unique();
            $table->foreignId('receivable_id')->constrained('receivables')->onDelete('cascade');
            $table->decimal('amount', 12, 2);
            $table->date('payment_date'); //Fecha de pago
            $table->enum('payment_method', ['efectivo', 'debito', 'credito', 'transferencia', 'pmovil'])->default('efectivo');
            $table->text('comments')->nullable();
            $table->string('reference')->nullable();
            $table->softDeletes(); // Agrega la columna deleted_at
            $table->timestamps();
            
            // Índices
            $table->index('receivable_id');
            $table->index('payment_date');
            $table->index('receipt_number');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('old_payments');
    }
};
