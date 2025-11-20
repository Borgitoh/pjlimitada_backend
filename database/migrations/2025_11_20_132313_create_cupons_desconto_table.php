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
        Schema::create('cupons_desconto', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('descricao')->nullable();
            $table->enum('tipo_desconto', ['percentual', 'fixo']);
            $table->decimal('valor_desconto', 10, 2);
            $table->integer('uso_maximo')->default(1);
            $table->integer('usos_atuais')->default(0);
            $table->date('data_inicio')->nullable();
            $table->date('data_fim')->nullable();
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cupons_desconto');
    }
};
