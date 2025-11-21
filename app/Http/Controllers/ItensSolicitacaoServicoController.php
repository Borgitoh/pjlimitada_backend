<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ItensSolicitacaoServico;

class ItensSolicitacaoServicoController extends Controller
{
    public function index()
    {
        return ItensSolicitacaoServico::paginate(20);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'solicitacao_id' => 'nullable',
            'servico_id' => 'nullable',
            'quantidade' => 'required|integer',
            'preco' => 'required|numeric'
        ]);

        $item = ItensSolicitacaoServico::create($data);
        return response()->json($item, 201);
    }

    public function show($id)
    {
        return ItensSolicitacaoServico::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $item = ItensSolicitacaoServico::findOrFail($id);
        $data = $request->all();
        $item->update($data);
        return response()->json($item);
    }

    public function destroy($id)
    {
        ItensSolicitacaoServico::findOrFail($id)->delete();
        return response()->noContent();
    }
}
