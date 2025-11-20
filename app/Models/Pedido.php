<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $fillable = [
        'usuario_id', 'numero_pedido', 'data_pedido', 'data_atualizacao', 'status', 'subtotal', 'impostos', 'frete', 'total', 'observacoes'
    ];

}
