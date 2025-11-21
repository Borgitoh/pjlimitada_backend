<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CupomDesconto;

class CupomDescontoController extends Controller
{
    public function index()
    {
        return CupomDesconto::paginate(20);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'codigo' => 'nullable',
            'descricao' => 'nullable',
            'tipo_desconto' => 'nullable',
            'valor_desconto' => 'nullable',
            'uso_maximo' => 'nullable',
            'usos_atuais' => 'nullable',
            'data_inicio' => 'nullable',
            'data_fim' => 'nullable',
            'ativo' => 'nullable'
        ]);

        $item = CupomDesconto::create($data);
        return response()->json($item, 201);
    }

    public function show($id)
    {
        return CupomDesconto::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $item = CupomDesconto::findOrFail($id);
        $data = $request->all();
        $item->update($data);
        return response()->json($item);
    }

    public function destroy($id)
    {
        CupomDesconto::findOrFail($id)->delete();
        return response()->noContent();
    }
}
