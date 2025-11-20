<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CupomDesconto extends Model
{
    protected $fillable = [
        'codigo', 'descricao', 'tipo_desconto', 'valor_desconto', 'uso_maximo', 'usos_atuais', 'data_inicio', 'data_fim', 'ativo'
    ];

    protected $casts = [
        'data_inicio' => 'date',
        'data_fim' => 'date',
        'ativo' => 'boolean'
    ];
}
