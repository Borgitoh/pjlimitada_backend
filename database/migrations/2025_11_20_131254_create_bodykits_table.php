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
        Schema::create('bodykits', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('marca');
            $table->string('modelo');
            $table->string('categoria');
            $table->string('material')->nullable();
            $table->decimal('preco', 10, 2);
            $table->decimal('custo', 10, 2);
            $table->text('descricao')->nullable();
            $table->string('imagem')->nullable();
            $table->integer('estoque')->default(0);
            $table->string('ano_compatibilidade')->nullable();
            $table->string('sku')->unique();
            $table->timestamp('data_criacao')->useCurrent();
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bodykits');
    }
};
