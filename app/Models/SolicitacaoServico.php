<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitacaoServico extends Model
{
    protected $fillable = [
        'usuario_id', 'nome_cliente', 'email', 'telefone', 'veiculo', 'descricao_adicional', 'data_preferida', 'data_solicitacao', 'status', 'orcamento'
    ];

}
