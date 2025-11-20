<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bodykit extends Model
{
    protected $fillable = [
        'nome', 'marca', 'modelo', 'categoria', 'material', 'preco', 'custo', 'descricao', 'imagem', 'estoque', 'ano_compatibilidade', 'sku', 'ativo'
    ];

    protected $casts = [
        'ativo' => 'boolean'
    ];
}
