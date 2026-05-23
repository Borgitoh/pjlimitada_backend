<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Marca;
use App\Models\Produto;


class Modelo extends Model
{
    use HasFactory;

    protected $table = 'modelos';

    protected $fillable = [
        'nome',
        'marca_id',
        'ativo',
        'version',
        'year'
    ];

    // apenas campos customizados (ACCESSORS)
    protected $appends = [
        'name',
        'brandId',
        'active'
    ];

    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'modelo_produto');
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    // ACCESSORS CORRETOS
    public function getNameAttribute()
    {
        return $this->nome;
    }

    public function getBrandIdAttribute()
    {
        return $this->marca_id;
    }

    public function getActiveAttribute()
    {
        return (bool) $this->ativo;
    }
}