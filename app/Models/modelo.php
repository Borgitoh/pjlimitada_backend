<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class modelo extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'marca_id'];

     public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'modelo_produto');
    }
    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }
}
