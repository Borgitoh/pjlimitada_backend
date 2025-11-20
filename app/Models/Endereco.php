<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $fillable = [
        'usuario_id', 'rua', 'bairro', 'cidade', 'principal'
    ];

    protected $casts = [
        'principal' => 'boolean'
    ];
}
