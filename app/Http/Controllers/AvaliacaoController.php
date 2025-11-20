<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Avaliacao;

class AvaliacaoController extends Controller
{
    public function index()
    {
        return Avaliacao::paginate(20);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'usuario_id' => 'required|integer|exists:users,id',
            'produto_tipo' => 'required',
            'produto_id' => 'nullable',
            'classificacao' => 'nullable',
            'comentario' => 'nullable',
            'data_avaliacao' => 'nullable'
        ]);

        $item = Avaliacao::create($data);
        return response()->json($item, 201);
    }

    public function show($id)
    {
        return Avaliacao::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $item = Avaliacao::findOrFail($id);
        $data = $request->all();
        $item->update($data);
        return response()->json($item);
    }

    public function destroy($id)
    {
        Avaliacao::findOrFail($id)->delete();
        return response()->noContent();
    }
}
