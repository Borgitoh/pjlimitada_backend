<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RastreamentoPedido;

class RastreamentoPedidoController extends Controller
{
    public function index()
    {
        return RastreamentoPedido::paginate(20);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'pedido_id' => 'required|integer',
            'status' => 'nullable',
            'descricao' => 'nullable',
            'data_atualizacao' => 'nullable',
            'localizacao' => 'nullable'
        ]);

        $item = RastreamentoPedido::create($data);
        return response()->json($item, 201);
    }

    public function show($id)
    {
        return RastreamentoPedido::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $item = RastreamentoPedido::findOrFail($id);
        $data = $request->all();
        $item->update($data);
        return response()->json($item);
    }

    public function destroy($id)
    {
        RastreamentoPedido::findOrFail($id)->delete();
        return response()->noContent();
    }
}
