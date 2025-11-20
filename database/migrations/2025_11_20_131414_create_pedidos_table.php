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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
            $table->string('numero_pedido')->unique();
            $table->timestamp('data_pedido')->useCurrent();
            $table->timestamp('data_atualizacao')->nullable();
            $table->enum('status', ['pendente', 'confirmado', 'enviado', 'entregue', 'cancelado'])->default('pendente');
            $table->decimal('subtotal', 10, 2);
            $table->decimal('impostos', 10, 2);
            $table->decimal('frete', 10, 2);
            $table->decimal('total', 10, 2);
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
