<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Modelo;

class Marca extends Model
{
    use HasFactory;

    protected $table = 'marcas';

    protected $fillable = [
        'nome',
        'imagem',
        'ativo'
    ];

    protected $casts = [
        'ativo' => 'boolean'
    ];

    public function modelos()
    {
        return $this->hasMany(Modelo::class);
    }
}