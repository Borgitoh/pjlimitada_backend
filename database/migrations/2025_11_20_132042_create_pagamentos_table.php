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
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedido_id')->constrained('pedidos')->onDelete('cascade');
            $table->enum('metodo', ['cartao', 'express', 'transferencia']);
            $table->decimal('valor', 10, 2);
            $table->enum('status', ['pendente', 'aprovado', 'recusado', 'reembolsado'])->default('pendente');
            $table->timestamp('data_pagamento')->nullable();
            $table->string('referencia_transacao')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagamentos');
    }
};
