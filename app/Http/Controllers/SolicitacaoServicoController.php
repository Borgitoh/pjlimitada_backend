<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SolicitacaoServico;

class SolicitacaoServicoController extends Controller
{
    public function index()
    {
        return SolicitacaoServico::paginate(20);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'usuario_id' => 'required|integer|exists:users,id',
            'nome_cliente' => 'nullable',
            'email' => 'nullable',
            'telefone' => 'nullable',
            'veiculo' => 'nullable',
            'descricao_adicional' => 'nullable',
            'data_preferida' => 'nullable',
            'data_solicitacao' => 'nullable',
            'status' => 'nullable',
            'orcamento' => 'nullable'
        ]);

        $item = SolicitacaoServico::create($data);
        return response()->json($item, 201);
    }

    public function show($id)
    {
        return SolicitacaoServico::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $item = SolicitacaoServico::findOrFail($id);
        $data = $request->all();
        $item->update($data);
        return response()->json($item);
    }

    public function destroy($id)
    {
        SolicitacaoServico::findOrFail($id)->delete();
        return response()->noContent();
    }
}
