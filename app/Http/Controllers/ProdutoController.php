<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        return Produto::with(['categoria', 'modelos'])->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric',
            'estoque' => 'required|integer',
            'tipo' => 'required|in:peca,bodykit',
            'imagem' => 'nullable|string',
            'categoria_id' => 'required|exists:categorias,id',
            'modelos' => 'array',
            'modelos.*' => 'exists:modelos,id',
        ]);

        $produto = Produto::create($validated);
        if ($request->has('modelos')) {
            $produto->modelos()->sync($request->modelos);
        }

        return response()->json($produto->load('categoria', 'modelos'), 201);
    }

    public function show($id)
    {
        return Produto::with(['categoria', 'modelos'])->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $produto = Produto::findOrFail($id);

        $validated = $request->validate([
            'nome' => 'sometimes|required|string',
            'descricao' => 'nullable|string',
            'preco' => 'sometimes|required|numeric',
            'estoque' => 'sometimes|required|integer',
            'tipo' => 'sometimes|required|in:peca,bodykit',
            'imagem' => 'nullable|string',
            'categoria_id' => 'sometimes|required|exists:categorias,id',
            'modelos' => 'array',
            'modelos.*' => 'exists:modelos,id',
        ]);

        $produto->update($validated);
        if ($request->has('modelos')) {
            $produto->modelos()->sync($request->modelos);
        }

        return response()->json($produto->load('categoria', 'modelos'));
    }

    public function destroy($id)
    {
        Produto::findOrFail($id)->delete();
        return response()->noContent();
    }
}
