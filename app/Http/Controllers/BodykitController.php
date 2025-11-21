<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bodykit;

class BodykitController extends Controller
{
    public function index()
    {
        return Bodykit::paginate(20);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required',
            'marca' => 'nullable',
            'modelo' => 'nullable',
            'categoria' => 'nullable',
            'material' => 'nullable',
            'preco' => 'required|numeric',
            'custo' => 'nullable',
            'descricao' => 'nullable',
            'imagem' => 'nullable',
            'estoque' => 'nullable',
            'ano_compatibilidade' => 'nullable',
            'sku' => 'required',
            'ativo' => 'nullable'
        ]);

        $item = Bodykit::create($data);
        return response()->json($item, 201);
    }

    public function show($id)
    {
        return Bodykit::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $item = Bodykit::findOrFail($id);
        $data = $request->all();
        $item->update($data);
        return response()->json($item);
    }

    public function destroy($id)
    {
        Bodykit::findOrFail($id)->delete();
        return response()->noContent();
    }
}
