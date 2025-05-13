<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class marca extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'imagem'];

    public function modelos()
    {
        return $this->hasMany(Modelo::class);
    }
}
