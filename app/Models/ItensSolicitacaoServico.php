<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItensSolicitacaoServico extends Model
{
    protected $fillable = [
        'solicitacao_id', 'servico_id', 'quantidade', 'preco'
    ];

}
