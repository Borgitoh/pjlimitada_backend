<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peca extends Model
{
    protected $fillable = [
        'nome', 'marca', 'categoria', 'preco', 'custo', 'descricao', 'imagem', 'estoque', 'compatibilidade', 'sku', 'ativo'
    ];

    protected $casts = [
        'compatibilidade' => 'array',
        'ativo' => 'boolean'
    ];
}
