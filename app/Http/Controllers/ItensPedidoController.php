<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItensPedido;

class ItensPedidoController extends Controller
{
    public function index()
    {
        return ItensPedido::paginate(20);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'pedido_id' => 'required|integer',
            'produto_tipo' => 'required',
            'produto_id' => 'nullable',
            'quantidade' => 'required|integer',
            'preco_unitario' => 'required|numeric',
            'subtotal' => 'required|numeric'
        ]);

        $item = ItensPedido::create($data);
        return response()->json($item, 201);
    }

    public function show($id)
    {
        return ItensPedido::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $item = ItensPedido::findOrFail($id);
        $data = $request->all();
        $item->update($data);
        return response()->json($item);
    }

    public function destroy($id)
    {
        ItensPedido::findOrFail($id)->delete();
        return response()->noContent();
    }
}
