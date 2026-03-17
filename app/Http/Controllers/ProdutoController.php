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
            'name' => 'required|string',
            'description' => 'nullable|string',
            'preco' => 'required|numeric',
            'estoque' => 'required|integer',
            'tipo' => 'required|in:peca,bodykit',
            'imagem' => 'nullable|string',
            'categoria_id' => 'required|exists:categorias,id',
            'modelos' => 'array',
            'ativo' => 'boolean',
            'minStock' => 'sometimes|required|integer|min:0',
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
            'minStock' => 'sometimes|required|integer|min:0',
            'modelos' => 'array',
            'modelos.*' => 'exists:modelos,id',
        ]);

        $produto->update($validated);
        if ($request->has('modelos')) {
            $produto->modelos()->sync($request->modelos);
        }

        return response()->json($produto->load('categoria', 'modelos'));
    }
    public function updateStock(Request $request, $id)
    {
        $request->validate([
            'estoque' => 'required|integer|min:0',
        ]);

        $produto = Produto::findOrFail($id);
        $produto->estoque = $request->estoque;
        $produto->save();

        return response()->json($produto);
    }
    public function getProdutosAtivo()
    {
        return Produto::with(['categoria', 'modelos'])
            ->where('ativo', true)
            ->get(); // get() retorna array vazio se não houver registros
    }


    public function toggleAtivo($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->ativo = !$produto->ativo;
        $produto->save();

        return response()->json($produto->load('categoria', 'modelos'));
    }
}
