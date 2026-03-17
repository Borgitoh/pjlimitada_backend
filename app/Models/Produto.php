<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'description', 'preco', 'estoque', 'min_stock', 'tipo', 'imagem', 'categoria_id', 'ativo' ,'min_stock',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

     protected $casts = [
        'ativo' => 'boolean',
    ];

    public function modelos()
    {
        return $this->belongsToMany(Modelo::class, 'modelo_produto');
    }
}


