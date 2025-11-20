<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    protected $fillable = [
        'pedido_id', 'metodo', 'valor', 'status', 'data_pagamento', 'referencia_transacao'
    ];

}
