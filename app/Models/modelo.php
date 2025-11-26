<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'marca_id', 'ativo', 'version', 'year'];

    protected $appends = ['name', 'brandId', 'year', 'version', 'active'];

    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'modelo_produto');
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function getNameAttribute()
    {
        return $this->nome;
    }

    public function getBrandIdAttribute()
    {
        return $this->marca_id;
    }

    public function getYearAttribute()
    {
        return $this->attributes['year'];
    }

    public function getVersionAttribute()
    {
        return $this->attributes['version'];
    }

    public function getActiveAttribute()
    {
        return $this->attributes['ativo'];
    }
}
