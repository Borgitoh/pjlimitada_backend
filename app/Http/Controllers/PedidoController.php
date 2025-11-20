<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pedido;

class PedidoController extends Controller
{
    public function index()
    {
        return Pedido::paginate(20);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'usuario_id' => 'required|integer|exists:users,id',
            'numero_pedido' => 'required',
            'data_pedido' => 'nullable',
            'data_atualizacao' => 'nullable',
            'status' => 'nullable',
            'subtotal' => 'required|numeric',
            'impostos' => 'nullable',
            'frete' => 'nullable',
            'total' => 'nullable',
            'observacoes' => 'nullable'
        ]);

        $item = Pedido::create($data);
        return response()->json($item, 201);
    }

    public function show($id)
    {
        return Pedido::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $item = Pedido::findOrFail($id);
        $data = $request->all();
        $item->update($data);
        return response()->json($item);
    }

    public function destroy($id)
    {
        Pedido::findOrFail($id)->delete();
        return response()->noContent();
    }
}
