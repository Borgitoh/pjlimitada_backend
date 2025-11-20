<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RastreamentoPedido extends Model
{
    protected $fillable = [
        'pedido_id', 'status', 'descricao', 'data_atualizacao', 'localizacao'
    ];

}
