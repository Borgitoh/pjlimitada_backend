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
        Schema::create('solicitacoes_servicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('users')->onDelete('cascade');
            $table->string('nome_cliente');
            $table->string('email');
            $table->string('telefone');
            $table->string('veiculo');
            $table->text('descricao_adicional')->nullable();
            $table->date('data_preferida')->nullable();
            $table->timestamp('data_solicitacao')->useCurrent();
            $table->enum('status', ['pendente', 'confirmada', 'em_andamento', 'concluida', 'cancelada'])->default('pendente');
            $table->decimal('orcamento', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitacoes_servicos');
    }
};
