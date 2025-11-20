<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    protected $fillable = [
        'usuario_id', 'produto_tipo', 'produto_id', 'classificacao', 'comentario', 'data_avaliacao'
    ];

    protected $casts = [
        'data_avaliacao' => 'datetime'
    ];
}
