<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoriaPeca;

class CategoriaPecaController extends Controller
{
    public function index()
    {
        return CategoriaPeca::paginate(20);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required',
            'descricao' => 'nullable',
            'imagem' => 'nullable'
        ]);

        $item = CategoriaPeca::create($data);
        return response()->json($item, 201);
    }

    public function show($id)
    {
        return CategoriaPeca::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $item = CategoriaPeca::findOrFail($id);
        $data = $request->all();
        $item->update($data);
        return response()->json($item);
    }

    public function destroy($id)
    {
        CategoriaPeca::findOrFail($id)->delete();
        return response()->noContent();
    }
}
