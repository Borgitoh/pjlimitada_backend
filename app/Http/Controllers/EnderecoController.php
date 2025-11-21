<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Endereco;

class EnderecoController extends Controller
{
    public function index()
    {
        return Endereco::paginate(20);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'usuario_id' => 'required|integer|exists:users,id',
            'rua' => 'nullable',
            'bairro' => 'nullable',
            'cidade' => 'nullable',
            'principal' => 'nullable'
        ]);

        $item = Endereco::create($data);
        return response()->json($item, 201);
    }

    public function show($id)
    {
        return Endereco::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $item = Endereco::findOrFail($id);
        $data = $request->all();
        $item->update($data);
        return response()->json($item);
    }

    public function destroy($id)
    {
        Endereco::findOrFail($id)->delete();
        return response()->noContent();
    }
}
