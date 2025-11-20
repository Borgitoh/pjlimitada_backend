<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pagamento;

class PagamentoController extends Controller
{
    public function index()
    {
        return Pagamento::paginate(20);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'pedido_id' => 'required|integer',
            'metodo' => 'nullable',
            'valor' => 'required|numeric',
            'status' => 'nullable',
            'data_pagamento' => 'nullable',
            'referencia_transacao' => 'nullable'
        ]);

        $item = Pagamento::create($data);
        return response()->json($item, 201);
    }

    public function show($id)
    {
        return Pagamento::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $item = Pagamento::findOrFail($id);
        $data = $request->all();
        $item->update($data);
        return response()->json($item);
    }

    public function destroy($id)
    {
        Pagamento::findOrFail($id)->delete();
        return response()->noContent();
    }
}
