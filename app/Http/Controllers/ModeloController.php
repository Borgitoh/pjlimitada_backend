<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use Illuminate\Http\Request;

class ModeloController extends Controller
{
    public function index()
    {
        return Modelo::with('marca')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'marca_id' => 'required|exists:marcas,id',
            'year' => 'required|integer|min:1990|max:2030',
            'version' => 'nullable|string|max:255',
            'ativo' => 'boolean'
        ]);

        return Modelo::create($data);
    }

    public function show($id)
    {
        return Modelo::with('marca')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $modelo = Modelo::findOrFail($id);

        $data = $request->validate([
            'nome' => 'sometimes|string|max:255',
            'marca_id' => 'sometimes|exists:marcas,id',
            'year' => 'sometimes|integer|min:1990|max:2030',
            'version' => 'nullable|string|max:255',
            'ativo' => 'boolean'
        ]);

        $modelo->update($data);
        return $modelo;
    }

    public function destroy($id)
    {
        Modelo::destroy($id);
        return response()->json(['message' => 'Modelo removido com sucesso.']);
    }
}
