<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Servico;

class ServicoController extends Controller
{
    public function index()
    {
        return Servico::paginate(20);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required',
            'categoria' => 'nullable',
            'descricao' => 'nullable',
            'preco' => 'required|numeric',
            'duracao' => 'nullable',
            'imagem' => 'nullable',
            'estoque' => 'nullable',
            'ativo' => 'nullable'
        ]);

        $item = Servico::create($data);
        return response()->json($item, 201);
    }

    public function show($id)
    {
        return Servico::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $item = Servico::findOrFail($id);
        $data = $request->all();
        $item->update($data);
        return response()->json($item);
    }

    public function destroy($id)
    {
        Servico::findOrFail($id)->delete();
        return response()->noContent();
    }
}
