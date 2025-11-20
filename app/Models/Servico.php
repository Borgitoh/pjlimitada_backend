<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    protected $fillable = [
        'nome', 'categoria', 'descricao', 'preco', 'duracao', 'imagem', 'estoque', 'ativo'
    ];

    protected $casts = [
        'ativo' => 'boolean'
    ];
}
