<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome', 'descricao', 'preco', 'estoque', 'tipo', 'imagem', 'categoria_id'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function modelos()
    {
        return $this->belongsToMany(Modelo::class, 'modelo_produto');
    }
}


