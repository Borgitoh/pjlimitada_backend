<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            'Freios',
            'Filtros',
            'Ignição',
            'Suspensão',
            'Escape',
            'Pneus',
            'Turbo',
            'Interior',
            'Exterior',
            'Motor'
        ];

        foreach ($categorias as $nome) {
            Categoria::create(['nome' => $nome]);
        }
    }
}
