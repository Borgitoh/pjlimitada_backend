<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaPeca extends Model
{
    protected $fillable = [
        'nome', 'descricao', 'imagem'
    ];

}
