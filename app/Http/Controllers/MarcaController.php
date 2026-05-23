<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function index()
    {
        return Marca::all();
    }

    public function listaMarcas()
    {
        $marcas = Marca::withCount('modelos')->get();

        return $marcas->map(function ($m) {
            return [
                'id' => $m->id,
                'name' => $m->nome,
                'active' => (bool) $m->ativo,
                'modelsCount' => $m->modelos_count,
            ];
        });
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'imagem' => 'nullable|string',
        ]);

        return Marca::create($data);
    }

    public function show($id)
    {
        return Marca::with('modelos')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $marca = Marca::findOrFail($id);

        $data = $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'imagem' => 'nullable|string',
        ]);

        $marca->update($data);

        return $marca;
    }

    public function destroy($id)
    {
        Marca::destroy($id);

        return response()->json([
            'message' => 'Marca removida com sucesso.'
        ]);
    }
}