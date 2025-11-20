<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peca;

class PecaController extends Controller
{
    public function index()
    {
        return Peca::paginate(20);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required',
            'marca' => 'nullable',
            'categoria' => 'nullable',
            'preco' => 'required|numeric',
            'custo' => 'nullable',
            'descricao' => 'nullable',
            'imagem' => 'nullable',
            'estoque' => 'nullable',
            'compatibilidade' => 'nullable',
            'sku' => 'required',
            'ativo' => 'nullable'
        ]);

        $item = Peca::create($data);
        return response()->json($item, 201);
    }

    public function show($id)
    {
        return Peca::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $item = Peca::findOrFail($id);
        $data = $request->all();
        $item->update($data);
        return response()->json($item);
    }

    public function destroy($id)
    {
        Peca::findOrFail($id)->delete();
        return response()->noContent();
    }
}
